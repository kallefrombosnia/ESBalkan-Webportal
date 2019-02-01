<div class="col-md-8">
	<div class="panel panel-default panel-box">
		<div class="panel-body">
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="#">Home</a></li>
			  <li role="presentation" class="pull-right"><a href="<?php echo site_url();?>/settings/clan/<?= $id; ?>">Settings</a></li>
			  <?php
			  	$show = 'true';
			  	foreach ($players as $player) {
			  		if($player['id']==$this->session->id){
			  			$show = '';
			  		}
			  	}
			  	if($show=='true'){
			  ?>
			  	<li role="presentation"><a href="#">Join team</a></li>
			  <?php
			  	}
			  ?>
			</ul>
		</div>
    	<div class="panel-body">
    		<div class="img-panel">

			    <img class="coverimg" src="<?php echo base_url();?>users/clan/covers/<?php 
    				$this->Functions->getAvatar($cover);
    			?>">
			    <img class="img-responsive img-circle center-block profileimg" src="<?php echo base_url();?>users/clan/<?php 
    				$this->Functions->getAvatar($avatar);
    			?>">
    		</div>
    		<div class="row">
    			<div class="col-md-6">
		    		<ul style="padding-top: 50px" class="list-unstyled">
						<li><strong>Clan name: </strong><b><?= $name ?></b></li>
						<li><strong>Clan since: </strong><?= $created_at ?></li>
						<li><strong>Country:</strong>
			    			<img src="<?php echo base_url();?>/includes/countrys/<?php 
				    						$this->Functions->getCountry($country);  
				    					?>"></img></li>
						
					</ul>
				</div>
				<div class="col-md-6">
					<ul style="padding-top: 50px" class="list-unstyled">
						<li><strong>Wins: </strong><?= $wins ?></li>
						<li><strong>Activity: </strong><?= $activity ?></li>
					</ul>
				</div>
				<div class="col-md-12">
					<strong>Description: </strong><p><?= $description; ?></p>
				</div>
			</div>
				<strong style="padding-top: 20px">Members: </strong>
				<ul class="list-unstyled list">
				<?php
				foreach($players as $player){
						if($player['id']==$leader){
						?>
							<li><a href="<?php echo site_url();?>/view/profile/<?php echo($player['id']); ?>"><p><img src="<?php echo base_url();?>/includes/countrys/<?php 
				    						$this->Functions->getCountry($player['country']);  
				    					?>"></img>
				    					<?php echo(ucfirst($player['fname']."<b>'".$player['nickname']."'</b>".ucfirst($player['lname']."<i>CLAN LEADER</i></p>"))); ?></a>  </li>
						<?php
						}
					}

					foreach($players as $player){

						if($player['id']==$gameleader){
						?>
							<li><a href="<?php echo site_url();?>/view/profile/<?php echo($player['id']); ?>"><p><img src="<?php echo base_url();?>/includes/countrys/<?php 
				    						$this->Functions->getCountry($player['country']);  
				    					?>"></img><?php echo(ucfirst(" ".$player['fname']."<b>'".$player['nickname']."'</b>".ucfirst($player['lname']."<i>IG LEADER</i></p>"))); ?></a></li>
						<?php
						}
					}

					foreach($players as $player){
						if($player['id']==$leader||$player['id']==$gameleader){
							continue;
						}
						?>
							<li><a href="<?php echo site_url();?>/view/profile/<?php echo($player['id']); ?>"><p><img src="<?php echo base_url();?>/includes/countrys/<?php 
				    						$this->Functions->getCountry($player['country']);  
				    					?>"></img>
				    					<?php echo(ucfirst($player['fname']."<b>'".$player['nickname']."'</b>".ucfirst($player['lname']."</p>"))); ?>  </a></li>
						<?php
					}		
				?>
				</ul>
				<strong style="padding-top: 20px">Avchiements: </strong>

				<ul class="list-group">
				    <li class="list-group-item">Bulgaria Tournament</li>
				</ul>
			</div>
    	</div>
    </div>
</div>