<?php
class Software extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁 如果不是admin就倒回首頁
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		if($this->session->userdata('username')!='admin'){
			redirect('','refresh');
			return;
			}
		
		$this->load->model('softwarecloud_model');
		$this->load->model('software_model');
		}
	public function view(){
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$this->showSoftwarePage($data);
		}
	//細查cloud下的software 點選軟體群後ajax在右方的頁面
	public function viewSoftwareCloudDetail($softwareCloudID){
			$data['softwareCloudID'] = $softwareCloudID;
			$data['softwarecloudDetail'] = $this->software_model->get_wheresoftwareclouds($softwareCloudID);
			$this->load->view('software/softwareCloudDetail',$data);
		}
	//取得software的資料
	public function editSoftwareDetail($softwareID){
			$data['softwareclouds'] = $this->softwarecloud_model->get_softwareclouds();
			$data['softwareDetail'] = $this->software_model->get_wheresoftwares($softwareID);
			$data['SoftwareID'] = $softwareID;
			$this->load->view('software/softwareDetailEdit',$data);
		}
	
	public function update(){
		//修改software的資料 搭配表單softwareDetailEdit
			$username = $this->session->userdata('username');
			$data['username'] = $username;
			$this->form_validation->set_rules('softwarename','softwarename','required');
			$this->form_validation->set_rules('softwarecloudid','softwarecloudid','required');
			if($this->form_validation->run() === false){ 
				$this->showSoftwarePage($data);
				return;
			};
			//update
			$this->software_model->update_softwares();
			$this->showSoftwarePage($data);
		}
	public function delete($softwareid){
			//刪除software資料
			$username = $this->session->userdata('username');
			$data['username'] = $username;
			$this->software_model->delete_softwares($softwareid);
			$this->showSoftwarePage($data);

		}
	
	
	//新增software的頁面
	public function addSoftwareDetail(){
			$data['softwareclouds'] = $this->softwarecloud_model->get_softwareclouds();
			$username = $this->session->userdata('username');
			$data['username'] = $username;
			$this->showAddSoftwarePage($data);
		}

	public function add(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//驗證cloud資料
		$this->form_validation->set_rules('softwarename','softwarename','required');
		$this->form_validation->set_rules('softwarecloudid','softwarecloudid','required');
		
		if($this->form_validation->run() === false){ 
			$this->showAddSoftwarePage($data);
			return;
		};
		
		$this->software_model->insert_softwares();
		$this->showSoftwarePage($data);
		}
	//顯示單元 for view
	private function showSoftwarePage($data){
			$data['softwareclouds'] = $this->softwarecloud_model->get_softwareclouds();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('software/softwareOverview',$data);
			$this->load->view('templates/footer');
		}
	//顯示單元 for add
	private function showAddSoftwarePage($data){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('software/softwareDetailAdd',$data);
			$this->load->view('templates/footer');
		}
	
	
	}
		

?>