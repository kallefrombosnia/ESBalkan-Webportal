<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class View extends CI_Controller
	{

		public function index()
		{
			redirect('/');
		}

		public function profile($id,$row='0')
		{
			if($this->Functions->getProfile($id)){
				
				// INFO GET
				$data = $this->Functions->getProfile($id);	
				$hardware = $this->Functions->getHardware($id);
				$getconfig = $this->Functions->getConfig($id);
				$count = $this->Functions->countProfileComments($id);
				$limit = '4';
				$row = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$row = max(0, ( $row -1 ) * $limit);
				$comments = $this->Functions->getProfileComments($limit, $row, $id);
				$date = $this->Functions->dateConversion($data['0']['created_at']);

				// Pagination Configuration
			    $config['base_url'] = base_url().'index.php/view/profile/'.$id.'/';
			    $config['uri_segment'] = 4;
			    $config['total_rows'] = $count;
			    $config['per_page'] = $limit;
			    $choice = $config['total_rows'] / $config['per_page'];
   				$config['num_links'] = round($choice);

			    // Customize
			    $config['use_page_numbers'] = TRUE;
			    $config['full_tag_open'] = '<ul class="pagination">';
			    $config['full_tag_close'] = '</ul>';
			    $config['cur_tag_open'] = '<li class="active"><a>';
			    $config['cur_tag_close'] = '</a></li>';
			    $config['next_tag_open'] = '<li>';
			    $config['next_tag_close'] = '</li>';
			    $config['num_tag_open'] = '<li>';
			    $config['num_tag_close'] = '</li>';
			    $config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';

			    // Initialize
			    $this->pagination->initialize($config);     
				$pagination = $this->pagination->create_links();
			

				$this->load->view('includes/header',array('title' => 'Profile - ESB'));
				$this->load->view('includes/navbar');
				$this->load->view('includes/naslov');
				$this->load->view('content/servers');
				$this->load->view('content/turniri');
				$this->load->view('actions/profile', 
					array(	'id' => $id,
							'fname' => $data['0']['fname'],
							'lname' => $data['0']['lname'], 
							'nickname' => $data['0']['nickname'], 
							'avatar' => $data['0']['avatar'], 
							'team' => $data['0']['team'], 
							'country' => $data['0']['country'], 
							'created_at' => $date, 
							'role' => $data['0']['role'],
							'description' => $data['0']['description'],
							'newcomments' => $data['0']['newcomments'],
							'allcomments' => $data['0']['allcomments'],
							'showconfig' => $data['0']['config'],
							'configname' => $getconfig['0']['name'],
							'configdownloads' => $getconfig['0']['downloads'],
							'configuniquedownloads' => $getconfig['0']['uniquedownloads'],
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
							'pagination' => $pagination,
							'results' => $comments,
							'row' => $row
							));
				$this->load->view('includes/footer'); 
			}else{
				redirect('');
			}

		}

		public function clan($id)
		{
			if($this->Functions->getClan($id))
			{
				$data = $this->Functions->getClan($id);
				$players = $this->Functions->getClanPlayers($id);
				$date = $this->Functions->dateConversion($data['0']['created_at']);
				$this->load->view('includes/header',array('title' => 'Clan profile - ESB'));
				$this->load->view('includes/navbar');
				$this->load->view('includes/naslov');
				$this->load->view('content/servers');
				$this->load->view('content/turniri');
				$this->load->view('actions/clan',
					array(
							'id' => $id,
							'name' => $data['0']['name'],
							'avatar' => $data['0']['avatar'],
							'cover' => $data['0']['cover'],
							'wins' => $data['0']['wins'],
							'description' => $data['0']['description'],
							'leader' => $data['0']['leader'],
							'gameleader' => $data['0']['gameleader'],
							'created_at' => $date,
							'country' => $data['0']['country'],
							'activity' => $data['0']['activity'],
							'players' => $players
						));
				$this->load->view('includes/footer');

			}
			else
			{
				redirect('/');
			}
		}





	}
?>