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
	public function signout(){
			$this->session->sess_destroy(); //destrioy all session
			$this->load->view('signin/index');
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
/*	public function view($slug){
		$data['news_item'] = $this->news_model->get_news($slug);
		
		if(empty($data['news_item'])){
			show_404();
			}
		$data['title'] = $data['news_item']['title'];
		$this->load->view('templates/header',$data);
		$this->load->view('news/view',$data);
		$this->load->view('templates/footer');
		}
	public function create(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create a new item';
		
		$this->form_validation->set_rules('title','標題','required');
		$this->form_validation->set_rules('text','內文','required');
		
		if($this->form_validation->run() === false){
			$this->load->view('templates/header',$data);
			$this->load->view('news/create');
			$this->load->view('templates/footer');
			}
		else{
			$this->news_model->set_news();
			$this->load->view('news/success');
			}
		}
*/	
	/*		$data['news']= $this->news_model->get_news();
		$data['title']= 'News archive';
		
		$this->load->view('templates/header',$data);
		$this->load->view('news/index',$data);
		$this->load->view('templates/footer');*/
	
	}

?>