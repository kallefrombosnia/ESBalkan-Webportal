<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{	
		if($this->Functions->isLoged()){
			redirect('/');
        }else{
		$this->load->view('actions/register', array('title' => 'Registracija - ESB'));
		}
	}


	public function action()
	{
		// POST PODATAKA
		$fn = html_escape($this->input->post('fname'));
        $ln = html_escape($this->input->post('lname'));
        $email = html_escape($this->input->post('email'));
        $nick = html_escape($this->input->post('nick'));
        $pass = html_escape($this->input->post('password'));
        $password_check = html_escape($this->input->post('password-check'));
        $country = html_escape($this->input->post('country'));
        
        // PROVJERA INPUTA
        if (!$fn || !$ln || !$email || !$nick || !$pass || !$password_check|| !$country) {
 			// PROVJERA INPUTA
        	$this->session->set_flashdata('error', 'Fill all fields, please.');
        	$this->session->keep_flashdata('error');
        	redirect('register/');
        	
        }else{
        	// PROVJERA MATCHA PASSWORDA
        	if($pass != $password_check){
        		$this->session->set_flashdata('error', 'Passwords does not match!');
	        	$this->session->keep_flashdata('error');
	        	redirect('register/'); 

        	}else{

        		if($this->Functions->checkEmail($email)){
        			$this->session->set_flashdata('error', 'Email already exists!');
	        		$this->session->keep_flashdata('error');
	        		redirect('register/'); 
        		}else{

        			if($this->Functions->checkNick($nick)){
        				$this->session->set_flashdata('error', 'Nick already exists!');
	        			$this->session->keep_flashdata('error');
	        			redirect('register/'); 
        			}else{

        				// CONFIRMATION TOKEN GENERATOR
	        			$token = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));

	        			// UPISIVANJE U DATABAZU
				        if ($this->Functions->register($fn, $ln, $nick, $email, md5($pass), $token, $country))
				        {
				        	
							$this->load->view('landing/register', array('title' => 'Registracija - ESB'));
				        }else{
				        	echo "cheater caught!";
				        }
        			}

        		}
        		
		    }
        }
	}
}

?>