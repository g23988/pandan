<?php
class System_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
		}
		
	//讀取全域設定
	public function loadinfo_systemsetting(){
		$query = $this->db->get('system');
		return $query->row_array();	
		}
	
	public function update_systemsetting(){
		//更新系統全域變數
		$username = $this->session->userdata('username');
		$userinfo = $this->session->userdata('userinfo');
		$data = array(
				'useLDAP' => $this->input->post('useLDAPselect'),
				'LDAPLocation' => htmlentities($this->input->post('ldaplocation')),
				'useSignMV' => $this->input->post('useSignMVSelect'),
				'subTitle' => htmlentities($this->input->post('subtitle'))
			);
		$this->db->update('system',$data);
		}



	}

?>