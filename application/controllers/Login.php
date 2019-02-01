<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {


	public function index()
	{
		// GLAVNA PROVJERA LOGINA
		if($this->Functions->isLoged()){
			redirect('/');
        }else{                   
			$this->load->view('includes/header', array('title' => 'Login - ESB'));
			$this->load->view('includes/navbar');
			$this->load->view('includes/naslov');
			$this->load->view('content/servers');
			$this->load->view('content/turniri');
			$this->load->view('actions/login');
			$this->load->view('includes/footer');         
        }	
	}

	public function action()
	{
		$email = html_escape($this->input->post('email'));
		$pass = html_escape($this->input->post('password'));

		if (!$email || !$pass) {
 			// PROVJERA INPUTA
        	$this->session->set_flashdata('error', 'Fill all fields, please.');
        	$this->session->keep_flashdata('error');
        	redirect('login/');
        	
        }else{
        	// PROVJERA MATCHA PASSWORDA I EMAILA
        	if(!$this->Functions->loginCheck($email,md5($pass))){
        		//  CUSTOM PORUKA ZA WRONG PODATKE
        		$this->session->set_flashdata('error', 'Wrong password or account doesnt exists!');
	        	$this->session->keep_flashdata('error');
	        	// REDIREKT NA LOGIN FORMU UZ PRIKAZ ERROR PORUKE
	        	redirect('login/'); 
        	}else{
        		// FUNKCIJA ZA SESSION UPDATE OKO HTMLA
        		$this->Functions->getInfo();
        		// DELETE ERROR AKO JE OSTAO OD PRIJE
        		$this->session->unset_userdata('error');
        		// REDIRECT NA POČETNU JER JE LOGIN VALIDAN
        		redirect('/');
		    }
        }
	}


}

?>