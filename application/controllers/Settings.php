<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller {


	public function index()
	{
		// Redirect        
       	redirect('/');
	}

	public function profile($id)
	{

		if($this->Functions->isLoged()){
			if($id != $this->session->id){
				redirect('/');
			}else{
				$hardware = $this->Functions->getHardware($id);
				$settings = $this->Functions->getSettings($id);
				$getconfig = $this->Functions->getConfig($id);
				$data = $this->Functions->getProfile($id);	
				$this->load->view('includes/header',array('title' => 'Settings - ESB'));
				$this->load->view('includes/navbar');
				$this->load->view('includes/naslov');
				$this->load->view('content/servers');
				$this->load->view('content/turniri');
				$this->load->view('actions/settings',
					array(
							'allcomments' => $settings['0']['allcomments'],
							'newcomments' => $settings['0']['newcomments'],
							'description' => $settings['0']['description'],
							'showconfig' => $settings['0']['config'],
							'configname' => $getconfig['0']['name'],
							'configdownloads' => $getconfig['0']['downloads'],
							'configuniquedownloads' => $getconfig['0']['uniquedownloads'],
							'avatar' => $data['0']['avatar'],
								'cpu' => $hardware['0']['cpu'],
							'gpu' => $hardware['0']['gpu'],
							'disc' => $hardware['0']['disc'],
							'pad' => $hardware['0']['pad'],
							'mouse' => $hardware['0']['mouse'],
							'headset' => $hardware['0']['headset'],
							'keyboard' => $hardware['0']['keyboard'],
							'monitor' => $hardware['0']['monitor'],
							'casing' => $hardware['0']['casing'],
							'ram' => $hardware['0']['ram'],
							'motherboard' => $hardware['0']['motherboard'],
					));			
				$this->load->view('includes/footer');
			}
        }else{                   
       		redirect('/login');
		}
	}

	public function editpref()
	{
	
		$newcomm = $this->input->post('new_comments');
		$allcomm = $this->input->post('all_comments');
		$config = $this->input->post('show_config');

		if(is_null($newcomm)){
			$newcomm = 'off';
		}
		if(is_null($allcomm)){
			$allcomm = 'off';
		}
		if(is_null($config)){
			$config = 'off';
		}

		if($this->Functions->userPreferencesPost($allcomm,$newcomm,$config)){
			redirect('settings/profile/'.$this->session->id);
		}else{
			echo "not good";
		}
	}

	public function editinfo()
	{
		$desc = html_escape($this->input->post('description'));
		var_dump($desc);
		if (!$desc) {
 			// PROVJERA INPUTA
        	$this->session->set_flashdata('error', 'Fill all fields, please.');
        	$this->session->keep_flashdata('error');
        	redirect('settings/profile/'.$this->session->id);
        }else{
        	if($this->Functions->userInfoPost($desc)){
        		redirect('settings/profile/'.$this->session->id);
        	}
        }
	}

	public function uploadconfig()
	{
		$name = random_string('alnum', 32);
		$config['upload_path'] = 'users/config/';
		$config['allowed_types'] = 'zip';
		$config['max_size']     = '5120';
		$config['file_name']     = $name;
		$this->upload->initialize($config);

        if ( ! $this->upload->do_upload('file'))
        {         
            $this->session->set_flashdata('error1', $this->upload->display_errors());
        	$this->session->keep_flashdata('error1');
        	redirect('settings/profile/'.$this->session->id);
        }     
        else
        {
        
        	$configinfo = $this->Functions->getConfig($this->session->id);

        	if($configinfo['0']['name']==''){
        		if($this->Functions->userConfigPost($name)){
        			redirect('settings/profile/'.$this->session->id);
        		}
        	}else{
        		if($this->Functions->userConfigUpdate($name,$configinfo['0']['name'])){
        			redirect('settings/profile/'.$this->session->id);
        		}
        	}
        }
	}

	public function uploadavatar()
	{
		$name = random_string('alnum', 32);
		$config['upload_path'] = 'users/pictures/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']     = '5120';
		$config['file_name']     = $name;
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file'))
        {         
            $this->session->set_flashdata('error2', $this->upload->display_errors());
        	$this->session->keep_flashdata('error2');
        	redirect('settings/profile/'.$this->session->id);
        }     
        else
        {
        	$oldavatar = $this->Functions->getProfile($this->session->id);
        	$name = ($name."".$this->upload->data('file_ext'));
        	$this->db->query("UPDATE users SET avatar=".$this->db->escape($name)." where id=".$this->session->id."");
        	unlink('./users/pictures/'.$oldavatar['0']['avatar']);
        	redirect('settings/profile/'.$this->session->id);

        }
	}

	public function editpassword()
	{
		$info = $this->Functions->getProfile($this->session->id);
		$oldpassword = html_escape($this->input->post('oldpassword'));
		$newpassword = html_escape($this->input->post('newpassword'));
		$newpasswordconf = html_escape($this->input->post('confnewpassword'));

		if (!$oldpassword || !$newpassword || !$newpasswordconf)
		{
 			// PROVJERA INPUTA
        	$this->session->set_flashdata('error3', 'Fill all fields, please.');
        	$this->session->keep_flashdata('error3');
        	redirect('settings/profile/'.$this->session->id);
       	}
       	else
       	{

       		if(md5($oldpassword) == $info['0']['password'])
       		{
       			if($newpassword===$newpasswordconf)
       			{
       				$password = md5($newpassword);
       				$this->db->query("UPDATE users SET password=".$this->db->escape($password)." where id=".$this->session->id."");
       				redirect('settings/profile/'.$this->session->id);

       			}
       			else
       			{
	       			$this->session->set_flashdata('error3', 'New passwords dont match.');
		        	$this->session->keep_flashdata('error3');
		        	redirect('settings/profile/'.$this->session->id);	
       			}

       		}
       		else
       		{
	       		$this->session->set_flashdata('error3', 'Old passwords dont match.');
	        	$this->session->keep_flashdata('error3');
	        	redirect('settings/profile/'.$this->session->id);
       		}
       	}
	}

	public function editemail()
	{
		$info = $this->Functions->getProfile($this->session->id);
		$oldemail = html_escape($this->input->post('oldemail'));
		$newemail = html_escape($this->input->post('newemail'));

		if (!$oldemail|| !$newemail)
		{
 			// PROVJERA INPUTA
        	$this->session->set_flashdata('error4', 'Fill all fields, please.');
        	$this->session->keep_flashdata('error4');
        	redirect('settings/profile/'.$this->session->id);
       	}
       	else
       	{
       		if($oldemail==$info['0']['email'])
       		{
       			$this->db->query("UPDATE users SET email=".$this->db->escape($newemail)." where id=".$this->session->id."");
       				redirect('settings/profile/'.$this->session->id);
       		}
       		else
       		{
	       		$this->session->set_flashdata('error4', 'Old emails dont match.');
	        	$this->session->keep_flashdata('error4');
	        	redirect('settings/profile/'.$this->session->id);
       		}


       	}
	}

	public function edithardware()
	{
		$cpu = html_escape($this->input->post('cpu'));
		$gpu = html_escape($this->input->post('gpu'));
		$ram = html_escape($this->input->post('ram'));
		$case = html_escape($this->input->post('case'));
		$motherboard = html_escape($this->input->post('motherboard'));
		$mouse = html_escape($this->input->post('mouse'));
		$keyboard = html_escape($this->input->post('keyboard'));
		$pad = html_escape($this->input->post('pad'));
		$monitor = html_escape($this->input->post('monitor'));
		$headset = html_escape($this->input->post('headset'));
		$disc = html_escape($this->input->post('disc'));

		if($this->Functions->postHardware($cpu,$gpu,$ram,$disc,$case,$motherboard,$mouse,$keyboard,$pad,$monitor,$headset))
		{
			
			redirect('settings/profile/'.$this->session->id);
		}	
	}



	// CLAN PART

	public function clan($id){

		if($this->Functions->isLoged()){

			$getclan = $this->Functions->getClan($id);
		

			$good = 'false';

			if($getclan['0']['leader'] == $this->session->id){
				$good = 'true';
			}

			if($getclan['0']['gameleader'] == $this->session->id){
				$good = 'true';
			}

			if($good === 'true'){
				$players = $this->Functions->getClanPlayers($id);
				$this->load->view('includes/header',array('title' => 'Settings - ESB'));
				$this->load->view('includes/navbar');
				$this->load->view('includes/naslov');
				$this->load->view('content/servers');
				$this->load->view('content/turniri');
				$this->load->view('actions/settingsclan',
					array(
							'id' => $id,
							'players' => $players,
							'activity' => $getclan['0']['activity'],
							'description' => $getclan['0']['description']
					));			
				$this->load->view('includes/footer');
			}else{
				redirect('/');
			}
		}else
		{
			redirect('/');
		}
	}

	public function editclanpref($id){
	
		$activity = $this->input->post('activity');
		
		if(is_null($activity)){
			$activity = 'Non Active';
		}

		if($this->Functions->clanPrefPost($activity,$id)){
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "not good";
		}
	}




}