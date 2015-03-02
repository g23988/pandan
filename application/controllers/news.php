<?php
class News extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('news_model');
		}
	public function index(){
		$data['news']= $this->news_model->get_news();
		$data['title']= 'News archive';
		
		$this->load->view('templates/header',$data);
		$this->load->view('news/index',$data);
		$this->load->view('templates/footer');
		}
	public function view($slug){
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
		$this->form_validation->set_rules('text','內文','trim|required|xss_clean');
		
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
	public function delete($newsid){
		$this->news_model->delete_news($newsid);
		redirect('','refresh');
		}
	
	
	
	
	}

?>