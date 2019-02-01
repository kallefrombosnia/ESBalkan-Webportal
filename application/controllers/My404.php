<?php 
class My404 extends CI_Controller 
{

	public function index() 
	{ 
	$this->output->set_status_header('404'); 
	$data['title'] = "Oops! Not found.";
	$this->load->helper('html');
	$this->load->helper('url');
	$this->load->view('includes/header',$data);
	$this->load->view('includes/navbar');
	$this->load->view('includes/naslov');
	$this->load->view('content/servers');
	$this->load->view('content/turniri');
	$this->load->view('errors/404');
	$this->load->view('includes/footer');	
	} 

}

?>