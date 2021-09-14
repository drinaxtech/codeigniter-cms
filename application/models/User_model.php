<?php
class User_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->library('bcrypt');
    }
    public function register()
    {

        $data = array(
            'name'     => $this->input->post('name'),
            'surname'  => $this->input->post('surname'),
            'email'    => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $this->bcrypt->hash_password($this->input->post('password')),
            'role_id'  => 1,
        );
        return $this->db->insert('users', $data);
    }

    public function get_users($user)
    {
        if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
            $field = (is_numeric($user)) ? 'id' : 'username';
        } else {
            $field = 'email';
        }

        $this->db->select('*,users.id as user_id');
        $this->db->join('users', 'users.role_id = roles.id');
        $query = $this->db->get_where('roles', array('users.' . $field => $user));
        return $query->row();
    }

    public function get_all_users()
    {
        $this->db->select('*,users.id as user_id');
        $this->db->join('roles', 'roles.id = users.role_id');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function update_user($id, $role_id)
    {
        if (!empty($this->input->post('password'))) {
            $data = array(
                'name'     => $this->input->post('name'),
                'surname'  => $this->input->post('surname'),
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'role_id'  => $role_id,
                'password' => $this->bcrypt->hash_password($this->input->post('password')),
            );
        } else {
            $data = array(
                'name'     => $this->input->post('name'),
                'surname'  => $this->input->post('surname'),
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'role_id'  => $role_id,
            );
        }
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function get_roles()
    {
        $query = $this->db->get('roles');
        return $query->result_array();
    }

    public function check_username_exists($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function check_subscriber_exists($email)
    {
        $query = $this->db->get_where('subscribers', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        }
        return false;
    }

    public function subscribe($email)
    {
        $data = array(
            'email' => urldecode($email),
        );
        if($this->check_subscriber_exists(urldecode($email))){
        	return $this->db->insert('subscribers', $data);
        }
        return false;
    }

    public function subscribers()
    {
        $query = $this->db->get('subscribers');
        return $query->result_array();
    }

}
