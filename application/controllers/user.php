<?php
class User extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//session檢查 沒有就倒回登入頁
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('user_model');
		$this->load->model('usergroup_model');
		}
	public function view(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->showUserPage($data);
			}
		else{
			show_404();
			}
		}
	public function delete($userid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->user_model->delete_users($userid);
			$this->showUserPage($data);
			}
		else{
			show_404();
			}
		}
	public function add(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$this->form_validation->set_rules('account','account','required');
		$this->form_validation->set_rules('name','name','required');
		$this->form_validation->set_rules('nickname','nickname','required');
		$this->form_validation->set_rules('groupname','groupname','required');
		
		if($this->form_validation->run() === false){ 
			$this->showUserPage($data);
			return;
		};
		
		if($username ==='admin'){
			$this->user_model->insert_users();
			$this->showUserPage($data);
			}
		else{
			show_404();
			}
		}
	//顯示單元 for view
	public function showUserPage($data){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$data['users'] = $this->user_model->get_users();
			$data['groups'] = $this->usergroup_model->get_groups();
			$this->load->view('templates/header',$data);
			$this->load->view('admin/user/userEdit',$data);
			$this->load->view('templates/footer');
		}
	
	
	//使用者自訂修改的部分
	public function AccountDetailEdit(){
		//修改明細頁面
			$this->ShowAccountDetail();
		}
	public function UpdateAccountDetail(){
		//update account detail
		//修改user的資料 搭配表單accountDetailEdit
			$data['userinfo'] = $this->session->userdata('userinfo');
			$data['username'] = $data['userinfo']['Account'];
			
			$this->form_validation->set_rules('name','name','required');
			$this->form_validation->set_rules('nickname','nickname','required');
			$this->form_validation->set_rules('userid','userid','required');
			$this->form_validation->set_rules('groupid','groupid','required');
			if($this->form_validation->run() === false){ 
				$this->ShowAccountDetail();
				return;
			};
			//update
			$this->user_model->update_users();
			
			redirect('signout','refresh');
		}
	//管理者修改的部分
	public function UpdateUserDetail(){
		//修改user的資料 搭佩view admin/user/userEdit
		$data['userinfo'] = $this->session->userdata('userinfo');
		if($this->session->userdata('username')!="admin"){
			redirect('signout','refresh');
			return;
			}
		$data['username'] = $data['userinfo']['Account'];
		$this->form_validation->set_rules('editUserID','editUserID','required');
		$this->form_validation->set_rules('editaccount','editaccount','required');
		$this->form_validation->set_rules('editname','editname','required');
		$this->form_validation->set_rules('editnickname','editnickname','required');
		$this->form_validation->set_rules('editgroupname','editgroupname','required');
		if($this->form_validation->run() === false){ 
				redirect('signout','refresh');
				$this->ShowAccountDetail();
				return;
			};
		$this->user_model->admin_update_users();
		redirect('user/view','refresh');
		}

	//顯示單元 for AccountDetailEdit
	public function ShowAccountDetail(){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$data['username'] = $data['userinfo']['Account'];
			$data['users'] = $this->user_model->get_users();
			$data['groups'] = $this->usergroup_model->get_groups();
			$this->load->view('templates/header',$data);
			$this->load->view('account/accountDetailEdit',$data);
			$this->load->view('templates/footer');
		}
	
	//管理者切換身分
	public function ChangLoginUser(){
		//切換成另外一個使用者
		$data['userinfo'] = $this->session->userdata('userinfo');
		if($this->session->userdata('username')!="admin"){
			redirect('signout','refresh');
			return;
			}
		$data['username'] = $data['userinfo']['Account'];
		$this->ChangLoginUserList($data);
		/*$data['username'] = $data['userinfo']['Account'];
		$this->form_validation->set_rules('editUserID','editUserID','required');
		$this->form_validation->set_rules('editaccount','editaccount','required');
		$this->form_validation->set_rules('editname','editname','required');
		$this->form_validation->set_rules('editnickname','editnickname','required');
		$this->form_validation->set_rules('editgroupname','editgroupname','required');
		if($this->form_validation->run() === false){ 
				redirect('signout','refresh');
				$this->ShowAccountDetail();
				return;
			};
		$this->user_model->admin_update_users();
		redirect('user/view','refresh');*/
		}
	//顯示單元 for 管理者切換身分
	public function ChangLoginUserList($data){
			$data['userinfo'] = $this->session->userdata('userinfo');
			$data['users'] = $this->user_model->get_users();
			$data['groups'] = $this->usergroup_model->get_groups();
			$this->load->view('templates/header',$data);
			$this->load->view('admin/user/userChange',$data);
			$this->load->view('templates/footer');
		}
	
	
	}
		

?>