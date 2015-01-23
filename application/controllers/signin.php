<?php
class Signin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Signin_model');

		}
	public function index(){
		//驗證帳號密碼
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if($this->form_validation->run() === false){ 
			$this->session->sess_destroy(); //destrioy all session
			$this->load->view('signin/index');
			return;
			}
		else{
			//經過表單驗證，前往ad認證，最後認證本基資料庫，再拉出個人資料塞入session
			$this->session->set_userdata('username', $username);
			$data['username'] = $username;
			//ad驗證，如果是遇到admin則用字帶密碼驗證
			if($username==='admin'){
				if($password!='Admin123'){
					$this->signout();
					return;
					}
				}
			else{
				//測試環境不驗證
				/*
				if($this->checkLDAP($username,$password)===false){
					$this->signout();
					return;
					}
					*/
				}
			
			//本基驗證
			$data['userinfo'] = $this->Signin_model->loadinfo_username($username);
			if(empty($data['userinfo'])){
				$this->signout();
				return;
				}
			//驗證成功
			$this->session->set_userdata('userinfo', $data['userinfo']);
			redirect('','refresh');
			}
		
		
		}
	//登出
	public function signout(){
			$this->session->sess_destroy(); //destrioy all session
			$this->load->view('signin/index');
		}
	
	//admin切換身分登入
	public function resignin($ResigninUser){
		$username = $this->session->userdata('username');
		if($username === 'admin'){
			//resignin
			$data['userinfo'] = $this->Signin_model->loadinfo_username($ResigninUser);
			$this->session->set_userdata('userinfo', $data['userinfo']);
			$username = $ResigninUser;
			$this->session->set_userdata('username', $username);
			redirect('','refresh');
			}
		else{
			$this->signout();
			return;
			}
		}
	
	
	//ad驗證功能實作
	private function checkLDAP($username,$password){
			$checkok = true;
			$domain = 'e104.com.tw';
			//ldap bind
			$ldaprdn = $username.'@'.$domain;
			$ldappass = $password;
			//連接網域
			$ldapconn = ldap_connect($domain);
			ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
			
			if ($ldapconn) { // binding to ldap server 
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass); 
			// verify binding 
			if ($ldapbind) { 
					$checkok = true;
			} else { 
				$checkok = false;
			} 
			return $checkok;
		}}

	
	}

?>