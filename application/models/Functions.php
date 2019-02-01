<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Functions extends CI_Model {

	public function post_header($page = 'default')
    {
        if (!$page || $page == 'default') {
            $this->load->view('includes/header');
        }
    }
    public function post_navbar($page = 'default')
    {
        if (!$page || $page == 'default') {
            $this->load->view('includes/navbar');
        }
    }
    public function post_footer($page = 'default')
    {
        if (!$page || $page == 'default') {
            $this->load->view('includes/footer');
        }
    }
    public function post_servers($page = 'default')
    {
        if (!$page || $page == 'default') {
            $this->load->view('content/servers');
        }
    }
    public function post_naslov($page = 'default')
    {
        if (!$page || $page == 'default') {
            $this->load->view('includes/naslov');
        }
    }
    public function post_turniri($page = 'default')
    {
        if (!$page || $page == 'default') {
            $this->load->view('content/turniri');
        }
    }

	public function register($fn, $ln, $nick, $email, $password, $token,$country)
	{
		return $this->db->set('fname', $fn)
            ->set('lname', $ln)
            ->set('nickname', $nick)
            ->set('email', $email)
            ->set('password', $password)
            ->set('country', $country)
            ->set('confirmed', '0')
            ->set('role', '')
            ->set('token', $token)
            ->set('newcomments', 'on')
            ->set('allcomments', 'on')
            ->set('config', 'on')
            ->set('created_at', date("d-m-Y"))
            ->insert('users');
	}


	public function checkEmail($email)
	{
		// PROVJERA EMAILA

		$this->db->where('email',$email);
	    $query = $this->db->get('users');
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
		
	}

	public function checkNick($nick)
	{
		// PROVJERA NICK

		$this->db->where('nickname',$nick);
	    $query = $this->db->get('users');
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}

	public function loginCheck($email, $pass)
	{

		// PROVJERA AKREDITACIJE

		$query = $this->db
			->where('email', $email)
            ->where('password', $pass)
            ->get('users');

        if ($query->row('id')) {

        	$this->session->set_userdata('id', $query->row('id'));
            return true;
        }
	}

	public function isLoged()
	{

		// PROVJERAVA DA LI JE USER LOGOVAN ILI NE

		if($this->session->userdata('id')){
			return true;
		}
	}

	public function logOut()
	{

		// LOGOUT FUNKCIJA

		if($this->session->unset_userdata(array('id','userinfo','error'))){
			return redirect('/');;
		}
	}


	public function getInfo()
	{

		// CHECKIRA INFO NA OSNOVU SESSION ID
		$data1 = array();
		$this->db->select(array('nickname','avatar','fname','lname'));
        $this->db->from('users');
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->limit('1');

        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data1[] = $row;
            }
        }
        foreach ($data1 as $data2) {
        	$data[] = $data2;
        }
        $this->session->set_userdata('userinfo',$data1);
	}

	public function getPersonalAvatar()
	{

		// DOBAVLJA AVATAR 

		if($this->session->userinfo['0']['avatar']){
			echo ($this->session->userinfo['0']['avatar']);
		}else{
			echo ("default.jpg");
		}
		
	}

	public function getAvatar($avatar)
	{

		// NABAVLJA AVATARE PRILIKOM PREGLEDA PROFILA

		if($avatar){
			echo ($avatar);	
		}else{
			echo ("default.jpg");
		}

	}


	public function getProfile($id)
	{
		$data = array();
		$this->db->select(array('nickname','avatar','fname','lname','team','country','created_at', 'role','description','allcomments','newcomments','config','password','email'));
        $this->db->from('users');
        $this->db->where('id', $id);
        $this->db->limit('1');

        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            //var_dump($data);
            //print_r($data);
            return $data;
        }else{
        	return false;
        }
	}

	public function getCountry($country)
	{
		
		
		if($country=='serbia'){
			echo ('srb.png');
		}else if($country=='bosnia'){
			echo ('bih.png');
		}else if($country=='macedonia'){
			echo ('mac.png');
		}else if($country=='albania'){
			echo ('albania.png');
		}else if($country=='slovenia'){
			echo ('slo.png');
		}else if($country=='croatia'){
			echo ('cro.png');
		}else if($country=='montenegro'){
			echo ('cg.png');
		}else{
			echo ('unknown.jpg');
		}
	
	}

	public function getRank($rank)
	{
		if($rank ===''){
			echo ('Member');
		}else if($rank === '1'){
			echo ('Helper');
		}else if($rank === '2'){
			echo ('Moderator');
		}else if($rank === '3'){
			echo ('Admin');
		}else if($rank === '4'){
			echo ('0wner');
		}else if($rank ==='5'){
			echo ('Owner & Developer');
		}else{

		}

	}

	public function getHardware($id)
	{

		// HARDWARE GET

		$data = array();
		$this->db->select(array('cpu','gpu','monitor','mouse','keyboard','headset','ram','casing','disc','pad','motherboard'));
        $this->db->from('hardware');
        $this->db->where('user_id', $id);
        $this->db->limit('1');
        $query = $this->db->get();        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }else{
        	return false;
        }
	}

	public function postHardware($cpu,$gpu,$ram,$disc,$case,$motherboard,$mouse,$keyboard,$pad,$monitor,$headset)
	{
		
		$sql = "UPDATE hardware SET cpu=?, gpu=?, ram=?, disc=?, casing=?, motherboard=?, mouse=?, keyboard=?, pad=?, monitor=?, headset=? WHERE user_id=?";
		if($this->db->query($sql, array($cpu,$gpu,$ram,$disc,$case,$motherboard,$mouse,$keyboard,$pad,$monitor,$headset,$this->session->id))){
			return true;
		}
		
	}

	public function postProfileComment($id, $text)
	{

		// UPISUJE NOVI KOMENTAR U DB

		return $this->db->set('profile_id', $id)
            ->set('commenter_id', $this->session->id)
            ->set('comment', $text)
            ->insert('profilecomments');
	}

	public function getProfileComments($limit, $start, $id)
	{
		$data = array();
		$this->db->select(array('commenter_id','comment','created_at'));
		$this->db->from('profilecomments');
		$this->db->where('profile_id', $id);
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit($limit,$start);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function countProfileComments($id)
	{

		$query = $this->db->query('SELECT * FROM profilecomments WHERE profile_id="'.$id.'"');
        return $query->num_rows(); 
        
	}

	public function userPreferencesPost($allcomments,$newcomments,$config)
	{
        $sql = ('UPDATE users SET allcomments=? WHERE id='.$this->session->id.'');

		$sql1 = ('UPDATE users SET newcomments=? WHERE id='.$this->session->id.'');

		$sql2 = ('UPDATE users SET config=? WHERE id='.$this->session->id.'');
		
		if($this->db->query($sql, array($allcomments)) && $this->db->query($sql1, array($newcomments))&& $this->db->query($sql2, array($config)))
		{
			return true;
		}
	}

	public function dateConversion($date,$mode='default')
	{
		if($mode==='default'){
		return str_replace('-', '.', $date);
		}else{
			/*
			$array = array_pop($data);
			var_dump($array);
			array_slice(, offset)
			*/
		}
	}

	public function getSettings($id)
	{
		$data = array();
		$this->db->select(array('newcomments','allcomments','description','config'));
        $this->db->from('users');
        $this->db->where('id', $id);
        $this->db->limit('1');
        $query = $this->db->get();        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }else{
        	return false;
        }
	}

	public function userInfoPost($desc)
	{
		
		$sql = ('UPDATE users SET description=? WHERE id='.$this->session->id.'');

		if($this->db->query($sql, array($desc)))
		{
			return true;
		}
	}

	public function userConfigPost($name)
	{
		return $this->db->set('name', $name)
            ->set('user_id', $this->session->id)
            ->set('downloads', '0')
            ->set('uniquedownloads', '0')
            ->insert('configs');
	}

	public function userConfigUpdate($name,$oldcfg)
	{
		$sql = ('UPDATE configs SET name=? WHERE user_id='.$this->session->id.'');
		if($this->db->query($sql, array($name))&&unlink('./users/config/'.$oldcfg.'.zip')){
			return true;
		}
	}


	public function getConfig($id)
	{
		$data = array();
		$this->db->select(array('id','name','downloads','uniquedownloads'));
        $this->db->from('configs');
        $this->db->where('user_id', $id);
        $this->db->limit('1');
        $query = $this->db->get();        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }else{
        	return false;
        }
	}

	public function userDownloadsGet($id,$ip)
	{

        $query = $this->db->query("SELECT id FROM downloads WHERE config_id=".$this->db->escape($id)." AND ip=".$this->db->escape($ip)."");
        return $query->num_rows(); 
	}

	public function userDownloadsPost($id,$ip)
	{
		return $this->db->set('config_id', $id)
            ->set('ip', $ip)
            ->insert('downloads');
	}

	// KLAN FUNKCIJE //

	public function getClan($id)
	{
		$data = array();
		$this->db->select(array('name','avatar','cover','wins','description','leader', 'gameleader','created_at','modified_at','country','activity'));
        $this->db->from('clans');
        $this->db->where('id', $id);
        $this->db->limit('1');

        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            //var_dump($data);
            //print_r($data);
            return $data;
        }else{
        	return false;
        }
	}

	public function getClanPlayers($id)
	{
		$data = array();
		$this->db->select(array('id','fname','lname','nickname','country'));
        $this->db->from('users');
        $this->db->where('team', $id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            //var_dump($data);
            //print_r($data);
            return $data;
        }else{
        	return false;
        }
	}

	public function getClanAvchiments($id)
	{
		$data = array();
		$this->db->select(array('id','fname','lname','nickname','country'));
        $this->db->from('users');
        $this->db->where('team', $id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            //var_dump($data);
            //print_r($data);
            return $data;
        }else{
        	return false;
        }
	}

	public function clanPrefPost($activity,$clanid){

        $sql = ('UPDATE clans SET activity=? WHERE id='.$id.'');

	
		if($this->db->query($sql, array($allcomments)))
		{
			return true;
		}
	}











}

?>