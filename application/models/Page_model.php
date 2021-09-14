<?php
	class Page_model extends CI_Model{
		public function __construct(){
			$this->load->database();

		}

		public function about(){
			$this->db->select('*')
			->from('pages')
			->where('slug','about-us');
			return $this->db->get()->row();
		}

		public function update_about($text){
			$data = array(
				'text' => $text,
			);
			$this->db->where('id',1);
			return $this->db->update('pages',$data);
		}

		public function contact(){
			$this->db->select('*')
			->from('pages')
			->where('slug','contact-us');
			return $this->db->get()->row();
		}

		public function update_contact(){
			$data = array(
				'address' => $this->input->post('address'),
				'phone_number' => $this->input->post('phone_number'),
				'email' => $this->input->post('email'),
			);
			$this->db->where('id',2);
			return $this->db->update('pages',$data);
		}

	}
