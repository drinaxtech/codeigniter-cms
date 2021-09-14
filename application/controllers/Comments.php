<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {
	
		public function __construct(){
			parent::__construct();
			$this->load->model('post_model');
			$this->load->model('comment_model');
			$this->load->model('user_model');
		}
		public function create($post_id){
			
			if(!$this->session->userdata('logged_in')){
				redirect('user/login');
			}

			$body = $this->input->post('comment');
			$user_id = $this->session->userdata('user_id');
			if(!empty($this->input->post('comment')))
			{
				$this->comment_model->create_comment($post_id,$user_id,$body);
			}

		}

		public function comments()
		{
			if(!$this->session->userdata('logged_in')){
				redirect('user/login');
			}
			$user_id = $this->session->userdata('user_id');
			$role = $this->user_model->get_users($user_id)->role;
			if($role !== 'admin'){
				show_404();
			}
			$data['title'] = 'Comments';
			$this->load->view('dashboard/layouts/header',$data);
			$this->load->view('dashboard/comments');
			$this->load->view('dashboard/layouts/footer');
		}

		public function findall(){
			if(!$this->session->userdata('logged_in')){
				show_404();
			}

			$user_id = $this->session->userdata('user_id');
			$role = $this->user_model->get_users($user_id)->role;

			if($role !== 'admin'){
				show_404();
			}

			echo json_encode($this->comment_model->get_all_comments());
		}

		public function hide(){
			if(!empty($this->input->post('id'))){
				$comment_id = $this->input->post('id');
				$this->comment_model->hide_comments($comment_id);
			}
		}

	}