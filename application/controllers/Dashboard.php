<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('post_model');
        $this->load->model('category_model');
        $this->load->model('comment_model');
        $this->load->model('page_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->user_id          = $this->session->userdata('user_id');
        $this->data['user_id']  = $this->user_id;
        $this->role             = $this->user_model->get_users($this->user_id)->role;
        $this->data['username'] = $this->user_model->get_users($this->user_id)->username;

        if ($this->role === 'user') {
            show_404();
        }

        $this->data['post_notifications'] = $this->post_model->notification();

    }

    public function index()
    {
        $this->data['title']            = "Home";
        $this->data['posts_count']      = count($this->post_model->get_posts());
        $this->data['comments_count']   = count($this->comment_model->get_all_comments());
        $this->data['users_count']      = count($this->user_model->get_all_users()) - 1;
        $this->data['categories_count'] = count($this->category_model->get_categories());
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/index');
        $this->load->view('dashboard/layouts/footer');
    }

    public function get_all_posts()
    {

        if ($this->role !== 'admin') {
            $user_id     = $this->user_id;
            $category_id = $this->input->post('category');
            if (empty($category_id)) {
                echo json_encode($this->post_model->get_posts_by_author($user_id));
            } else {
                echo json_encode($this->post_model->get_posts_by_category($category_id, $user_id));
            }
        } else {
            $user_id     = null;
            $category_id = $this->input->post('category');
            if (empty($category_id)) {
                echo json_encode($this->post_model->get_posts($user_id));
            } else {
                echo json_encode($this->post_model->get_posts_by_category($category_id, $user_id));
            }
        }
    }

    public function posts()
    {
        $this->data['title']      = 'Posts';
        $this->data['categories'] = $this->post_model->get_categories();
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/posts/index');
        $this->load->view('dashboard/layouts/footer');
    }

    public function create_post()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;

        if ($role === 'user') {
            show_404();
        }

        $this->data['title'] = 'Create Post';

        $this->data['categories'] = $this->post_model->get_categories();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('dashboard/layouts/header', $this->data);
            $this->load->view('dashboard/posts/create');
            $this->load->view('dashboard/layouts/footer');
        } else {
            $config['upload_path']   = './assets/images/posts';
            $config['allowed_types'] = 'gif|jpg|png|webp';
            $config['max_size']      = '2048';
            $config['max_width']     = '2000';
            $config['max_height']    = '2000';
            $post_image              = $_FILES['userfile']['name'];
            $img_name_array          = explode(".", $post_image);
            $extension               = end($img_name_array);
            $img_name                = rand() . '.' . $extension;
            $config['file_name']     = $img_name;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $errors   = array('error' => $this->upload->display_errors());
                $img_name = 'noimage.png';
            } else {
                $this->data = array('upload_data' => $this->upload->data());
            }

            $this->post_model->create_post($img_name);

            $this->session->set_flashdata('post_created', 'Your post has been created');

            redirect('');
        }
    }

    public function post_edit($id = null)
    {
        $this->data['post'] = $this->post_model->get_posts(null, $id);
        if (($this->role !== 'admin') && ($this->session->userdata('user_id') != $this->post_model->get_posts(null, $id)[0]['user_id'])) {
            show_404();
        }

        $this->data['categories'] = $this->post_model->get_categories();

        if (empty($this->data['post'])) {
            show_404();
        }
        $this->data['title'] = 'Edit Post';

        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/posts/edit');
        $this->load->view('dashboard/layouts/footer');
    }

    public function get_all_trash_posts()
    {

        echo json_encode($this->post_model->get_trashed_posts());

    }

    public function post_trash()
    {
        $this->data['title']      = 'Trash Posts';
        $this->data['categories'] = $this->post_model->get_categories();
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/posts/trash');
        $this->load->view('dashboard/layouts/footer');
    }

    public function post_notification()
    {
        $this->post_model->update_notification();
    }

    public function preview()
    {
        $name    = ucfirst($this->user_model->get_users($this->user_id)->name);
        $surname = ucfirst($this->user_model->get_users($this->user_id)->surname);

        $posts = array(
            'id'          => '',
            'title'       => $this->input->post('title'),
            'body'        => $this->input->post('body'),
            'category_id' => $this->input->post('category_id'),
            'username'    => $this->data['username'],
            'user_id'     => $this->user_id,
            'post_image'  => 'noimage.png',
            'created_at'  => '',
        );

        $data['post_category'] = $this->post_model->get_categories($this->input->post('category_id'))[0]['name'];
        $data['title']         = "Preview - " . ucfirst($this->input->post('title'));
        $data['author']        = $name . " " . $surname;
        $data['post']          = $posts;
        $this->load->view('dashboard/layouts/header', $data);
        $this->load->view('posts/view');
        $this->load->view('dashboard/layouts/footer');

    }

    public function comments()
    {

        if ($this->role !== 'admin') {
            show_404();
        }

        $this->data['title'] = 'Comments';
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/comments/index');
        $this->load->view('dashboard/layouts/footer');
    }

    public function get_all_comments()
    {

        if ($this->role !== 'admin') {
            show_404();
        }
        echo json_encode($this->comment_model->get_all_comments());
    }

    public function get_all_users()
    {

        if ($this->role !== 'admin') {
            show_404();
        }

        $users = $this->user_model->get_all_users();
        foreach ($users as $user) {
            if ($user['user_id'] != $this->session->userdata('user_id')) {
                $all_users[] = $user;
            }
        }

        echo json_encode($all_users);
    }

    public function users()
    {

        if ($this->role !== 'admin') {
            show_404();
        }

        $this->data['title'] = 'Users';
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/users/index');
        $this->load->view('dashboard/layouts/footer');
    }

    public function user_edit($id = null)
    {
        if ($id !== $this->user_id) {
            show_404();
        }
        $this->data['user']  = $this->user_model->get_users($this->user_id);
        $this->data['title'] = 'Edit Your Account';
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/users/edit');
        $this->load->view('dashboard/layouts/footer');
    }

    public function user_update()
    {
        $role_id = $this->user_model->get_users($this->user_id)->role_id;
        $this->user_model->update_user($this->user_id, $role_id);
        $this->session->set_flashdata('user_updated', 'User info has been updated');
    }

    public function social_networks()
    {
        $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
        if ($this->role !== 'admin' || $permissions != 1) {
            show_404();
        }

        $this->data['title'] = 'Social Networks';
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/social_networks/index');
        $this->load->view('dashboard/layouts/footer');
    }

    public function social_network_edit($id = null)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $role    = $this->user_model->get_users($this->user_id)->role;
        $permissions = $this->user_model->get_users($this->user_id)->special_permissions;

        if ($role !== 'admin' || $permissions != 1) {
            show_404();
        }

        $data['social_network'] = $this->post_model->get_social_networks($id);

        if ($role === 'admin') {
            $data['roles'] = $this->user_model->get_roles();
        }
        $data['title'] = 'Edit Social Network';
        $this->load->view('dashboard/social_networks/edit', $data);
    }

    public function create_social_network($id = null)
    {

        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;

        if ($role !== 'admin') {
            show_404();
        }
        if (null !== $this->input->post('name')) {
            $this->post_model->create_social_network();
        } else {
            $data['title'] = 'Edit Social Network';
            $this->load->view('dashboard/social_networks/create');
        }
    }

    public function social_network_update()
    {
        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;
        $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
        $role    = ($role == 'admin' || $permissions != 1) ? $role : show_404();
        $this->post_model->update_social_network();
    }

    public function user_profile()
    {
        $this->data['title']       = 'User Profile';
        $this->data['user']        = $this->user_model->get_users($this->data['username']);
        $this->data['count_posts'] = count($this->post_model->get_posts_by_author($this->user_id));
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/users/profile');
        $this->load->view('dashboard/layouts/footer');
    }

    public function get_all_categories()
    {

        if ($this->role !== 'admin') {
            show_404();
        }

        echo json_encode($this->category_model->get_categories());

    }

    public function categories()
    {
        if ($this->role !== 'admin') {
            show_404();
        }

        $this->data['title']      = 'Categories';
        $this->data['categories'] = $this->category_model->get_categories();
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/categories/index');
        $this->load->view('dashboard/layouts/footer');
    }

    public function about()
    {
        $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
        if ($this->role !== 'admin' || $permissions != 1) {
            show_404();
        }

        $this->data['title'] = 'About Us';
        $this->data['about'] = $this->page_model->about();
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/pages/about');
        $this->load->view('dashboard/layouts/footer');
    }

    public function contact()
    {
        $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
        if ($this->role !== 'admin' || $permissions != 1) {
            show_404();
        }

        $this->data['title']   = 'Contact Us';
        $this->data['contact'] = $this->page_model->contact();
        $this->data['address'] = explode("; ", $this->data['contact']->address);
        $this->data['about']   = $this->page_model->about();
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/pages/contact');
        $this->load->view('dashboard/layouts/footer');
    }

    public function subscribers()
    {
        $permissions = $this->user_model->get_users($this->user_id)->special_permissions;
        if ($this->role !== 'admin' || $permissions != 1) {
            show_404();
        }
        $this->data['title'] = 'Subscribers';
        $this->load->view('dashboard/layouts/header', $this->data);
        $this->load->view('dashboard/subscribers/index');
        $this->load->view('dashboard/layouts/footer');
    }

}
