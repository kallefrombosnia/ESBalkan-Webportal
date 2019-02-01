<?php
	class Logout extends CI_Controller
	{
		public function index()
		{
			$this->Functions->logOut();
			redirect('/');	
		}
	}
?>