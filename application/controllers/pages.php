<?php

class Pages extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('news_model');
		}
	public function view()
	{
		$data['username'] = $this->session->userdata('username');
		$data['userinfo'] = $this->session->userdata('userinfo');
		$data['news'] = $this->news_model->get_news();
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