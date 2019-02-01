<div class="col-md-8">
	<div class="panel panel-default panel-box">
		<div class="panel-body">
			<ul class="nav nav-tabs">
			  <li role="presentation"><a href="<?php echo site_url();?>/view/clan/<?= $id; ?>">Home</a></li>
			  <li role="presentation" class="active pull-right"><a href="<?php echo site_url();?>/settings/clan/<?= $id; ?>">Settings</a></li>
			</ul>
		</div>
    	<div class="panel-body">
			<h3>Clan settings:</h3>
			<hr>
			<div class="settings">
				<?php echo form_open('/settings/editclanpref/'.$id) ?>	
				<h2>User preferences:<span class="pull-right"><button value="submit" role="submit" class="btn btn-primary">Save</button></span></h2>
							<ul class="list-unstyled">
								<li><strong>Is clan active?</strong>
								<?php 
								if($activity=='Active'){
								?>
								<input name="activity" type="checkbox" checked data-toggle="toggle" data-onstyle="success"  data-offstyle="danger" data-size="small">
								<?php
								}else{ 
								?>
								<input name="new_comments" type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="small">
								<?php
								}
								?>
								</li>
							</ul>
					</form>
				<hr>
				<h2>Clan info:<span class="pull-right"><button name="submit1" value="submit1" role="submit1" class="btn btn-primary">Save</button></span></h2>
				<ul class="list-unstyled">
					<li><strong>Description:</strong>
					 <?= form_textarea(array('name' => 'description','id' => 'description', 'maxlength' => '255', 'minlength' => '', 'type' => '', 'style' => 'height: 100px !important;resize: vertical;', 'value' =>$description), '', array('class'=>'form-control', 'placeholder'=>'Description', 'data-validation'=>'required alphanumeric')); ?>	
				</ul>
				</form>
				<hr>
			</div>
		</div>
	</div>
</div>