<div class="col-md-8">
	<div class="panel panel-default panel-box">
    	<div class="panel-body">
			<h3>Account settings:</h3>
			<hr>
			<div class="settings">
				<?php echo form_open('/settings/editpref') ?>	
				<h2>User preferences:<span class="pull-right"><button value="submit" role="submit" class="btn btn-primary">Save</button></span></h2>
							<ul class="list-unstyled">
								<li><strong>Enable new comments</strong>
								<?php 
								if($newcomments=='on'){
								?>
								<input name="new_comments" type="checkbox" checked data-toggle="toggle" data-onstyle="success"  data-offstyle="danger" data-size="small">
								<?php
								}else{ 
								?>
								<input name="new_comments" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="small">
								<?php
								}
								?>
								</li>
								<li><strong>Enable all comments</strong>
								<?php 
								if($allcomments=='on'){
								?>
								<input name="all_comments" type="checkbox" checked data-toggle="toggle" data-onstyle="success"  data-offstyle="danger" data-size="small">
								<?php
								}else{ 
								?>
								<input name="all_comments" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="small">
								<?php
								}
								?>
								</li>
								<li><strong>Enable config download</strong>
								<?php 
								if($showconfig=='on'){
								?>
								<input name="show_config" type="checkbox" checked data-toggle="toggle" data-onstyle="success"  data-offstyle="danger" data-size="small">
								<?php
								}else{ 
								?>
								<input name="show_config" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="small">
								<?php
								}
								?>
								</li>			
							</ul>
					</form>
				<hr>
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
		  		<?php echo form_open('/settings/editinfo') ?>
				<h2>User info:<span class="pull-right"><button name="submit1" value="submit1" role="submit1" class="btn btn-primary">Save</button></span></h2>
				<ul class="list-unstyled">
					<li><strong>Description:</strong>
					 <?= form_textarea(array('name' => 'description','id' => 'description', 'maxlength' => '255', 'minlength' => '', 'type' => '', 'style' => 'height: 100px !important;resize: vertical;', 'value' =>$description), '', array('class'=>'form-control', 'placeholder'=>'Description', 'data-validation'=>'required alphanumeric')); ?>	
				</ul>
				</form>
				<hr>
				<?php if($this->session->flashdata('error1')){
		  			?>	
		  			<div class="alert alert-danger alert-dismissible fade in">
		  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  							<b>Danger!</b> <?php echo $this->session->flashdata('error1'); ?>
					</div>
					<?php
		  			}	
		  			$this->session->unmark_flash('error1');
		  		?>
		  		<?php echo form_open_multipart('/settings/uploadconfig') ?>
				<ul class="list-unstyled">
				<h2>Game config: <span class="pull-right"><button name="submit2" value="submit2" role="submit2" class="btn btn-primary">Save</button></span></h2>
					<li style="padding-top:14px"><?= form_upload(array('name' => 'file','id' => 'file', 'maxlength' => '', 'minlength' => '', 'style' => ''), '', array('class'=>'form-control', 'placeholder'=>'', 'data-validation'=>'')); ?></li>
					<li style="padding-top:14px"><strong>Downloads:</strong><?= $configdownloads; ?> </li>
					<li><strong>Unique downloads:</strong><?= $configuniquedownloads; ?> </li>
				</ul>
				</form>
				<hr>
				<?php if($this->session->flashdata('error2')){
		  			?>	
		  			<div class="alert alert-danger alert-dismissible fade in">
		  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  							<b>Danger!</b> <?php echo $this->session->flashdata('error2'); ?>
					</div>
					<?php
		  			}	
		  			$this->session->unmark_flash('error2');
		  		?>
		  		<script>
				  var loadFile = function(event) {
				    var reader = new FileReader();
				    reader.onload = function(){
				      var output = document.getElementById('output');
				      var output1 = document.getElementById('output1');
				      var output2 = document.getElementById('output2');
				      output.src = reader.result;
				      output1.src = reader.result;
				      output2.src = reader.result;
				    };
				    reader.readAsDataURL(event.target.files[0]);
				  };
				</script>
				<?php echo form_open_multipart('/settings/uploadavatar') ?>
				<ul class="list-unstyled">
				<h2>User avatar: <span class="pull-right"><button name="submit2" value="submit2" role="submit2" class="btn btn-primary">Save</button></span></h2>
					<li style="padding-top:14px"><?= form_upload(array('name' => 'file1','id' => 'file1', 'maxlength' => '', 'minlength' => '', 'style' => '','onchange'=>'loadFile(event)', 'accept'=>'image/*'), '', array('class'=>'form-control', 'placeholder'=>'', 'data-validation'=>'')); ?></li>
				</ul>
				</form>
				<div class="col-md-12">
					<div class="col-md-4">
						<h2 class="textcenter">Big</h2>
						<img src="<?php echo base_url();?>users/pictures/<?php 
	    				$this->Functions->getAvatar($avatar);
	    			?>" id="output" class="img-responsive img-circle center-block big" alt="Profile picture">
	    				</img>
	    				
					</div>
					<div class="col-md-4">
						<h2 class="textcenter">Medium</h2>
						<img src="<?php echo base_url();?>users/pictures/<?php 
	    				$this->Functions->getAvatar($avatar);
	    			?>" id="output1" class="img-responsive img-circle center-block medium" alt="Profile picture">
	    				</img>
	    				
					</div>
					<div class="col-md-4">
						<h2 class="textcenter">Small</h2>
						<img src="<?php echo base_url();?>users/pictures/<?php 
	    				$this->Functions->getAvatar($avatar);
	    			?>." id="output2" class="img-responsive img-circle center-block small" alt="Profile picture">
	    				</img>
					</div>
				</div>
				  		
		  		<div style="padding-top: 180px">
		  			<hr>
		  		<?php if($this->session->flashdata('error3')){
		  			?>	
		  			<div class="alert alert-danger alert-dismissible fade in">
		  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  							<b>Danger!</b> <?php echo $this->session->flashdata('error3'); ?>
					</div>
					<?php
		  			}	
		  			$this->session->unmark_flash('error3');
		  		?>
			  		<?php echo form_open('/settings/editpassword') ?>
					<h2>Account password: <span class="pull-right"><button name="submit1" value="submit1" role="submit1" class="btn btn-primary">Save</button></span></h2>
					<ul class="list-unstyled">
						<li><strong>Old password:</strong>
						 <?= form_password(array('name' => 'oldpassword','id' => 'oldpassword', 'maxlength' => '', 'minlength' => '8'), '', array('class'=>'form-control', 'placeholder'=>'Old password', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>New password:</strong>
						 <?= form_password(array('name' => 'newpassword','id' => 'newpassword', 'maxlength' => '', 'minlength' => '8', 'type'=>'email'), '', array('class'=>'form-control', 'placeholder'=>'New password', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Confirm new password:</strong>
						 <?= form_password(array('name' => 'confnewpassword','id' => 'confnewpassword', 'maxlength' => '', 'minlength' => '8', 'type'=>'email'),  '', array('class'=>'form-control', 'placeholder'=>'Confirm new password', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
					</ul>
					</form>
				</div>
				<hr>
				<?php if($this->session->flashdata('error4')){
		  			?>	
		  			<div class="alert alert-danger alert-dismissible fade in">
		  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  							<b>Danger!</b> <?php echo $this->session->flashdata('error4'); ?>
					</div>
					<?php
		  			}	
		  			$this->session->unmark_flash('error4');
		  		?>
			  		<?php echo form_open('/settings/editemail') ?>
					<h2>Account email: <span class="pull-right"><button name="submit1" value="submit1" role="submit1" class="btn btn-primary">Save</button></span></h2>
					<ul class="list-unstyled">
						<li><strong>Old email:</strong>
						 <?= form_input(array('name' => 'oldemail','id' => 'oldemail', 'maxlength' => '', 'minlength' => '8'), '', array('class'=>'form-control', 'placeholder'=>'Old email', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>New email:</strong>
						 <?= form_input(array('name' => 'newemail','id' => 'newemail', 'maxlength' => '', 'minlength' => '8'), '', array('class'=>'form-control', 'placeholder'=>'New email', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
					</ul>
					</form>
									<?php if($this->session->flashdata('error4')){
		  			?>	
		  			<div class="alert alert-danger alert-dismissible fade in">
		  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  							<b>Danger!</b> <?php echo $this->session->flashdata('error4'); ?>
					</div>

					<?php
		  			}	
		  			$this->session->unmark_flash('error4');
		  		?>
			  		<?php echo form_open('/settings/edithardware') ?>
			  		<hr>
					<h2>Hardware: <span class="pull-right"><button name="submit1" value="submit1" role="submit1" class="btn btn-primary">Save</button></span></h2>
					<ul class="list-unstyled">
						<li><strong>CPU: </strong>
						 <?= form_input(array('name' => 'cpu','id' => 'cpu', 'maxlength' => '', 'minlength' => '','value' => $cpu), '', array('class'=>'form-control', 'placeholder'=>'CPU', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>GPU: </strong>
						 <?= form_input(array('name' => 'gpu','id' => 'gpu', 'maxlength' => '', 'minlength' => '','value' => $gpu), '', array('class'=>'form-control', 'placeholder'=>'GPU', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>RAM: </strong>
						 <?= form_input(array('name' => 'ram','id' => 'ram', 'maxlength' => '', 'minlength' => '','value' => $ram), '', array('class'=>'form-control', 'placeholder'=>'RAM', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Disc: </strong>
						 <?= form_input(array('name' => 'disc','id' => 'disc', 'maxlength' => '', 'minlength' => '','value' => $disc), '', array('class'=>'form-control', 'placeholder'=>'Storage', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Mother board: </strong>
						 <?= form_input(array('name' => 'motherboard','id' => 'motherboard', 'maxlength' => '', 'minlength' => '','value' =>$motherboard ), '', array('class'=>'form-control', 'placeholder'=>'Motherboard', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Case: </strong>
						 <?= form_input(array('name' => 'case','id' => 'case', 'maxlength' => '', 'minlength' => '','value' => $casing ), '', array('class'=>'form-control', 'placeholder'=>'Case', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Headset: </strong>
						 <?= form_input(array('name' => 'headset','id' => 'headset', 'maxlength' => '', 'minlength' => '','value' => $headset), '', array('class'=>'form-control', 'placeholder'=>'Headset', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Mouse: </strong>
						 <?= form_input(array('name' => 'mouse','id' => 'mouse', 'maxlength' => '', 'minlength' => '','value' => $mouse), '', array('class'=>'form-control', 'placeholder'=>'Mouse', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Mouse pad: </strong>
						 <?= form_input(array('name' => 'pad','id' => 'pad', 'maxlength' => '', 'minlength' => '','value' => $pad), '', array('class'=>'form-control', 'placeholder'=>'Mouse pad', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Keyboard: </strong>
						 <?= form_input(array('name' => 'keyboard','id' => 'keyboard', 'maxlength' => '', 'minlength' => '','value' => $keyboard ), '', array('class'=>'form-control', 'placeholder'=>'Keyboard', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
						<li><strong>Monitor: </strong>
						 <?= form_input(array('name' => 'monitor','id' => 'monitor', 'maxlength' => '', 'minlength' => '','value' => $monitor ), '', array('class'=>'form-control', 'placeholder'=>'Monitor', 'data-validation'=>'required alphanumeric')); ?>	
						</li>
					</ul>
					</form>
			</div>
    	</div>
    </div>
</div>