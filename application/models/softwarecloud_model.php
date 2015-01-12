<?php
class Softwarecloud_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_softwareclouds(){
		$query = $this->db->get('softwarecloud');
		return $query->result_array();
		}
	public function delete_softwareclouds($cloudid){
		$query = $this->db->delete('softwarecloud', array('CloudID' => $cloudid)); 
		}
	public function insert_softwareclouds(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('cloudname'),
			'Description'=>$this->input->post('description'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('softwarecloud',$data);
		
		}
	}

?>