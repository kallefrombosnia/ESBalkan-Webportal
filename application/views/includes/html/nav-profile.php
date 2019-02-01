<div class="pull-right nav-profile">
	<li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">   
	        <?php                  	
                echo($this->session->userinfo['0']['nickname']);
			?>
	      
	     	 <img src="<?php echo base_url() ?>/users/pictures/<?php $this->Functions->getAvatar($avatar);  ?>" class="img-circle profile-img"></img><span class="caret"></span>
	        
	    </a>
	    <ul class="dropdown-menu nav-dropdown">
	    	<li>
	            </i><a href="<?php echo site_url('/view/profile/'); echo($this->session->id); ?>"><i class="fas fa-info"></i> View profile</a>
	        </li>
	        <li>
	            </i><a href="<?php echo site_url('/settings/profile/'.$this->session->id); ?>"><i class="fas fa-cog"></i> Settings</a>
	        </li>
	        <li>
	            <a href="<?php echo site_url('/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Log out</a>
	        </li>
	    </ul>
	</li>	
</div>
