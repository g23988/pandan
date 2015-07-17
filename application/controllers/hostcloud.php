<?php
class Hostcloud extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('hostcloud_model');
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
			$this->hostcloud_model->delete_hostclouds($cloudid);
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
		$this->form_validation->set_rules('location','location','required');
		if($this->form_validation->run() === false){ 
			$this->showHostCloudPage($data);
			return;
		};
		
		if($username ==='admin'){
			$this->hostcloud_model->insert_hostclouds();
			$this->showHostCloudPage($data);
			}
		else{
			show_404();
			}
		}
	//修改hostcloud明細
	public function edit(){
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->hostcloud_model->update_hostclouds();
			$this->showHostCloudPage($data);
			}
		else{
			show_404();
			}
		
		}

	//顯示單元 for view
	public function showHostCloudPage($data){
			$data['hostclouds'] = $this->hostcloud_model->get_hostclouds();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/hostcloud/hostcloudEdit',$data);
			$this->load->view('templates/footer');
		}
		//訊息頁面用json
	public function HostCloudJson(){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$message_array = $this->hostcloud_model->get_hostclouds();
		$message2= array();
		foreach($message_array as $item){
			$message = array($item['CloudID'],$item['Name'],$item['Location'],$item['Description']);
			array_push($message2,$message);
		}
		$messages = array("data"=>$message2);
		print(json_encode($messages,JSON_UNESCAPED_UNICODE));
		}
	
	}
		

?>