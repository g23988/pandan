<?php
class News_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
	public function get_news(){
		$this->db->select('news.Text as Text,news.Createtime as Createtime,user.Nickname as Name');
		$this->db->from('news');
		$this->db->join('user','news.Createuser = user.UserID');
		$this->db->order_by("NewsID", "desc"); 
		$query = $this->db->get();
		return $query->result_array();
		}
	public function set_news(){
		//新增公告
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
			'Createuser' => $userinfo['UserID'],
			'Text' => htmlentities($this->input->post('text')),
			'Createtime' => date('Y-m-d H:i:s',time())
		);
		return $this->db->insert('news',$data);
		
		}
	
	
	
	}

?>