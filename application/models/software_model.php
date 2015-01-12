<?php
class Software_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_softwareclouds(){
		$query = $this->db->get('software');
		return $query->result_array();
		}
	public function get_wheresoftwares($softwareid){
		//單純讀取softwareid指定的software
		$query = $this->db->get_where('software',array('SoftwareID'=>$softwareid));
		return $query->row_array();
		}
	public function get_wheresoftwareclouds($cloudid){
		//透過指定cloudid讀取資料 left join softwarecloudid
		$this->db->select('*,software.Name as SoftwareName,softwarecloud.Name as CloudName');
		$this->db->from('software');
		$this->db->join('softwarecloud','software.CloudID = softwarecloud.CloudID');
		$this->db->where('software.cloudid',$cloudid);
		$query = $this->db->get();
		return $query->result_array();
		}
	public function update_softwares(){
		//透過指定的software id 更新資料
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
				'Name' => $this->input->post('softwarename'),
				'CloudID' => $this->input->post('softwarecloudid'),
				'Remark' => $this->input->post('remark'),
				'Modifytime' => date('Y-m-d H:i:s',time()),
				'Modifyuser' => $userinfo['UserID']
			);
		$softwareid = $this->input->post('softwareid');
		$this->db->update('software',$data,array('SoftwareID'=>$softwareid));
		}
	
	public function delete_softwares($softwareid){
		//指定軟體id刪除
		$query = $this->db->delete('software', array('SoftwareID' => $softwareid)); 
		}
	public function insert_softwares(){
		//新增軟體
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'Name' => $this->input->post('softwarename'),
			'CloudID' => $this->input->post('softwarecloudid'),
			'Remark' => $this->input->post('remark'),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $userinfo['UserID']
		);
		return $this->db->insert('software',$data);
		
		}
	}

?>