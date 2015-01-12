<?php
class User_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_users(){
		$this->db->select('*,user.Name as Name,usergroup.Name as groupname,user.Nickname as Nickname');
		$this->db->from('user');
		$this->db->join('usergroup','usergroup.GroupID = user.GroupID');
		$query = $this->db->get();
		return $query->result_array();
		}
	public function delete_users($userid){
		$query = $this->db->delete('user', array('UserID' => $userid)); 
		}
	public function insert_users(){
		$username = $this->session->userdata('username');
		$data = array(
			'Account' => $this->input->post('account'),
			'Name'=> $this->input->post('name'),
			'Nickname' => $this->input->post('nickname'),
			'GroupID' => $this->input->post('groupname'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $username,
			'Createuser' => $username
		);
		return $this->db->insert('user',$data);
		
		}
	public function update_users(){
		//使用者自行更新資料
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
				'Name' => $this->input->post('name'),
				'Nickname' => $this->input->post('nickname'),
				'Email' => $this->input->post('email'),
				'GroupID' => $this->input->post('groupid'),
				'Modifytime' => date('Y-m-d H:i:s',time()),
				'Modifyuser' => $userinfo['Name']
			);
		$userid = $this->input->post('userid');
		$this->db->update('user',$data,array('UserID'=>$userid));
		
		}
	}

?>