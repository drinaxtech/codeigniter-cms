<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('category_model');
		$this->load->model('post_model');
		$this->load->model('comment_model');
	}

	public function get_posts($page){
		$per_page = 3;
		$count = $this->post_model->paginationRows();
		$pages = ceil($count/$per_page);
		if($page)
		{
			if($page <= $pages) {
				$offset = $page * $per_page - $per_page;
				$data['posts'] = $this->post_model->get_posts(NULL, NULL, $per_page, $offset);
				$result = $this->load->view('posts/post', $data,true);
				if( isset($result) ) {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($result));
				} else {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
						'text' => 'Not Found',
						'type' => 'Error 404'
					)));
				}
			}
		}
	}

	public function post_search($string, $page){
		$per_page = 3;
		$string = urldecode($string);
		$count = count($this->post_model->post_search($string));
		$pages = ceil($count/$per_page);
		if($page)
		{
			if($page <= $pages) {
				$offset = $page * $per_page - $per_page;
				$data['posts'] = $this->post_model->post_search($string,$per_page,$offset);
				$result = $this->load->view('posts/search_view', $data,true);
				if( isset($result) ) {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($result));
				} else {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
						'text' => 'Not Found',
						'type' => 'Error 404'
					)));
				}
			}
		}
	}

	public function get_posts_by_category($slug,$page){
		$per_page = 3;
		$count = count($this->post_model->get_posts_by_category($slug));
		$pages = ceil($count/$per_page);
		if($page)
		{
			if($page <= $pages) {
				$offset = $page * $per_page - $per_page;
				$data['posts'] = $this->post_model->get_posts_by_category($slug, NULL, $per_page, $offset);
				$result = $this->load->view('posts/post', $data,true);
				if( isset($result) ) {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($result));
				} else {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
						'text' => 'Not Found',
						'type' => 'Error 404'
					)));
				}
			}
		}
	}

		public function get_posts_by_author($user_id, $page){
		$per_page = 3;
		$count = count($this->post_model->get_posts_by_author($user_id));
		$pages = ceil($count/$per_page);
		if($page)
		{
			if($page <= $pages) {
				$offset = $page * $per_page - $per_page;
				$data['posts'] = $this->post_model->get_posts_by_author($user_id, $per_page, $offset);
				$result = $this->load->view('posts/post', $data,true);
				if( isset($result) ) {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($result));
				} else {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
						'text' => 'Not Found',
						'type' => 'Error 404'
					)));
				}
			}
		}
	}

    
    public function get_comments($post_id,$page){
		$per_page = 4;
		$count = count($this->comment_model->get_comments($post_id));
		$pages = ceil($count/$per_page);
		if($page)
		{
			if($page <= $pages) {
				$offset = $page * $per_page - $per_page;
				$data['comments'] = $this->comment_model->get_comments($post_id,$per_page,$offset);;
				$result = $this->load->view('posts/comment_view', $data,true);
				if( isset($result) ) {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($result));
				} else {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
						'text' => 'Not Found',
						'type' => 'Error 404'
					)));
				}
			}
		}
	}

	public function get_categories($page)
	{
		$data['title'] = 'Categories';
		$per_page = 6;
		$count = count($this->category_model->get_categories());
		$pages = ceil($count/$per_page);
		$data['limit'] = $pages;

		if($page)
		{
			if($page <= $pages) {
				$offset = $page * $per_page - $per_page;
				$data['categories'] = $this->category_model->get_categories($per_page, $offset);
				$result = $this->load->view('categories/category_view', $data,true);
				if( isset($result) ) {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($result));
				} else {
					return $this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode(array(
						'text' => 'Not Found',
						'type' => 'Error 404'
					)));
				}
			}
		}
	}
}