<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{	
		$data['title'] = "Početna - ESB";
		$this->load->view('includes/header',$data);
		$this->load->view('includes/navbar');
		$this->load->view('includes/naslov');
		$this->load->view('content/servers');
		$this->load->view('content/turniri');
		$this->load->view('content/blog');
		$this->load->view('includes/footer');	
		
		// KONSTANTNI REFRESH INFO FUNKCIJE
		$this->Functions->getInfo();
	}
}

?>