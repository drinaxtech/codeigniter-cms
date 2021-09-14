<?php
	class Comment_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_comment($post_id,$user_id,$body){
			$data = array(
				'body' => $body,
				'post_id' => $post_id,
				'user_id' => $user_id
			);

			return $this->db->insert('comments', $data);
		}

		public function get_comments($post_id,$limit = null, $offset = null){
			if($limit) {
				$this->db->limit($limit,$offset);
			}
			
			$this->db->select('*,comments.id as comment_id');
			$this->db->order_by('comments.created_at','DESC');
			$this->db->join('users','users.id = comments.user_id');
			$query = $this->db->get_where('comments', array(
				'post_id' => $post_id,
				'hide' => 0
			));
			return $query->result_array();
		}


		public function get_comment($id){
			$this->db->where('id',$id);
			$query = $this->db->get('comments');
			return $query->row();
		}

		public function get_all_comments(){

			$this->db->select('*,comments.id as comment_id, posts.slug as post_slug');
			$this->db->join('users','users.id = comments.user_id');
			$this->db->join('posts','posts.id = comments.post_id');
			$query = $this->db->get('comments');
			return $query->result_array();
		}

		public function delete_comment($comment_id = null,$post_id = null){
			if(!empty($comment_id)){
				$this->db->where('id', $comment_id);
			} else {
				$this->db->where('post_id', $post_id);
			}
			
			$this->db->delete('comments');
			return true;
		}

		public function hide_comments($id){
			$hide = $this->db->get_where('comments',array('id' => $id))->row()->hide;
			if($hide == 0){
				$value = 1;
			} else {
				$value = 0;
			}
			$data = array(
				'hide' => $value
			);
			$this->db->where('id', $id);
			return $this->db->update('comments', $data);
		}
	}