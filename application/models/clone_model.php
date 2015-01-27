<?php
class Clone_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function selectCloneHost($newhostname,$hostid){
		$query = $this->db->get_where('host',array('HostID'=>$hostid),1);
		return $query->row();
		}
	public function insertCloneHost($newhostinfo){
		$this->db->insert('host',$newhostinfo);
		$newhostid = $this->db->query("SELECT HostID from host order by HostID DESC limit 1");
		return $newhostid->row();
		//吐出新建的id
		}
		//取得複製前的software列表
	public function selectCloneSoftware($oldhostid){
		$query = $this->db->get_where('softwarepath',array('HostID'=>$oldhostid));
		return $query->result_array();
		}
	//複製software by oldhostid
	public function insertSoftwarepath($newsoftwarepathsinfo){
		$result = $this->db->insert_batch('softwarepath',$newsoftwarepathsinfo);
		return $result;
		//回應TRUE FLASE
		}
			//取得複製前的data列表
	public function selectCloneData($oldhostid){
		$query = $this->db->get_where('datapath',array('HostID'=>$oldhostid));
		return $query->result_array();
		}
	//複製data by oldhostid
	public function insertDatapath($newdatapathsinfo){
		$result = $this->db->insert_batch('datapath',$newdatapathsinfo);
		return $result;
		//回應TRUE FLASE
		}
	//檢查相同名稱
	public function checkSameHost($newhostname){
		//false不存在 true存在
		$bool = false;
		$query = $this->db->get_where('host',array('Name'=>$newhostname));
		if($query->result_array()!=null){
			$bool = true;
			}
		return $bool;
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