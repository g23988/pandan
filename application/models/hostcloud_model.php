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
	public function update_hostclouds(){
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'Name' => htmlentities($this->input->post('editcloudname')),
			'Location' => htmlentities($this->input->post('editlocation')),
			'Description' => htmlentities($this->input->post('editdescription')),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $userinfo['UserID']
		);
		$this->db->update('hostcloud',$data,array("cloudid"=>$this->input->post('editcloudid')));
		}
	public function insert_hostclouds(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('cloudname'),
			'Location'=> $this->input->post('location'),
			'Description'=>$this->input->post('description'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('hostcloud',$data);
		
		}
	}

?>