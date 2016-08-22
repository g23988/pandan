<?php
class Host_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	
	public function get_hostcloudlocation(){
		//只拉hostcloud中有的不重複location
		$query = $this->db->query("select distinct Location from hostcloud");
		return $query->result_array();
		}
	
	public function get_hostclouds($hostcloud){
		//hostOverview.php專用jquery datatable json model 機器群連動
		$userinfo = $this->session->userdata('userinfo');
		if($hostcloud=="all"){
			$sql = "SELECT host.HostID,host.Name,hostcloud.Name as CloudName,user.Name as Username,hostcloud.Location,host.Remark FROM host
				left join hostcloud on host.CloudID = hostcloud.CloudID 
				left join user on host.UserID = user.UserID 
				WHERE 1=1 ";
				if($userinfo['UserID']!='1') {$sql .= "AND host.UserID = ".$userinfo['UserID'];}
			}
		else{
			$sql = "SELECT host.HostID,host.Name,hostcloud.Name as CloudName,user.Name as Username,hostcloud.Location,host.Remark FROM host
				left join hostcloud on host.CloudID = hostcloud.CloudID 
				left join user on host.UserID = user.UserID ";
			if($userinfo['UserID']==='1'){
				$sql .= "WHERE hostcloud.CloudID = ".$hostcloud;
				}
			else{
				$sql .= "WHERE host.UserID = ".$userinfo['UserID']." AND hostcloud.CloudID = ".$hostcloud;
				}
			}
		$query = $this->db->query($sql);
		return $query->result_array();
		}

	public function get_hostlocation($location){
		//hostOverview.php專用jquery datatable json model 位置連動
		$userinfo = $this->session->userdata('userinfo');
		if($location=="all"){
			$sql = "SELECT host.HostID,host.Name,hostcloud.Name as CloudName,user.Name as Username,hostcloud.Location,host.Remark FROM host
				left join hostcloud on host.CloudID = hostcloud.CloudID 
				left join user on host.UserID = user.UserID 
				";
			}
		else{
			$sql = "SELECT host.HostID,host.Name,hostcloud.Name as CloudName,user.Name,user.Name as Username,hostcloud.Location,host.Remark FROM host
				left join hostcloud on host.CloudID = hostcloud.CloudID 
				left join user on host.UserID = user.UserID 
				";
			if($userinfo['UserID']==='1'){
				$sql .= "WHERE hostcloud.Location = '".$location."'";
				}
			else{
				$sql .= "WHERE host.UserID = ".$userinfo['UserID']." AND hostcloud.Location = '".$location."'";
				}
			}
		$query = $this->db->query($sql);
		return $query->result_array();
		}


	public function get_whereuserid_json($userid){
		//給header.php searchinput用的json格式資料
		$userinfo = $this->session->userdata('userinfo');
		if($userinfo['UserID'] ==='1'){
			//admin可以看到全部
			$query = $this->db->query("select host.HostID as id,host.Name as name,hostcloud.Name as cloudname from host
					left join hostcloud on host.CloudID = hostcloud.CloudID
					left join user on host.UserID = user.UserID 
				");
			}
		else{
			//把群組共用的野拉出來 還有admin管理的全域共用也拉出來
			$query = $this->db->query("select host.HostID as id,host.Name as name,hostcloud.Name as cloudname from host
					left join hostcloud on host.CloudID = hostcloud.CloudID
					left join user on host.UserID = user.UserID 
					WHERE host.UserID in (".$userinfo['UserID'].",1) or (GroupID = ".$userinfo['GroupID']." and Groupuse = 1) 
				");
			}
		return $query->result_array();
		}
		
	public function get_wherehosts($hostid){
		//單純讀取hostid指定的host
		$query = $this->db->get_where('host',array('HostID'=>$hostid));
		return $query->row_array();
		}

	public function update_hosts(){
		//透過指定的host id 更新資料
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
				'Name' => htmlentities($this->input->post('edithostname')),
				'CloudID' => htmlentities($this->input->post('editsoftwarecloudid')),
				'UserID' => htmlentities($this->input->post('edituserid')),
				'Remark' => htmlentities($this->input->post('editremark')),
				'Modifytime' => date('Y-m-d H:i:s',time()),
				'Modifyuser' => $userinfo['UserID']
			);
			$hostid = $this->input->post('edithostid');
			$this->db->update('host',$data,array('HostID'=>$hostid));
			
		
		}
	
	public function delete_hosts($hostid){
		//指定主機id刪除
		$query = $this->db->delete('host', array('HostID' => $hostid)); 
		//順便刪除datapath softwarepath資料
		$this->db->delete('softwarepath',array('HostID' => $hostid));
		$this->db->delete('datapath',array('HostID' => $hostid));
		}
	public function insert_hosts(){
		//新增host
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'Name' => htmlentities($this->input->post('hostname')),
			'CloudID' => htmlentities($this->input->post('hostcloudid')),
			'UserID' => $userinfo['UserID'],
			'Remark' => htmlentities($this->input->post('remark')),
			'Modifytime' => date('Y-m-d H:i:s',time()),
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Modifyuser' => $userinfo['UserID']
		);
		//檢查是否有重複的值
		$query = $this->db->get_where('host',array('Name'=>$this->input->post('hostname')));
		$this->db->insert('host',$data);

		
		
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
