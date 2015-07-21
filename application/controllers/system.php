<?php
class System extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁
		$data['userinfo'] = $this->session->userdata('userinfo');
		if($data['userinfo']['UserID']===false || $data['userinfo']['UserID']!= 1){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('System_model');
		}
	public function view(){
		//首頁
		$data['userinfo'] = $this->session->userdata('userinfo');
		$data['username'] = $data['userinfo']['Account'];
		$this->showSystemPage($data);
		}
		

	public function updateSystemSetting(){
		//更新系統全域設定
		$data['userinfo'] = $this->session->userdata('userinfo');
		$data['username'] = $data['userinfo']['Account'];
		$this->System_model->update_systemsetting();
		$this->showSystemPage($data);
		}
		
	//顯示單元 for view
	public function showSystemPage($data){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$data['systemsetting'] = $this->System_model->loadinfo_systemsetting();
		$this->load->view('templates/header',$data);
		$this->load->view('admin/system/systemEdit',$data);
		$this->load->view('templates/footer');
		}
	
	
	}
		

?>