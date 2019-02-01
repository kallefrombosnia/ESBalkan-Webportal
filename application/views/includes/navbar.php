<header class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand visible-xs">ESBalkan</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li><a href="<?php echo site_url(); ?>/team.html">Admin team</a></li>
                <li><a href="<?php echo site_url(); ?>/view/profile/<?php echo $this->session->id; ?>">Profile</a></li>
                <li><a href="<?php echo site_url(); ?>/gallery.html">Gallery</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gaming</a>
                    <ul class="dropdown-menu">
                        <li><a href="gaming-team.html"><i class="fa fa-plus"></i>Gaming team</a></li>
                        <li><a href="matches-list.html"><i class="fa fa-plus"></i>List of matches</a></li>
                        <li><a href="match-single.html"><i class="fa fa-plus"></i>Single match</a></li>
                        <li><a href="tournament.html"><i class="fa fa-plus"></i>Tournament</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Forum</a>
                    <ul class="dropdown-menu">
                        <li><a href="forum.html"><i class="fa fa-plus"></i>Forum Page</a></li>
                        <li><a href="forum-list.html"><i class="fa fa-plus"></i>Forum threads</a></li>
                        <li><a href="forum-single.html"><i class="fa fa-plus"></i>Single forum post</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <ul class="dropdown-menu">
                        <li><a href="reg"><i class="fa fa-plus"></i>Sign up</a></li>
                        <li><a href="signin.html"><i class="fa fa-plus"></i>Sign in</a></li>
                        <li><a href="servers.html"><i class="fa fa-plus"></i>Servers</a></li>
                        <li><a href="404.html"><i class="fa fa-plus"></i>Error Page</a></li>
                    </ul>
                </li>
            </ul>
            <?php
                if($this->Functions->isLoged()){
                    $data = $this->Functions->getProfile($this->session->id);
                    $this->load->view('includes/html/nav-profile',array('avatar' => $data['0']['avatar']));
                }else{                   
                   $this->load->view('includes/html/loginregister');  
                }
            ?>
        </div>
    </div>
</header>
<!-- LOGO CONTAINTER START  -->
<div class="container">
    <div class="rows">
