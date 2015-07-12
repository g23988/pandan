<?php
class Message_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_pandan_count(){
		$query = $this->db->query("select SUM(num) as value,user.Name as label from
((select COUNT(KeeperID) as num,KeeperID  from softwarepath  where SettingTypeID <> 1 group by KeeperID)
union all
(select COUNT(KeeperID) as num,KeeperID  from softwarepath  where LogTypeID <> 1 group by KeeperID)
union all
(select count(KeeperID) as num,KeeperID  from datapath group by KeeperID))a 
left join user on a.KeeperID = user.UserID
GROUP BY a.KeeperID
ORDER BY value DESC");
		return $query->result_array();
		//把所有path數量相嘉 by keeperID
		/*select SUM(num) as value,user.Name as label from
((select COUNT(KeeperID) as num,KeeperID  from softwarepath  where SettingTypeID <> 1 group by KeeperID)
union all
(select COUNT(KeeperID) as num,KeeperID  from softwarepath  where LogTypeID <> 1 group by KeeperID)
union all
(select count(KeeperID) as num,KeeperID  from datapath group by KeeperID))a 
left join user on a.KeeperID = user.UserID
GROUP BY a.KeeperID
ORDER BY value DESC*/
		
		}
	
	public function get_pandan_flagNever_count($userid){
		//為盤點的數量
		$sqlstring = "select count(*) as num from host where userid = ".$userid." and flag = 0";
		$query = $this->db->query($sqlstring);
		return $query->row_array();
		}
	public function get_pandan_flagDNF_count($userid){
		//盤點鐘的數量
		$sqlstring = "select count(*) as num from host where userid = ".$userid." and flag = 1";
		$query = $this->db->query($sqlstring);
		return $query->row_array();
		}
	public function get_pandan_flagDone_count($userid){
		//盤點鐘的數量
		$sqlstring = "select count(*) as num from host where userid = ".$userid." and flag = 2";
		$query = $this->db->query($sqlstring);
		return $query->row_array();
		}
	public function get_pandan_total_count($userid){
		//機器總數
		$sqlstring = "select count(*) as num from host where userid = ".$userid."";
		$query = $this->db->query($sqlstring);
		return $query->row_array();
		}
	public function get_pandan_Groupuse_count($userid,$usergroupid){
		//機器總數
		$sqlstring = "select count(host.HostID) as num
		from host
		left join hostcloud on host.CloudID = hostcloud.CloudID
		left join user on host.UserID = user.UserID where user.GroupID = ".$usergroupid." and host.Groupuse = 1";
		$query = $this->db->query($sqlstring);
		return $query->row_array();
		}
		
	//找出訊息
	public function get_message_byuser($userid,$max){
		$sqlstring = "select message.Text,user.Nickname as 'From',b.Nickname as 'To',message.Link,message.Createtime from message
left join user on message.From = user.UserID
left join user as b on message.To = b.UserID where message.To =".$userid." order by message.MessageID DESC limit ".$max;
		$query = $this->db->query($sqlstring);
		return $query->result_array();
		}	
		
		//找出訊息不限制大小
	public function get_message_byuser_nolimit($userid){
		$sqlstring = "select message.Text,user.Nickname as 'From',b.Nickname as 'To',message.Link,message.Createtime from message
left join user on message.From = user.UserID
left join user as b on message.To = b.UserID where message.To =".$userid." order by message.MessageID DESC";
		$query = $this->db->query($sqlstring);
		return $query->result_array();
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
		
		}*/
		
	//insert訊息
	public function InsertMessage($from,$to,$message,$link){
		$data = array(
			'From' => $from,
			'To' => $to,
			'Text' => $message,
			'Createtime' => date('Y-m-d H:i:s',time()),
			'Link' => $link
		);
		return $this->db->insert('message',$data);
		}
	
	}
	


?>