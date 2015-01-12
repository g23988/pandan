<?php
class Softwarecloud extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('softwarecloud_model');
		}
	public function view(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->showHostCloudPage($data);
			}
		else{
			show_404();
			}
		}
	public function delete($cloudid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->softwarecloud_model->delete_softwareclouds($cloudid);
			$this->showHostCloudPage($data);
			}
		else{
			show_404();
			}
		}
	public function add(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//驗證cloud資料
		$this->form_validation->set_rules('cloudname','cloudname','required');
		
		if($this->form_validation->run() === false){ 
			$this->showHostCloudPage($data);
			return;
		};
		
		if($username ==='admin'){
			$this->softwarecloud_model->insert_softwareclouds();
			$this->showHostCloudPage($data);
			}
		else{
			show_404();
			}
		}
	//顯示單元 for view
	public function showHostCloudPage($data){
			$data['softwareclouds'] = $this->softwarecloud_model->get_softwareclouds();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/softwarecloud/softwarecloudEdit',$data);
			$this->load->view('templates/footer');
		}
	
	
	}
		

?>