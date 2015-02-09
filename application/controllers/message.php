<?php

class Message extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('message_model');
		}
	public function view()
	{
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		$this->showMessagePage($data);

	}
	public function showMessagePage($data){
		//$data['bgs'] = $this->bg_model->get_bgs();
		$data['userinfo'] = $this->session->userdata('userinfo');
		$this->load->view('templates/header',$data);
		$this->load->view('message/message',$data);
		$this->load->view('templates/footer');
	}
	
	public function showPiePandanCountByUser(){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$this->load->view('message/piepandancount');
		}
	
	public function showSysnoticeByUser(){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$countFlagNeverResult = $this->message_model->get_pandan_flagNever_count($data['userinfo']['UserID']);
		$countFlagDNFResult = $this->message_model->get_pandan_flagDNF_count($data['userinfo']['UserID']);
		$data['count_pandan_nerver'] = $countFlagNeverResult['num'];
		$data['count_pandan_dnf'] = $countFlagDNFResult['num'];
		$this->load->view('message/systemnotice',$data);
		}
	
	
	public function PandanNumByUser(){
		$result = $this->message_model->get_pandan_count();
		print(json_encode($result,JSON_UNESCAPED_UNICODE));
		}

	
	
}