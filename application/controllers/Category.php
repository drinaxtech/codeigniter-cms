<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('user_model');
        $this->load->model('post_model');
        $data['social_networks'] = $this->post_model->get_social_networks();
    }

    public function create()
    {
        if ($this->category_model->check_category_exists() === true) {
            $this->category_model->create_category();
        } else {
            echo "false";
        }

    }

    public function categories()
    {
        $data['title']      = 'Categories';
        $data['categories'] = $this->category_model->get_categories();
        $per_page           = 6;
        $count              = count($data['categories']);
        $pages              = ceil($count / $per_page);
        $data['limit']      = $pages;
        $data['categories'] = $this->category_model->get_categories($per_page, 0);

        $this->load->view('layouts/header', $data);
        $this->load->view('categories/categories');
        $this->load->view('layouts/footer');

    }

    public function delete($id = null)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id     = $this->session->userdata('user_id');
        $role        = $this->user_model->get_users($user_id)->role;
        $permissions = $this->user_model->get_users($user_id)->special_permissions;

        if ($role !== 'admin' || $permissions != 1) {
            show_404();
        }

        if (!empty($this->input->post('id'))) {
            $id = $this->input->post('id');
        }

        $this->category_model->delete_category($id);
    }

}
