<?php
class Host extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁 如果不是admin就倒回首頁
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('hostcloud_model');
		$this->load->model('host_model');
		$this->load->model('user_model');
		}
	public function view(){
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$this->showHostPage($data);
		}
	//細查cloud下的host 點選主機群後ajax在右方的頁面
	public function viewHostCloudDetail($hostCloudID){
			$data['hostCloudID'] = $hostCloudID;
			$data['hostcloudDetail'] = $this->host_model->get_wherehostclouds($hostCloudID);
			$this->load->view('host/hostCloudDetail',$data);
		}
	//取得host的資料
	public function editHostDetail($hostID){
			$data['hostclouds'] = $this->hostcloud_model->get_hostclouds();
			$data['users'] = $this->user_model->get_users();
			$data['hostDetail'] = $this->host_model->get_wherehosts($hostID);
			$data['HostID'] = $hostID;
			$this->load->view('host/hostDetailEdit',$data);
		}
	
	public function update(){
		//修改host的資料 搭配表單hostDetailEdit
			$username = $this->session->userdata('username');
			$data['username'] = $username;
			$this->form_validation->set_rules('hostname','hostname','required');
			$this->form_validation->set_rules('hostcloudid','hostcloudid','required');
			$this->form_validation->set_rules('userid','userid','required');
			if($this->form_validation->run() === false){ 
				$this->showHostPage($data);
				return;
			};
			//update
			$this->host_model->update_hosts();
			$this->showHostPage($data);
		}
	public function delete($hostid){
			//刪除host資料
			$username = $this->session->userdata('username');
			$data['username'] = $username;
			$this->host_model->delete_hosts($hostid);
			$this->showHostPage($data);

		}
	
	
	//新增host的頁面
	public function addHostDetail(){
			$data['hostclouds'] = $this->hostcloud_model->get_hostclouds();
			$username = $this->session->userdata('username');
			$data['username'] = $username;
			$this->showAddHostPage($data);
		}

	public function add(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//驗證cloud資料
		$this->form_validation->set_rules('hostname','hostname','required');
		$this->form_validation->set_rules('hostcloudid','hostcloudid','required');
		
		if($this->form_validation->run() === false){ 
			$this->showAddHostPage($data);
			return;
		};
		
		$this->host_model->insert_hosts();
		$this->showHostPage($data);
		}
	
	public function clearAllFlag(){
		//清空所有的flag
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username === 'admin'){
			$this->host_model->updateAllFlag();
			}
		$this->showHostPage($data);
		}	
	
	public function showUserAllHostJson(){
		//輸出該使用者全部的資料 採用json格式
		$userinfo = $this->session->userdata('userinfo');
		$result = $this->host_model->get_whereuserid_json($userinfo['UserID']);
		print json_encode($result,JSON_UNESCAPED_UNICODE);
		
		}
		
	
	//顯示單元 for view
	private function showHostPage($data){
			$data['hostclouds'] = $this->hostcloud_model->get_hostclouds();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('host/hostOverview',$data);
			$this->load->view('templates/footer');
		}
	//顯示單元 for add
	private function showAddHostPage($data){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('host/hostDetailAdd',$data);
			$this->load->view('templates/footer');
		}
	
	
	}
		

?>