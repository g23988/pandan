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
	
	//clone首頁，處發起點
	public function cloneHostByHostID($newhostname,$newhostcloud,$oldhostid){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$hostinfo = $this->clone_model->selectCloneHost(urldecode($newhostname),$oldhostid);
		//檢查是否相同名稱
		$checkSameName = $this->clone_model->checkSameHost($newhostname);
				//false不存在可使用 true存在回應空
		/*if($checkSameName){
			print(json_encode(""));
			}
		else{print(json_encode($hostinfo,JSON_UNESCAPED_UNICODE));
			}*/
		print(json_encode($hostinfo,JSON_UNESCAPED_UNICODE));
		}
	
	//insert新的host
	public function resetcloneHost($newhostname,$newcloudid,$oldhostid){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$hostinfo = $this->clone_model->selectCloneHost(urldecode($newhostname),$oldhostid);
		$oldName = $hostinfo->Name;
		$newhostinfo['Name'] =  $newhostname;
		$newhostinfo['CloudID'] = $newcloudid;
		$newhostinfo['UserID'] = $data['userinfo']['UserID'];
		$newhostinfo['Remark'] = $hostinfo->Remark;
		$newhostinfo['Createtime'] = date('Y-m-d H:i:s',time());
		$newhostinfo['Modifytime'] = date('Y-m-d H:i:s',time());
		$newhostinfo['Modifyuser'] = $data['userinfo']['UserID'];
		$newhostinfo['flag'] = 0;
		$newhostidobj = $this->clone_model->insertCloneHost($newhostinfo);
		$hostinfo = $this->clone_model->selectCloneHost($newhostname,$newhostidobj->HostID);
		print(json_encode($hostinfo,JSON_UNESCAPED_UNICODE));
		}
	
	//收集舊的software資訊by oldhostid
	public function cloneSoftwareByHostID($newhostid,$oldhostid){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$softwareinfo = $this->clone_model->selectCloneSoftware($oldhostid);
		if($softwareinfo!=null){
		print(json_encode($softwareinfo,JSON_UNESCAPED_UNICODE));
			}
		else{
			print(json_encode(""));
			}

		}
	//insert新的software
	public function setnewsoftwarepath($newhostid,$oldhostid){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$softwareinfo = $this->clone_model->selectCloneSoftware($oldhostid);
		if($softwareinfo!=null){
			//循序改變為新的hostid  並且清空PathID
			foreach($softwareinfo as $key =>$item){
				$softwareinfo[$key]['HostID'] = $newhostid;
				$softwareinfo[$key]['PathID'] = '';
				$softwareinfo[$key]['Createtime'] = date('Y-m-d H:i:s',time());
				$softwareinfo[$key]['Modifytime'] = date('Y-m-d H:i:s',time());
				$softwareinfo[$key]['Modifyuser'] = $data['userinfo']['UserID'];;
				}
			
			$result = $this->clone_model->insertSoftwarepath($softwareinfo);
			//var_dump($result);
			print json_encode($softwareinfo,JSON_UNESCAPED_UNICODE);
			}
		else{
			print(json_encode(""));
			}
		}
		
	
	//收集舊的data資訊by oldhostid
	public function cloneDataByHostID($newhostid,$oldhostid){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$datainfo = $this->clone_model->selectCloneData($oldhostid);
		if($datainfo!=null){
			print(json_encode($datainfo,JSON_UNESCAPED_UNICODE));
			}
		else{
			print(json_encode(""));
			}
		}
	//insert新的data
	public function setnewdatapath($newhostid,$oldhostid){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$datainfo = $this->clone_model->selectCloneData($oldhostid);
		//循序改變為新的hostid  並且清空PathID
		if($datainfo!=null){
			foreach($datainfo as $key =>$item){
			$datainfo[$key]['HostID'] = $newhostid;
			$datainfo[$key]['PathID'] = '';
			$datainfo[$key]['Createtime'] = date('Y-m-d H:i:s',time());
			$datainfo[$key]['Modifytime'] = date('Y-m-d H:i:s',time());
			$datainfo[$key]['Modifyuser'] = $data['userinfo']['UserID'];;
			}
			$result = $this->clone_model->insertDatapath($datainfo);
			//var_dump($result);
			print json_encode($datainfo,JSON_UNESCAPED_UNICODE);
			}
		else{
			print(json_encode(""));
			}
		}
	//顯示單元 for index
	public function showClonePage($newhostname,$newhostcloud,$oldhostid){
		$data['newhostname'] = urldecode($newhostname);
		$data['newhostcloud'] = $newhostcloud;
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
		

