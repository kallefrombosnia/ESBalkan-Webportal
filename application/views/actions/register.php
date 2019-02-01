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
			<div class="box registration-form">
		    	<h2>Registration</h2>
		        <p>Create your new account and get some premium features. Already have an account? Then you can <a href="<?php echo site_url('login/'); ?>">sign in</a> with your existing username and password.</p>
		        <ul>
		        	<li>With registration you can create own gaming profile.</li>
		            <li>Registrations brings you whole CounterStrike community.</li>
		            <li>And much much more!</li>
		        </ul>
		 
		  		<?php if($this->session->flashdata('error')){
		  			?>	
		  			<div class="alert alert-danger alert-dismissible fade in">
		  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  							<b>Danger!</b> <?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php
		  			}	
		  			$this->session->unmark_flash('error');
		  		?>

		       <?php echo form_open('register/action'); ?>

		        	<div class="form-group">
		                <label>Name</label>
		              
		                <?= form_input(array('name' => 'fname','id' => 'fname', 'maxlength' => '20', 'minlength' => '3'), '', array('class'=>'form-control', 'placeholder'=>'First Name', 'data-validation'=>'required alphanumeric')); ?>
		            </div>

		            <div class="form-group">
		                <label>Last name</label>
		                <?= form_input(array('name' => 'lname','id' => 'lname', 'maxlength' => '30', 'minlength' => '5'), '', array('class'=>'form-control', 'placeholder'=>'Last Name', 'data-validation'=>'required alphanumeric')); ?>
		            </div>

		            <div class="form-group">
		                <label>Your nick?</label>
		                <?= form_input(array('name' => 'nick','id' => 'nick', 'maxlength' => '18', 'minlength' => '3'), '', array('class'=>'form-control', 'placeholder'=>'Nickname', 'data-validation'=>'required alphanumeric')); ?>
		            </div>

		            <div class="form-group">
		                <label>Email address</label>
		                <?= form_input(array('name' => 'email','id' => 'email', 'maxlength' => '', 'minlength' => '1', 'type' => 'email'), '', array('class'=>'form-control', 'placeholder'=>'Email', 'data-validation'=>'required alphanumeric')); ?>
		            </div>
		            <div class="form-group">
		            	<label>Country:  </label>
		            	<?php
		            	$options = array(
						        'bosnia'         => 'Bosnia and Herzegovina',
						        'serbia'           => 'Serbia',
						        'croatia'         => 'Croatia',
						        'macedonia'        => 'Macedonia',
						        'montenegro'        => 'Montenegro',
						        'albania'        => 'Albania',
						        'slovenia'        => 'Slovenia'
						);

						echo form_dropdown('country', $options, 'bih');

		            	?>
		            </div>
		            <div class="form-group">
		                <label>Password</label>
		                <?= form_password(array('name' => 'password','id' => 'password', 'maxlength' => '', 'minlength' => '8'), '', array('class'=>'form-control', 'placeholder'=>'Password', 'data-validation'=>'required alphanumeric')); ?>
		            </div>
		            <div class="form-group">
		                <label>Password again</label>

		                <?= form_password(array('name' => 'password-check','id' => 'password-check', 'maxlength' => '', 'minlength' => '8'), '', array('class'=>'form-control', 'placeholder'=>'Repeat password', 'data-validation'=>'required alphanumeric')); ?>
		            </div>
		            <button value="submit" role="submit" class="btn btn-primary">Submit</button>
		        </form>
		    </div>
		</div>
	</div>
</div>

<?php
$this->Functions->post_footer(); 
?>
