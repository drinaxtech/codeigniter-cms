<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->model('comment_model');
        $this->load->model('user_model');
        $this->load->model('category_model');
        $data['categories'] = $this->post_model->get_categories();

    }

    public function index()
    {

        $per_page      = 3;
        $data['title'] = 'home';
        $count         = $this->post_model->paginationRows();
        $pages         = ceil($count / $per_page);
        $data['limit'] = $pages;
        $data['api']   = 'get_posts';
        $data['posts'] = $this->post_model->get_posts(null, null, $per_page, 0);

        $this->load->view('layouts/header', $data);
        $this->load->view('posts/index');
        $this->load->view('layouts/footer');

    }

    public function view($slug = null, $id = null)
    {
        $slug       = $this->uri->segment(2);
        $id         = $this->uri->segment(3);
        $ip_address = $this->input->ip_address();
        $this->get_view_count($ip_address, $id);

        $data['post'] = empty($this->post_model->get_posts($slug, $id)) ? show_404() : $this->post_model->get_posts($slug, $id);
        if ($this->session->userdata('logged_in')) {
            $user_id      = $this->session->userdata('user_id');
            $data['role'] = $this->user_model->get_users($user_id)->role;
        } else {
            $data['role'] = "";
        }

        $category_id = $data['post']['category_id'];
        $post_id     = $data['post']['post_id'];

        $data['recents'] = $this->post_model->get_posts_by_category($category_id, $post_id);
        $author = $this->post_model->get_author($post_id);
        $full_name      = ucfirst($author->name) . " " . ucfirst($author->surname);
        $data['author'] = $full_name;
        $data['username'] = $author->username;
        $data['comments_count'] = count($this->comment_model->get_comments($post_id));

        if (empty($data['post'])) {
            show_404();
        }

        $data['title']         = $data['post']['title'];
        $data['post_category'] = $this->post_model->get_categories($data['post']['category_id'])[0]['name'];
        $data['category_slug'] = $this->post_model->get_categories($data['post']['category_id'])[0]['slug'];

        $this->load->view('layouts/header', $data);
        $this->load->view('posts/view');
        $this->load->view('layouts/footer');

    }

    public function search()
    {
        $string         = $this->input->get('post');
        $posts          = empty($string) ? show_404() : 'posts';
        $data['title']  = "Search Result for '$string'";
        $per_page       = 3;
        $count          = empty($this->post_model->post_search($string)) ? 0 : count($this->post_model->post_search($string));
        $pages          = ceil($count / $per_page);
        $data['limit']  = $pages;
        $data['api']    = 'post_search/' . $string;
        $data['string'] = $string;

        if (!empty($this->input->get("page"))) {
            $page = json_decode($this->input->get("page"));
            if ($page <= $pages) {

                $offset        = $page * $per_page - $per_page;
                $data['posts'] = $this->post_model->post_search($string, $per_page, $offset);
                $result        = $this->load->view('posts/post', $data);
                echo json_encode($result);
            }

        } else {
            $data[$posts] = empty($string) ? null : $this->post_model->post_search($string, $per_page, 0);
            $this->load->view('layouts/header', $data);
            $this->load->view('posts/search');
            $this->load->view('layouts/footer');
        }

    }

    public function delete($id = null)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;

        if (!empty($this->input->post('id'))) {
            $id = $this->input->post('id');
        }

        $author_id = $this->post_model->get_posts(null, $id)[0]['user_id'];
        if ($user_id != $author_id && $role !== 'admin') {
            show_404();
        }
        $this->post_model->trash_post($id);
        $this->session->set_flashdata('post_deleted', 'Your post has been deleted');
        redirect('');
    }

    public function restore()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;

        if ($role !== 'admin') {
            show_404();
        }
        var_dump($this->input->post('id'));
        if (!empty($this->input->post('id'))) {
            $post_id = $this->input->post('id');
            $this->post_model->restore_post($post_id);
        }
    }

    public function update($id = null)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $role    = $this->user_model->get_users($user_id)->role;

        if (($role !== 'admin') && ($this->session->userdata('user_id') != $this->post_model->get_posts(null, $id)[0]['user_id'])) {
            show_404();
        }

        $this->post_model->update_post($id);

        $this->session->set_flashdata('post_updated', 'Your post has been updated');
        redirect('dashboard/posts');

    }

    public function category($slug = null)
    {
        $per_page           = 3;
        $data['categories'] = $this->post_model->get_categories();
        $category           = ($this->post_model->get_categories($slug)) ? $this->post_model->get_categories($slug)[0] : show_404();
        $data['title']      = "Posts in category '" . ucfirst($category['name']) . "'";
        $count              = count($this->post_model->get_posts_by_category($slug));
        $pages              = ceil($count / $per_page);
        $data['limit']      = $pages;
        $data['api']        = 'get_posts_by_category/' . $slug;
        $data['posts']      = $this->post_model->get_posts_by_category($slug, null, $per_page, 0);
        $this->load->view('layouts/header', $data);
        $this->load->view('posts/index');
        $this->load->view('layouts/footer');
    }

    public function user($username = null)
    {
        $data['title'] = 'Posts by ' . $username;
        $user_id       = (!empty($this->user_model->get_users($username))) ? $this->user_model->get_users($username)->user_id : show_404();
        $data['posts'] = (!empty($this->post_model->get_posts_by_author($user_id))) ? $this->post_model->get_posts_by_author($user_id) : show_404();
        $per_page      = 3;
        $count         = count($data['posts']);

        if ($count == 0) {
            $data['nothing'] = 'Nothing Found!';
        }

        $pages         = ceil($count / $per_page);
        $data['limit'] = $pages;
        $data['api']   = 'get_posts_by_author/' . $user_id;

        if (!empty($this->input->get("page"))) {
            $page = json_decode($this->input->get("page"));
            if ($page <= $pages) {

                $offset        = $page * $per_page - $per_page;
                $data['posts'] = $this->post_model->get_posts_by_author($user_id, $per_page, $offset);
                $result        = $this->load->view('posts/post', $data);

                echo json_encode($result);
            }

        } else {
            $data['posts'] = $this->post_model->get_posts_by_author($user_id, $per_page, 0);
            $this->load->view('layouts/header', $data);
            $this->load->view('posts/index');
            $this->load->view('layouts/footer');
        }
    }

    public function get_view_count($ip_address, $post_id)
    {
        $this->post_model->post_views_count($ip_address, $post_id);
    }

}
