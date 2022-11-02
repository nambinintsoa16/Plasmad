<div class="wrapper">
    <div class="main-header">
        <div class="logo-header bg-dark">
            <a href="/" class="logo text-white">
               PLASMAD
              <!-- <img src="<?php //base_url("assets/img/logo.svg")?>" alt="navbar brand" class="navbar-brand">-->
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
<nav class="navbar navbar-header navbar-expand-lg bg-dark">
				
    <div class="container-fluid">
   
				
							<div class="text-white logo">
						      	<h5><b><?=naveTitle($this->session->userdata('fonction'))?></b></h5>
							</div>
					
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="<?=base_url("assets/img/profile")?>.jpg" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="<?=base_url("assets/img/profile")?>.jpg" alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4><?=ucfirst($this->session->userdata("nom"))?></h4>
                                    <p class="text-muted"><?=ucfirst($this->session->userdata("prenom"))?></p><a href="#" class="btn btn-xs btn-success btn-sm">View Profile</a>
                                </div>
                            </div>
                        </li>
                        <li class="text-center">
                        
                            <div class="dropdown-divider "></div>
                            <a class="dropdown-item btn btn-primary text-white" href="<?=base_url('Authentification/deconnexion')?>">Se déconnecter</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
</div>