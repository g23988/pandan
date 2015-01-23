<?php
class Clone_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function selectCloneHost($newhostname,$hostid){
		$query = $this->db->get_where('host',array('HostID'=>$hostid),1);
		return $query->row();
		}
		/*
	public function get_bgs(){
		$query = $this->db->get('bg');
		return $query->result_array();
		}
	public function delete_bgs($bgid){
		$query = $this->db->delete('bg', array('BgID' => $bgid)); 
		}
	public function insert_bgs(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('bgname'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('bg',$data);
		
		}
		*/
	}

?>