<?php
	class Category_model extends CI_Model{
		public function __construct(){
			$this->load->database();
			$this->load->model('post_model');
		}

		public function create_category(){
			$slug = preg_replace('!\s+!', '-', $this->input->post('category'));
			$data = array(
				'name' => $this->input->post('category'),
				'slug' => $slug
			);

			return $this->db->insert('categories', $data);
		}

		public function get_categories($limit = null, $offset = null){
			if($limit)
			{
				$this->db->limit($limit, $offset);
			}
			$this->db->select('*,slug as category_slug')
			->from('categories');
			$categories = $this->db->get()->result_array();
			if(!empty($categories))
			{
				foreach($categories as $key => &$val){
					$id = $categories[$key]['id'];
					$val['post_count'] = $this->get_posts_count($id);
				}
				return $categories;
			}
		}

		public function get_last_categories(){
			$this->db->limit(10, 0);
			$this->db->select('id, name, slug')
			->from('categories');
			$categories = $this->db->get()->result_array();
			if(!empty($categories))
			{
				foreach($categories as $key => &$val){
					$id = $categories[$key]['id'];
					$val['post_count'] = $this->get_posts_count($id);
				}

				$sort = array();
				foreach ($categories as $key => $row)
				{
					$sort[$key] = $row['post_count'];
				}
				array_multisort($sort, SORT_DESC, $categories);
				return $categories;
			}



		}

		public function get_category($category_id){
			$this->db->select('*')
			->from('categories')
			->where('id',$category_id);
			$categories = $this->db->get()->result_array();
			return $categories[0];
		}

		public function get_posts_count($category_id){
			$this->db->select('*')
			->from('posts')
			->where('category_id',$category_id);
			$post_count =$this->db->get()->result_array();
			return count($post_count);
		}

		public function get_posts($slug){
			$posts = $this->post_model->get_posts_by_category($slug);
			return $posts;
		}

		public function update_category($category_id){
			$this->db->where('id',$category_id);
			return $this->db->update('categories');
		}

		public function delete_category($category_id){
			$this->db->where('id', $category_id);
			$this->db->delete('categories');
			return true;
		}

		public function check_category_exists(){
			$query = $this->db->get_where('categories', array('name' => $this->input->post('category') ));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}
	}
