<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthAPI extends CI_Controller
{
    protected $auth;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('post_model');
        $this->load->model('comment_model');
        $this->load->model('category_model');
        $this->load->model('page_model');
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $username     = $_SERVER['PHP_AUTH_USER'];
            $password     = $_SERVER['PHP_AUTH_PW'];
            $enc_password = $this->user_model->get_users($username)->password;
            $this->load->library('bcrypt');

            if ($this->bcrypt->check_password($password, $enc_password)) {

                $user = $this->user_model->login($username, $enc_password);

                if ($user) {
                    $this->auth    = true;
                    $this->user_id = $this->user_model->get_users($username)->id;
                } else {

                    $this->auth = false;
                }

            }

        } else {
            $this->auth    = $this->session->userdata('logged_in');
            $this->user_id = $this->session->userdata('user_id');
        }

        if (!$this->auth) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'text' => 'Error',
                    'type' => '500',
                )));
        }

    }

    public function get_users()
    {
        if ($this->auth) {

            $role = $this->user_model->get_users($this->user_id)->role;

            if ($role === 'admin') {

                $users = $this->user_model->get_all_users();
                foreach ($users as $user) {
                    if ($user['user_id'] != $this->session->userdata('user_id')) {
                        $all_users[] = $user;
                    }
                }
            }

            if (isset($all_users)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($all_users));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array(
                        'text' => 'Not Found',
                        'type' => 'Error 404',
                    )));
            }
        }
    }

    public function get_social_networks()
    {
        if ($this->auth) {

            $social_networks = $this->post_model->get_social_networks();

            if (isset($social_networks)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($social_networks));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array(
                        'text' => 'Not Found',
                        'type' => 'Error 404',
                    )));
            }
        }
    }

    public function create_comment($post_id)
    {
        if ($this->auth) {
            $body             = $this->input->post('comment');
            $user_id          = $this->user_id;
            $comment          = $this->comment_model->create_comment($post_id, $user_id, $body);
            $data['comments'] = array($this->comment_model->get_comments($post_id)[0]);
            $result           = $this->load->view('posts/comment_view', $data, true);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($result));

        }

    }

    public function get_posts()
    {
        if ($this->auth) {
            $role = $this->user_model->get_users($this->user_id)->role;

            if ($role === 'creator') {
                $posts = $this->post_model->get_posts_by_author($this->user_id);
            } else if ($role === 'admin') {
                $posts = $this->post_model->get_posts();
            }

            if (isset($posts)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($posts));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array(
                        'text' => 'Not Found',
                        'type' => 'Error 404',
                    )));
            }

        }
    }

    public function post_trash($id=null)
    {
        if(empty($id)){
            $post_id = json_decode($this->input->post('id'));
        } else {
            $post_id = json_decode($id);
        }
        $trash = $this->post_model->trash_post($post_id);
        if ($trash && $this->auth) {

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'text' => 'Success',
                    'type' => '200',
                )));

        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'text' => 'Error',
                    'type' => '500',
                )));
        }
    }


    public function post_restore()
    {
        $post_id = json_decode($this->input->post('id'));
        $restore = $this->post_model->restore_post($post_id);
        if ($restore && $this->auth) {

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'text' => 'Success',
                    'type' => '200',
                )));

        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'text' => 'Error',
                    'type' => '500',
                )));
        }
    }

    public function delete_posts()
    {
        if ($this->auth) {
            $post_id = $this->input->post('id');
            $role    = $this->user_model->get_users($this->user_id)->role;

            if (($role === 'admin') || ($this->user_id == $this->post_model->get_post($post_id)->user_id)) {
                $this->comment_model->delete_comment(null, $post_id);
                $delete = $this->post_model->delete_post($post_id);
            }

            if (isset($delete)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'text' => 'Success',
                        'type' => '200',
                    )));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode(array(
                        'text' => 'Error',
                        'type' => '500',
                    )));
            }
        }
    }

    public function get_categories()
    {
        if ($this->auth) {

            $role        = $this->user_model->get_users($this->user_id)->role;
            $permissions = $this->user_model->get_users($this->user_id)->special_permissions;

            if ($role === 'admin' && $permissions == 1) {
                $categories = $this->category_model->get_categories();
            }

            if (isset($categories)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($categories));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array(
                        'text' => 'Not Found',
                        'type' => 'Error 404',
                    )));
            }
        }
    }

    public function create_category()
    {
        if ($this->auth) {
            $role        = $this->user_model->get_users($this->user_id)->role;
            $permissions = $this->user_model->get_users($this->user_id)->special_permissions;

            if ($role === 'admin' && $permissions == 1) {

                if ($this->category_model->check_category_exists() === true) {
                    $create_category = $this->category_model->create_category();
                } else {
                    echo "false";
                }

            }

            if (isset($create_category)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'text' => 'Success',
                        'type' => '200',
                    )));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode(array(
                        'text' => 'Error',
                        'type' => '500',
                    )));
            }

        }
    }

    public function delete_category()
    {
        if ($this->auth) {
            $role        = $this->user_model->get_users($this->user_id)->role;
            $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
            $id          = $this->input->post('id');

            if ($role === 'admin' && $permissions == 1) {
                $delete_category = $this->category_model->delete_category($id);
            }

            if (isset($delete_category) && !empty($id)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'text' => 'Success',
                        'type' => '200',
                    )));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode(array(
                        'text' => 'Error',
                        'type' => '500',
                    )));
            }
        }
    }

    public function comment_action()
    {
        if ($this->auth) {

            $role = $this->user_model->get_users($this->user_id)->role;

            if ($role === 'admin') {
                $comment_id = $this->input->post('id');
                if (!empty($comment_id)) {
                    $comment_action = $this->comment_model->hide_comments($comment_id);
                }
            }

            if (isset($comment_action)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'text' => 'Success',
                        'type' => '200',
                    )));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode(array(
                        'text' => 'Error',
                        'type' => '500',
                    )));
            }
        }
    }

    public function get_all_comments()
    {
        if ($this->auth) {

            $role = $this->user_model->get_users($this->user_id)->role;

            if ($role === 'admin') {
                $comments = $this->comment_model->get_all_comments();
            }

            if (isset($comments)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($comments));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode(array(
                        'text' => 'Not Found',
                        'type' => 'Error 404',
                    )));
            }
        }
    }

    public function delete_comment()
    {
        if ($this->auth) {
            $comment_id = json_decode($this->input->post('id'));
            $role       = $this->user_model->get_users($this->user_id)->role;
            $user_id    = $this->comment_model->get_comment($comment_id)->user_id;

            if (($role === 'admin') || ($this->user_id == $user_id)) {
                $delete_comment = $this->comment_model->delete_comment($comment_id);
            }

            if (isset($delete_comment)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(array(
                        'text' => 'Success',
                        'type' => '200',
                    )));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode(array(
                        'text' => $this->input->post('id'),
                        'type' => '500',
                    )));
            }
        }
    }

    public function about()
    {
        if ($this->auth) {
            $role        = $this->user_model->get_users($this->user_id)->role;
            $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
            if ($role === 'admin' && $permissions == 1) {
                $text   = $this->input->post('text');
                $update = $this->page_model->update_about($text);
            }
        }
        if (isset($update)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'text' => 'Success',
                    'type' => '200',
                )));

        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'text' => 'Error',
                    'type' => '500',
                )));
        }
    }

    public function contact()
    {
        if ($this->auth) {
            $role        = $this->user_model->get_users($this->user_id)->role;
            $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
            if ($role === 'admin' && $permissions == 1) {
                $update = $this->page_model->update_contact();
            }
        }
        if (isset($update)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'text' => 'Success',
                    'type' => '200',
                )));

        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'text' => 'Error',
                    'type' => '500',
                )));
        }
    }

    public function social_network_delete()
    {
        if ($this->auth) {
            $role        = $this->user_model->get_users($this->user_id)->role;
            $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
            if ($role === 'admin' && $permissions == 1) {
                $id     = json_decode($this->input->post('id'));
                $delete = $this->post_model->social_network_delete($id);
            }
        }

        if (isset($delete)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'text' => 'Success',
                    'type' => '200',
                )));

        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode(array(
                    'text' => 'Error',
                    'type' => '500',
                )));
        }
    }

    public function get_subscribers()
    {
        if ($this->auth) {

            $subscribers = $this->user_model->subscribers();

            if (isset($subscribers)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode($subscribers));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(array(
                        'text' => 'Not Found',
                        'type' => 'Error 404',
                    )));
            }
        }
    }

}
