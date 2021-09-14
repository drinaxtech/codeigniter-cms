<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('post_model');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_request', 'You are now logged in! You should logout first!');
            redirect(base_url());
        }

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');

        if ($this->form_validation->run() === false) {
            $data['title'] = 'Login';
            $this->load->view('layouts/header', $data);
            $this->load->view('users/login');
            $this->load->view('layouts/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if (!empty($this->user_model->get_users($username))) {
                $enc_password = $this->user_model->get_users($username)->password;
            } else {
                $enc_password = '';
            }
            $this->load->library('bcrypt');

            if ($this->bcrypt->check_password($password, $enc_password)) {
                $user_id   = $this->user_model->login($username, $enc_password);
                $user_data = array(
                    'user_id'   => $user_id,
                    'username'  => $this->user_model->get_users($username)->username,
                    'logged_in' => true,
                );

                $this->session->set_userdata($user_data);

                $this->session->set_flashdata('user_loggedin', 'You are now logged in');

                redirect(base_url());
            } else {
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('user_loggedout', 'You are now logged out');

        redirect('login');
    }

    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            $this->session->set_flashdata('register_request', 'You should logout first!');
            redirect(base_url());
        }

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('surname', 'surname', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('password_again', 'confirm password', 'matches[password]');
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
        if ($this->form_validation->run() === false) {
            $recaptcha = $this->input->post('g-recaptcha-response');
            $data      = array(
                'title'  => 'Register',
                'widget' => $this->recaptcha->getWidget(array('name' => 'recaptcha')),
                'script' => $this->recaptcha->getScriptTag(),
            );

            $this->load->view('layouts/header', $data);
            $this->load->view('users/register');
            $this->load->view('layouts/footer');
        } else {
            $this->user_model->register();
            $this->session->set_flashdata('register', 'You are register successfully!');
            redirect('login');

        }
    }

    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($id = null)
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;

        if ($role !== 'admin' && $user_id != $this->user_model->get_users($id)->id) {
            show_404();
        }

        $data['user'] = $this->user_model->get_users($id);
        if (empty($data['user'])) {
            show_404();
        }
        if ($role === 'admin') {
            $data['roles'] = $this->user_model->get_roles();
        }

        if ($role === 'admin') {
            $data['title'] = 'Edit User';
            $this->load->view('dashboard/users/edit', $data);
        } else {
            $data['title'] = 'Edit User';
            $this->load->view('layouts/header', $data);
            $this->load->view('users/edit');
            $this->load->view('layouts/footer');
        }
    }

    public function update()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;
        $id      = $this->input->post('id');

        if ($role !== 'admin' && $user_id != $this->user_model->get_users($id)->id) {
            show_404();
        }

        if ($role === 'admin') {
            $role_id = empty($this->input->post('role_id')) ? $this->user_model->get_users($user_id)->role_id : $this->input->post('role_id'); 
        } else {
            $role_id = $this->user_model->get_users($user_id)->role_id;
        }

        $this->user_model->update_user($id, $role_id);

        $this->session->set_flashdata('user_updated', 'User info has been updated');
        if($role == 'user'){
            redirect('user/profile');
        }
    }

    public function profile()
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $data['title'] = 'User Profile';
        $user_id             = $this->session->userdata('user_id');
        $data['count_posts'] = count($this->post_model->get_posts_by_author($user_id));
        $user                = $this->user_model->get_users($user_id);
        $role                = $user->role;
        if ($role !== 'user') {
            show_404();
        } else {
            $data['user'] = $this->user_model->get_users($user_id);
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('users/profile');
        $this->load->view('layouts/footer');
    }

    public function subscribe()
    {
        $email = ($this->input->get('email')) ? $this->input->get('email'):$this->input->post('email');
        $this->user_model->subscribe($email);
        $this->session->set_flashdata('subscribe', 'You are subscribed successfully!');
        if($this->input->post('email')){
            redirect('');
        }
        $this->user_model->subscribe($email);
    }

    public function validate_captcha()
    {
        $captcha  = $this->input->post('g-recaptcha-response');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lc5cLEZAAAAABJWanTTcwA9FnK4yLHUHRPM8e53&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return false;
        } else {
            return true;
        }
    }

}
