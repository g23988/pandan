<?php
class Usergroup_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_groups(){
		$query = $this->db->get('usergroup');
		return $query->result_array();
		}
	public function delete_groups($groupid){
		$query = $this->db->delete('usergroup', array('GroupID' => $groupid)); 
		}
	public function insert_groups(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('groupname'),
			'Nickname'=> $this->input->post('nickname'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('usergroup',$data);
		
		}




	}

?>