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
		$data['userinfo'] = $this->session->userdata('userinfo');
		$this->showMessagePage($data);

	}
	public function showMessagePage($data){
		$this->load->view('templates/header',$data);
		$this->load->view('message/message',$data);
		$this->load->view('templates/footer');
	}
	
	public function showPiePandanCountByUser(){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$this->load->view('message/piepandancount');
		}
	
/*	public function showSysnoticeByUser(){
		盤點數量提醒(下線)
		$data['userinfo'] = $this->session->userdata('userinfo');
		$countFlagNeverResult = $this->message_model->get_pandan_flagNever_count($data['userinfo']['UserID']);
		$countFlagDNFResult = $this->message_model->get_pandan_flagDNF_count($data['userinfo']['UserID']);
		$data['count_pandan_nerver'] = $countFlagNeverResult['num'];
		$data['count_pandan_dnf'] = $countFlagDNFResult['num'];
		$this->load->view('message/systemnotice',$data);
		}*/
	
	
	public function PandanNumByUser(){
		$result = $this->message_model->get_pandan_count();
		print(json_encode($result,JSON_UNESCAPED_UNICODE));
		}

	//訊息頁面用json
	public function UserMessageJson(){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$message_array = $this->message_model->get_message_byuser_nolimit($data['userinfo']['UserID']);
		$message2= array();
		foreach($message_array as $item){
			$message = array($item['From'],$item['Text'],base_url().$item['Link'],$item['Createtime']);
			array_push($message2,$message);
		}
		/*
		$message = array("Tiger Nixon",
      "System Architect",
      "Edinburgh",
      "5421",
      "2011/04/25",
      "$320,800");*/
	    //$message2 = array($message,$message);
		$messages = array("data"=>$message2);
		print(json_encode($messages,JSON_UNESCAPED_UNICODE));
		}
	//header用訊息
	public function UserMessageHtmlUl($max){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$data['messages'] = $this->message_model->get_message_byuser($data['userinfo']['UserID'],$max);
		$this->load->view('message/messageHtmlUl',$data);
		}
	//home用訊息
	public function UserMessageHtmlHome($max){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$data['messages'] = $this->message_model->get_message_byuser($data['userinfo']['UserID'],$max);
		$this->load->view('message/messageHtmlhome',$data);
		}
	//message頁面用訊息總覽
	public function showMessageOverview(){
		$data['userinfo'] = $this->session->userdata('userinfo');
		$this->load->view('message/messageOverview',$data);
		}

	
	
}