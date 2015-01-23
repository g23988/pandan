<?php
class Clonehost extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('clone_model');
		}
	public function index(){
		//確認身分
		/*
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$this->showClonePage($data);
		if($username ==='admin'){
			$this->showBgPage($data);
			}
		else{
			show_404();
			}
			*/
		}
	
	//clone首頁，處發起點 step1
	public function getHostByHostID($newhostname,$oldhostid){
		var_dump($oldhostid);
		var_dump($newhostname);
		$data['userinfo'] = $this->session->userdata('userinfo');
		$hostinfo = $this->clone_model->selectCloneHost($newhostname,$oldhostid);
		//收集新的host資料
		$Name = $newhostname;
		$CloudID = $hostinfo->CloudID;
		$UserID = $data['userinfo']['UserID'];
		$Remark = $hostinfo->Remark;
		$Createtime = date('Y-m-d H:i:s',time());
		$Modifytime = date('Y-m-d H:i:s',time());
		$Modifyuser = $data['userinfo']['UserID'];
		$flag = 0;
		
		
		
		//開始創建新的
		
		//取得最新一筆資料的id
		
		//收集原本的id
		
		//收集舊id的softwarepath
		
		//收集舊id的datapath
		
		}
	
	
	
	
	//顯示單元 for index
	public function showClonePage($newhostname,$oldhostid){
		$data['newhostname'] = $newhostname;
		$data['oldhostid'] = $oldhostid;
		$this->load->view('clonehost/clone',$data);
		/*
		
			$data['bgs'] = $this->bg_model->get_bgs();
			$data['userinfo'] = $this->session->userdata('userinfo');
		
			$this->load->view('templates/header',$data);
			$this->load->view('admin/bg/bgEdit',$data);
			$this->load->view('templates/footer');*/
		}
	public function test(){
		echo "完成";
		}
	
	}
		

