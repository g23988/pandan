<?php
class Listadmin_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	//datatypes
	public function get_datatypes(){
		$query = $this->db->get('datatype');
		return $query->result_array();
		}
	public function delete_datatypes($DataTypeID){
		$query = $this->db->delete('datatype', array('DataTypeID' => $DataTypeID)); 
		}
	public function insert_datatypes(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('datatypename'),
			'Description'=>$this->input->post('description'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('datatype',$data);
		
		}
	//datatype end
	//settingtype
	public function get_settingtypes(){
		$query = $this->db->get('settingtype');
		return $query->result_array();
		}
	public function delete_settingtypes($SettingTypeID){
		$query = $this->db->delete('settingtype', array('SettingTypeID' => $SettingTypeID)); 
		}
	public function insert_settingtypes(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('settingtypename'),
			'Description'=>$this->input->post('description'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('settingtype',$data);
		
		}
	//settingtype end
	//logtype
	public function get_logtypes(){
		$query = $this->db->get('logtype');
		return $query->result_array();
		}
	public function delete_logtypes($LogTypeID){
		$query = $this->db->delete('logtype', array('LogTypeID' => $LogTypeID)); 
		}
	public function insert_logtypes(){
		$username = $this->session->userdata('username');
		$data = array(
			'Name'=> $this->input->post('logtypename'),
			'Description'=>$this->input->post('description'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username
		);
		return $this->db->insert('logtype',$data);
		
		}
	//logtype end
	}

?>