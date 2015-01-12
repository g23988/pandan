<?php
class Hostcloud_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		date_default_timezone_set('Asia/Taipei');
		}
	public function get_hostclouds(){
		$query = $this->db->get('hostcloud');
		return $query->result_array();
		}
	public function delete_hostclouds($cloudid){
		$query = $this->db->delete('hostcloud', array('CloudID' => $cloudid)); 
		}
	public function insert_hostclouds(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('cloudname'),
			'Description'=>$this->input->post('description'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('hostcloud',$data);
		
		}
	}

?>