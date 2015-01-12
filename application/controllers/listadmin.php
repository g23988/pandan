<?php
class Listadmin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('listadmin_model');
		}
	//控制datalist
	public function dataview(){
		//確認admin身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->showDataListPage($data);
			}
		else{
			show_404();
			}
		}
	public function deletedatatype($datatypeid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->listadmin_model->delete_datatypes($datatypeid);
			$this->showDataListPage($data);
			}
		else{
			show_404();
			}
		}
	public function adddatatype(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//驗證datatype資料
		$this->form_validation->set_rules('datatypename','datatypename','required');
		
		if($this->form_validation->run() === false){ 
			$this->showDataListPage($data);
			return;
		};
		
		if($username ==='admin'){
			$this->listadmin_model->insert_datatypes();
			$this->showDataListPage($data);
			}
		else{
			show_404();
			}
		}
		//顯示單元 for dataview
	public function showDataListPage($data){
			$data['datatypes'] = $this->listadmin_model->get_datatypes();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/list/DataListEdit',$data);
			$this->load->view('templates/footer');
		}
	//控制datalist結束
	
	//控制settinglist
		public function settingview(){
		//確認admin身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->showSettingListPage($data);
			}
		else{
			show_404();
			}
		}
	public function deletesettingtype($settingtypeid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->listadmin_model->delete_settingtypes($settingtypeid);
			$this->showSettingListPage($data);
			}
		else{
			show_404();
			}
		}
	public function addsettingtype(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//驗證datatype資料
		$this->form_validation->set_rules('settingtypename','settingtypename','required');
		
		if($this->form_validation->run() === false){ 
			$this->showSettingListPage($data);
			return;
		};
		
		if($username ==='admin'){
			$this->listadmin_model->insert_settingtypes();
			$this->showSettingListPage($data);
			}
		else{
			show_404();
			}
		}
		//顯示單元 for settingview
	public function showSettingListPage($data){
			$data['settingtypes'] = $this->listadmin_model->get_settingtypes();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/list/SettingListEdit',$data);
			$this->load->view('templates/footer');
		}
	//控制settingtype 結束	
		
	//控制loglist
		public function logview(){
		//確認admin身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->showLogListPage($data);
			}
		else{
			show_404();
			}
		}
	public function deletelogtype($logtypeid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->listadmin_model->delete_logtypes($logtypeid);
			$this->showLogListPage($data);
			}
		else{
			show_404();
			}
		}
	public function addlogtype(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//驗證datatype資料
		$this->form_validation->set_rules('logtypename','logtypename','required');
		
		if($this->form_validation->run() === false){ 
			$this->showLogListPage($data);
			return;
		};
		
		if($username ==='admin'){
			$this->listadmin_model->insert_logtypes();
			$this->showLogListPage($data);
			}
		else{
			show_404();
			}
		}
		//顯示單元 for logview
	public function showLogListPage($data){
			$data['logtypes'] = $this->listadmin_model->get_logtypes();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/list/LogListEdit',$data);
			$this->load->view('templates/footer');
		}
	//控制logtype 結束	
		
		
		
		
		

	
	}
		

?>