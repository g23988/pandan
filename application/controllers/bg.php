<?php
class Bg extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')===false){
			redirect('signout','refresh');
			return;
			}
		$this->load->model('bg_model');
		}
	public function view(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->showBgPage($data);
			}
		else{
			show_404();
			}
		}
	public function delete($bgid){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		if($username ==='admin'){
			$this->bg_model->delete_bgs($bgid);
			$this->showBgPage($data);
			}
		else{
			show_404();
			}
		}
	public function add(){
		//確認身分
		$username = $this->session->userdata('username');
		$data['username'] = $username;
		//驗證bg資料
		$this->form_validation->set_rules('bgname','bgname','required');
		
		if($this->form_validation->run() === false){ 
			$this->showBgPage($data);
			return;
		};
		
		if($username ==='admin'){
			$this->bg_model->insert_bgs();
			$this->showBgPage($data);
			}
		else{
			show_404();
			}
		}
	//顯示單元 for view
	public function showBgPage($data){
			$data['bgs'] = $this->bg_model->get_bgs();
			$data['userinfo'] = $this->session->userdata('userinfo');
			$this->load->view('templates/header',$data);
			$this->load->view('admin/bg/bgEdit',$data);
			$this->load->view('templates/footer');
		}
	
	
	}
		

?>