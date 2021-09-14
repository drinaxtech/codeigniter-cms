<?php
class Post_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_posts($slug = null, $id = null, $limit = null, $offset = null)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        if ($slug === null) {
            $this->db->select('*,posts.id as post_id,posts.slug as post_slug')
            ->order_by('posts.created_at', 'DESC')
            ->join('categories', 'categories.id = posts.category_id');

            if (!empty($id)) {
                $this->db->where('posts.id', $id);
            }

            $query = $this->db->get_where('posts', array('trash' => 0));
            $posts = $query->result_array();

            foreach ($posts as $key => &$val) {
                $post_id         = $posts[$key]['post_id'];
                $full_name       = ucfirst($this->get_author($post_id)->name) . " " . ucfirst($this->get_author($post_id)->surname);
                $val['author']   = $full_name;
                $val['username'] = $this->get_author($post_id)->username;
            }
            return $posts;

        } else if (!empty($id) && !empty($slug)) {

            $where = array('posts.id' => $id, 'posts.slug' => $slug);
            $this->db->select('*,posts.id as post_id,posts.slug as post_slug')->from('posts')->where($where);
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    public function notification()
    {
        $this->db->select('*,posts.id as post_id')->from('posts')->join('users', 'users.id = posts.user_id')->where('notification_view', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_notification()
    {
        $this->db->where('notification_view', 0);
        $this->db->set('notification_view', 1);
        return $this->db->update('posts');
    }

    public function paginationRows()
    {
        $query = $this->db->where('trash', 0)->get('posts');
        return $query->num_rows();
    }

    public function post_search($string = null, $limit = null, $offset = null)
    {

        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }

        $this->db->select('*,posts.id as post_id,posts.slug as post_slug');
        $this->db->or_like('title', $string);
        $this->db->or_like('body', $string);
        $this->db->or_like('name', $string);
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->join('categories', 'categories.id = posts.category_id');
        $query = $this->db->get('posts');
        $posts = $query->result_array();

        if (!empty($posts)) {
            foreach ($posts as $key => &$val) {
                $post_id         = $posts[$key]['post_id'];
                $val['author']   = $this->get_author($post_id);
                $full_name       = ucfirst($this->get_author($post_id)->name) . " " . ucfirst($this->get_author($post_id)->surname);
                $val['author']   = $full_name;
                $val['username'] = $this->get_author($post_id)->username;
            }
            return $posts;
        }
    }

    public function get_author($post_id)
    {
        if (!empty($post_id)) {
            $this->db->join('users', 'users.id = posts.user_id');
            $query     = $this->db->get_where('posts', array('posts.id' => $post_id));
            return $query->row();
        }
    }

    public function create_post($post_image)
    {
        $limit = character_limiter($this->input->post('title'), 50);
        $slug  = url_title($limit);

        $data = array(
            'title'       => $this->input->post('title'),
            'slug'        => $slug,
            'body'        => $this->input->post('body'),
            'category_id' => $this->input->post('category_id'),
            'user_id'     => $this->session->userdata('user_id'),
            'post_image'  => $post_image,
        );

        return $this->db->insert('posts', $data);
    }

    public function delete_post($id)
    {

        $image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
        if ($image_file_name !== 'noimage.png') {
            $cwd             = getcwd();
            $image_file_path = $cwd . "\\assets\\images\\posts\\";
            chdir($image_file_path);
            unlink($image_file_name);
            chdir($cwd);
        }

        $this->db->where('id', $id);
        $this->db->delete('posts');
        return true;
    }

    public function trash_post($id)
    {
        $data = array(
            'trash' => 1,
        );
        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    public function restore_post($id)
    {
        $data = array(
            'trash' => 0,
        );
        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    public function update_post($id)
    {
        $slug = url_title($this->input->post('title'));

        $data = array(
            'title'       => $this->input->post('title'),
            'slug'        => $slug,
            'body'        => $this->input->post('body'),
            'category_id' => $this->input->post('category_id'),
        );

        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    public function get_categories($value = null)
    {
        $item = is_numeric($value) ? 'id' : 'slug';
        if ($value !== null) {
            $this->db->where($item, $value);
        }
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function get_posts_by_category($category = null, $post_id = null, $limit = null, $offset = null)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->select('*,posts.id as post_id,posts.slug as post_slug,categories.slug as category_slug');
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->join('categories', 'categories.id = posts.category_id');
        if (!empty($post_id)) {
            $this->db->where('posts.id <>', $post_id);
        }
        $item  = is_numeric($category) ? 'categories.id' : 'categories.slug';
        $query = $this->db->get_where('posts', array(
            $item   => $category,
            'trash' => 0,
        ));
        $posts = $query->result_array();
        foreach ($posts as $key => &$val) {
            $post_id         = $posts[$key]['post_id'];
            $full_name       = ucfirst($this->post_model->get_author($post_id)->name) . " " . ucfirst($this->post_model->get_author($post_id)->surname);
            $val['author']   = $full_name;
            $val['username'] = $this->post_model->get_author($post_id)->username;
        }
        return $posts;
    }

    public function get_posts_by_author($user_id = null, $limit = null, $offset = null)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $this->db->select('*,posts.id as post_id,posts.slug as post_slug');
        $this->db->order_by('posts.created_at', 'DESC');
        $this->db->join('categories', 'categories.id = posts.category_id');
        $query = $this->db->get_where('posts', array('trash' => 0, 'user_id' => $user_id));
        $posts = $query->result_array();
        foreach ($posts as $key => &$val) {
            $post_id         = $posts[$key]['post_id'];
            $val['author']   = $this->get_author($post_id);
            $full_name       = ucfirst($this->get_author($post_id)->name) . " " . ucfirst($this->get_author($post_id)->surname);
            $val['author']   = $full_name;
            $val['username'] = $this->get_author($post_id)->username;
        }
        return $posts;

    }

    public function get_trashed_posts()
    {
        $this->db->select('*,posts.id as post_id');
        $this->db->join('categories', 'categories.id = posts.category_id');
        $query = $this->db->get_where('posts', array('trash' => 1));
        $posts = $query->result_array();
        foreach ($posts as $key => &$val) {
            $post_id         = $posts[$key]['post_id'];
            $val['username'] = $this->get_author($post_id)->username;
        }
        return $posts;
    }

    public function post_views_count($ip, $post)
    {
        $name   = 'ip' . $post;
        $expire = 24 * 60 * 60;
        if (empty(get_cookie($name))) {
            $ip_address = array(
                'name'   => $name,
                'value'  => $ip,
                'expire' => $expire,
            );
            $this->input->set_cookie($ip_address);
            $this->db->where('id', $post);
            $this->db->set('views', 'views+1', false);
            return $this->db->update('posts');
        }
    }

    public function get_social_networks($id = null)
    {
        $this->db->select('*');
        if (!empty($id)) {
            $query = $this->db->get_where('social_networks', array('id' => $id));
            return $query->row();
        } else {
            $query = $this->db->get('social_networks');
            return $query->result_array();
        }

    }

    public function create_social_network()
    {
        $data = array(
            'name'    => $this->input->post('name'),
            'fa_icon' => $this->input->post('fa_icon'),
            'link'    => $this->input->post('link'),
        );
        return $this->db->insert('social_networks', $data);
    }

    public function update_social_network()
    {
        $data = array(
            'name'    => $this->input->post('name'),
            'fa_icon' => $this->input->post('fa_icon'),
            'link'    => $this->input->post('link'),
        );
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('social_networks', $data);
    }

    public function social_network_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('social_networks');
        return true;
    }

}
