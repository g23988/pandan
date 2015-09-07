<?php

class Pages extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('news_model');
		$this->load->model('message_model');
		}
	public function view()
	{
		$data['username'] = $this->session->userdata('username');
		$data['userinfo'] = $this->session->userdata('userinfo');
		$data['news'] = $this->news_model->get_news();
		$countFlagNeverResult = $this->message_model->get_pandan_flagNever_count($data['userinfo']['UserID']);
		$countFlagDNFResult = $this->message_model->get_pandan_flagDNF_count($data['userinfo']['UserID']);
		$countFlagDoneResult = $this->message_model->get_pandan_flagDone_count($data['userinfo']['UserID']);
		$countFlagGroupuseResult = $this->message_model->get_pandan_Groupuse_count($data['userinfo']['UserID'],$data['userinfo']['GroupID']);
		$countFlagTotalResult = $this->message_model->get_pandan_total_count($data['userinfo']['UserID']);
		$data['count_pandan_nerver'] = $countFlagNeverResult['num'];
		$data['count_pandan_dnf'] = $countFlagDNFResult['num'];
		$data['count_pandan_done'] = $countFlagDoneResult['num'];
		$data['count_pandan_groupuse'] = $countFlagGroupuseResult['num'];
		$data['count_pandan_total'] = $countFlagTotalResult['num'];
		//避免total =0 無法運算
		if($countFlagTotalResult['num'] != 0 ){
			$data['count_pandan_persent'] = round(($countFlagDoneResult['num'] / $countFlagTotalResult['num']) * 100);
			}
		else{
			$data['count_pandan_persent'] = 0;
			}
 		$this->load->view('templates/header', $data);
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer', $data);
	}
	public function ajax_complete_bar(){
		$result = $this->message_model->get_total_progress();
		print(json_encode($result,JSON_UNESCAPED_UNICODE));
		//echo '[{"y":"2006","a":100,"b": 900}, {"y":"2007","a":75,"b": 65}, {"y": "2008","a": 50,"b": 40}, {"y": "2009","a": 75,"b": 65}, {"y": "2010","a": 50,"b": 40}, {"y": "2011","a": 75,"b": 65}, {"y": "2012","a": 100,"b": 90}]';
		}
	public function insert_news(){
		
		$this->form_validation->set_rules('text','text','required');
		
		if($this->form_validation->run() === false){ 
			redirect('','refresh');
			return;
		};
		$this->news_model->set_news();
		redirect('','refresh');
		}
	
	
}