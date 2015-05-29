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
		$countFlagTotalResult = $this->message_model->get_pandan_total_count($data['userinfo']['UserID']);
		$data['count_pandan_nerver'] = $countFlagNeverResult['num'];
		$data['count_pandan_dnf'] = $countFlagDNFResult['num'];
		$data['count_pandan_done'] = $countFlagDoneResult['num'];
		$data['count_pandan_total'] = $countFlagTotalResult['num'];
		$data['count_pandan_persent'] = round(($countFlagDoneResult['num'] / $countFlagTotalResult['num']) * 100);
 		$this->load->view('templates/header', $data);
		$this->load->view('pages/home', $data);
		$this->load->view('templates/footer', $data);
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