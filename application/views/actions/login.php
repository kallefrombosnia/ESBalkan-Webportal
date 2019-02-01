 <div class="col-md-8">
	<div class="panel panel-default panel-box">
	    <div class="panel-body">
			<div class="box registration-form">
		    	<h2>Login</h2>
		 
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

		       <?php echo form_open('login/action'); ?>

		            <div class="form-group">
		                <label>Email address</label>
		                <?= form_input(array('name' => 'email','id' => 'email', 'maxlength' => '', 'minlength' => '', 'type' => 'email'), '', array('class'=>'form-control', 'placeholder'=>'Email', 'data-validation'=>'required alphanumeric')); ?>
		            </div>
		            </div>
		            <div class="form-group">
		                <label>Password</label>
		                <?= form_password(array('name' => 'password','id' => 'password', 'maxlength' => '', 'minlength' => '8'), '', array('class'=>'form-control', 'placeholder'=>'Password', 'data-validation'=>'required alphanumeric')); ?>
		            </div>
		            <button value="submit" role="submit" class="btn btn-primary">Submit</button>
		            <div class="pull-right"><a href="#">Did you forget you password?</a></div>
		        </form>
		    </div>
		</div>
	</div>
</div>