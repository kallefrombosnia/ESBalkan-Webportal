<div class="col-md-8">
	<div class="panel panel-default panel-box">
    	<div class="panel-body">
    		<div class="col-md-3">
    			<img src="<?php echo base_url();?>users/pictures/<?php 
    				$this->Functions->getAvatar($avatar);
    			?>" class="img-responsive img-circle center-block picture134" alt="Profile picture">
    			</img>
    			<ul class="list-unstyled">
		    		
				</ul>
    		</div>

    		<div class="col-md-9">
    			<span class="profile-info">
		    			<ul class="list-inline">
			  					<li><h2><?= $fname; ?></h2></li>
			  					<li><h3>"<?= $nickname; ?>"</h3></li>
			  					<li><h2><?= $lname; ?></h2></li>
						</ul>
				</span>
					<ul class="list-unstyled">
						<li><strong>Member since: </strong><?= $created_at ?></li>
						<li><strong>Country:</strong>
			    			<img src="<?php echo base_url();?>/includes/countrys/<?php 
				    						$this->Functions->getCountry($country);  
				    					?>"></img></li>
						<li><strong>Team: </strong>aaaaaa</li>
						<li><strong>Title: </strong><?php $this->Functions->getRank($role); ?></li>
					</ul>

					<strong>Description:</strong>
					<p>
						<?=
							$description;
						?>
					</p>
    				   		
    			</span>
    		</div> 		
    	</div>
    </div>
    <div class="panel panel-default panel-box colored-panel">
    	<div class="panel-body config">
    		<?php 
    			if($showconfig=='on')
    			{
    				if($configname=='')
    				{
    				?>
		  				<h2>This user doesnt have personal config.</h2>
		  			<?php
		  			}else{
		  			?>
		  				<h2>Download user config <span class="pull-right"><a href="<?php echo site_url(); ?>/download/config/<?php echo $configname; ?>" class="btn btn-simple">Download</a></span></h2>
		  			<?php
		  			}
    			}
    			else
    			{?>
    				<h2>This user has disabled config download.</h2>
    			<?php
    			}
		  		?>
    	</div>
    </div>
    <div class="panel panel-default panel-box">
    	<div class="panel-body">
	    		<div class="col-md-7">
	    		<h2>Users specifications:</h2>
	    			<ul class="list-unstyled">
	    				<li><strong>CPU:</strong><?= $cpu; ?></li>
	    				<li><strong>GPU:</strong><?= $gpu; ?></li>
	    				<li><strong>RAM:</strong><?= $ram; ?></li>
	    				<li><strong>Disc:</strong><?= $disc; ?></li>
	    				<li><strong>Mother B.:</strong><?= $motherboard; ?></li>
	    				<li><strong>Case:</strong><?= $casing; ?></li>
	    				<li><strong>Headset:</strong><?= $headset; ?></li>
	    				<li><strong>Mouse:</strong><?= $mouse; ?></li>
	    				<li><strong>Mouse pad:</strong><?= $pad; ?></li>
	    				<li><strong>Keyboard:</strong><?= $keyboard; ?></li>
	    				<li><strong>Monitor:</strong><?= $monitor; ?></li>	
	    			</ul>
	    		</div>

	    		<div class="col-md-5">
	    			<?php 
	    				$prop = array(
					        'src'   => 'includes/icons/pc.jpg',
					        'alt'   => 'PC',
					        'class' => 'img-responsive center-block',
					        'style' => 'padding-top:30px'  
						);
	    				echo img($prop);
	    			?>
	    		</div>    		
    	</div>
    </div>
    <div class="panel panel-default panel-box">
    	<div class="panel-body">
    		<h2>Comments:</h2>
    		<!--
    			<div class="comment-list">
    				<ul class="list-unstyled">
    					<li><div class="profile-pic"><img src="http://localhost//users/pictures/30x30/default.jpg" class="img-circle profile-img"></div><div class="comment"><p>Some text</p></div><span class="date">13.03.2014.</span></li>
    				</ul>
    			</div>
    		-->
<?php
if($allcomments==='on'){
if($results==''){
?>
	<h2>Users has no comments yet. Become first one to post something. </h2>
<?php
}else{
	foreach ($results as $result) {
	
	$data = $this->Functions->getProfile($result['commenter_id']);
?>
		<div class="media">
				<div class="media-left">
			    <a href="#">
			      	<img class="media-object picture64" src="<?php echo base_url();?>users/pictures/<?php 
    				$this->Functions->getAvatar($data['0']['avatar']);
    			?>" alt="...">
			    </a>
				</div>
			<div class="media-body">
			    <h4 class="media-heading"><?php echo(ucfirst($data['0']['fname']." ".ucfirst($data['0']['lname']))); ?><span class="pull-right date"><?php echo $result['created_at'];  ?>.</span></h4>
			    <p><?php echo $result['comment']; ?></p>
		  	</div>
		</div>

		
<?php
}
?>
<?= $pagination; ?>
<?php
}
}else{
?>
	<h2>User has hidden all comments.</h2>
<?php
}
?>  	
		<?php
			$this->load->view('actions/profilecomment.php');
		?>
    	</div>
    </div>
</div>

