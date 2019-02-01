<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller {


	public function index()
	{
		// Redirect        
       	redirect('/');
	}


	public function config($id)
	{
		if($this->Functions->isLoged())
		{
			$data = file_get_contents(base_url()."/users/config/".$id.".zip");
		    $name = ("[ESBalkan]".$id.".zip");
		    $ip = $_SERVER['REMOTE_ADDR'];
		    
		    $getconfig = $this->Functions->getConfig($this->session->id);

		    $getdownloads = $this->Functions->userDownloadsGet($getconfig['0']['id'],$ip);
		    
		    var_dump($getdownloads);
		    if($getdownloads=='0')
		    {
		    	$this->Functions->userDownloadsPost($getconfig['0']['id'],$ip);
		    	$this->db->query('UPDATE configs SET uniquedownloads=uniquedownloads+1 where id='.$getconfig['0']['id'].'');
		    	force_download($name,$data);
		    	redirect($this->agent->referrer());

		    }	    
		    else
		    {
		    	$this->Functions->userDownloadsPost($getconfig['0']['id'],$ip);
		    	$this->db->query('UPDATE configs SET downloads=downloads+1 where id='.$getconfig['0']['id'].'');
		    	force_download($name,$data);
		    	redirect($this->agent->referrer());
		    }
		}
		else
		{
			redirect('login');
		}
	}





}
?>