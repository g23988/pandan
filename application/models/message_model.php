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