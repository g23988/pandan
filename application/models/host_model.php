<?php
class Host_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_hostclouds(){
		$query = $this->db->get('host');
		return $query->result_array();
		}
	public function get_wherehosts($hostid){
		//單純讀取hostid指定的host
		$query = $this->db->get_where('host',array('HostID'=>$hostid));
		return $query->row_array();
		}
	public function get_wherehostclouds($hostid){
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		//透過指定cloudid讀取資料 left join hostcloudid
		$this->db->select('*,host.Name as HostName,hostcloud.Name as CloudName');
		$this->db->from('host');
		$this->db->join('hostcloud','host.CloudID = hostcloud.CloudID');
		$this->db->where('host.cloudid',$hostid);
		//管理者可以看到全部的資料
		if($username != 'admin'){
			$this->db->where('host.UserID',$userinfo['UserID']);
			
			}
		$query = $this->db->get();
		return $query->result_array();
		}
	public function update_hosts(){
		//透過指定的host id 更新資料
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
				'Name' => $this->input->post('hostname'),
				'CloudID' => $this->input->post('hostcloudid'),
				'UserID' => $this->input->post('userid'),
				'Remark' => $this->input->post('remark'),
				'Modifytime' => date('Y-m-d H:i:s',time()),
				'Modifyuser' => $userinfo['UserID']
			);
		$hostid = $this->input->post('hostid');
		$this->db->update('host',$data,array('HostID'=>$hostid));
		}
	
	public function delete_hosts($hostid){
		//指定主機id刪除
		$query = $this->db->delete('host', array('HostID' => $hostid)); 
		}
	public function insert_hosts(){
		//新增軟體
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'Name' => $this->input->post('hostname'),
			'CloudID' => $this->input->post('hostcloudid'),
			'UserID' => $userinfo['UserID'],
			'Remark' => $this->input->post('remark'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $userinfo['UserID']
		);
		return $this->db->insert('host',$data);
		
		}
	public function updateAllFlag(){
		//清空所有flag
		$data = array(
				'flag' => '0'
		);
		$this->db->update('host',$data);
		
		}
	}

?>