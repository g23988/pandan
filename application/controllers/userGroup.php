<?php
class Usergroup extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('usergroup_model');
		}
/*	public function index(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username === 'admin'){			
			$this->load->view('templates/header',$data);
			$this->load->view('userGroup/groupEdit');
			$this->load->view('templates/footer');
			}
		else{
			$this->load->view('signin/index');
			}
		}*/
	
	public function view(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$data['groups'] = $this->usergroup_model->get_groups();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/userGroup/groupEdit',$data);
			$this->load->view('templates/footer');
			}
		else{
			show_404();
			}
		}
	public function delete($groupid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->usergroup_model->delete_groups($groupid);
			$data['groups'] = $this->usergroup_model->get_groups();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/userGroup/groupEdit',$data);
			$this->load->view('templates/footer');
			}
		else{
			show_404();
			}
		}
	public function add(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$this->form_validation->set_rules('groupname','groupname','required');
		$this->form_validation->set_rules('nickname','nickname','required');
		if($this->form_validation->run() === false){ 
			$data['groups'] = $this->usergroup_model->get_groups();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/userGroup/groupEdit',$data);
			$this->load->view('templates/footer');
			return;
		};
		if($username ==='admin'){
			$this->usergroup_model->insert_groups();
			$data['groups'] = $this->usergroup_model->get_groups();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/userGroup/groupEdit',$data);
			$this->load->view('templates/footer');
			}
		else{
			show_404();
			}
		}
	//回應json 拿取清單
	public function getJsonGroup(){
		if($this->session->userdata('username')===false){
			$this->load->view('signin/index');
			}
		else{
			$data['data'] = $this->usergroup_model->get_groups();
			foreach($data['data'] as $item){
				print json_encode($item,JSON_UNESCAPED_UNICODE);
				}

			
			}

		
		}
	
	
	}
		

?>