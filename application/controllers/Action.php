<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Action extends CI_Controller {


	public function index()
	{
		// GLAVNA PROVJERA LOGINA
		if($this->Functions->isLoged()){
			redirect('/');
        }else{                   
       		redirect('/');
		}	
	}

	public function postcom()
	{

		if($this->Functions->isLoged()){
			$text = html_escape($this->input->post('comment'));
			$id = html_escape($this->input->post('id'));

			if (!$text) {
	 			// PROVJERA INPUTA
	        	$this->session->set_flashdata('error', 'Fill all fields, please.');
	        	$this->session->keep_flashdata('error');
	        	redirect($this->agent->referrer());   	
	        }else{

	        	$this->Functions->postProfileComment($id, $text);
	        	redirect($this->agent->referrer());
	        
	        }

	    }else{                   
	       	redirect('/');
		}
	}





}
?>