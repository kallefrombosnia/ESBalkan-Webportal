<?php
$this->Functions->post_header(); 
$this->Functions->post_navbar(); 
$this->Functions->post_naslov(); 
$this->Functions->post_servers(); 
$this->Functions->post_turniri(); 
?>
<div class="col-md-8">
	<div class="panel panel-default panel-box">
	    <div class="panel-body">
	    	<div class="registered">
	    		<h2>Welcome</h2>
	    		<h3>You have been sucessfully registered on ESBalkan.</h3>
	    		<p>Click bellow to login on our website.</p>
	    		<a href="<?php echo site_url('login/'); ?>" class="btn btn-primary">Login</a>
	    	</div>
	    </div>
	</div>
</div>


<?php
$this->Functions->post_footer(); 
?>