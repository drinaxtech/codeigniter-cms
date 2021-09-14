<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
		public function __construct(){
			parent::__construct();
			$this->load->model('user_model');
			$this->load->model('post_model');
			$this->load->model('page_model');
		}

		public function about(){
			$data['title'] = 'About Us';
			$data['about'] = $this->page_model->about();
			$data['social_networks'] = $this->post_model->get_social_networks();
			$this->load->view('layouts/header',$data);
			$this->load->view('pages/about-us');
			$this->load->view('layouts/footer');

		}

		public function contact(){
			$data['title'] = 'Contact Us';
			$data['contact'] = $this->page_model->contact();
			$data['social_networks'] = $this->post_model->get_social_networks();
			$this->load->view('layouts/header',$data);
			$this->load->view('pages/contact-us');
			$this->load->view('layouts/footer');

		}


	}