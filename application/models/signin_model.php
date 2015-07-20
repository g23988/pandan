<?php
class Signin_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		
		}
	
	public function loadinfo_username($username){
		$query = $this->db->get_where('user',array('Account'=>$username));
		return $query->row_array();	
		}
	
	//讀取全域設定
	public function loadinfo_systemsetting(){
		$query = $this->db->get('system');
		return $query->row_array();	
		}
	
	
	}

?>