<div class="wrapper">
    <div class="main-header">
        <div class="logo-header" data-background-color="<?=$base_color?>" style="background-color:<?=$base_color;?>!important">
            <a href="<?=base_url()?>" class="logo text-white">
            <!--<img src="base_url("assets/images/icon.png")" style="width: 30px;" alt="" class="navbar-brand image-logo">-->
            <span class="mt-1 ml-3"> <b>GEST-PROD</b> </span>  </a>
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
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="<?=$base_color?>" style="background-color:<?=$base_color;?>!important">
				
    <div class="container-fluid">

				<div class="text-white logo">
						<h5><b><?=service(strtoupper($this->session->userdata('designation')))?> | Matricule : <?= $this->session->userdata('matricule')?></b></h5>
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
                        <img src="<?=user_img_link($this->session->userdata('matricule'))?>" alt="<?=$this->session->userdata('matricule')?>" class="avatar-img rounded-circle img-thumbnail">
                    </div>
                </a>
                <span class="collapse matricule"><?php echo $this->session->userdata('matricule')?></span>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="<?=user_img_link($this->session->userdata('matricule'))?>" alt="Photo de profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4><?=ucfirst($this->session->userdata("nom"))?></h4>
                                    <p class="text-muted"><?=ucfirst($this->session->userdata("prenom"))?></p><a href="#"  id= "edit_image_user" class="btn btn-xs btn-<?=$nav_color?> btn-sm">Modifier photo user</a>
                                </div>
                            </div>
                        </li>
                        <li class="text-center">
                        <div class="dropdown-divider "></div>
                        <a class="dropdown-item btn btn-<?=$nav_color?> text-white" href="#" id="change_pass">
                            <i class="icon-lock"></i>&nbsp;
                           Changer mot de passe</a>
                        </li>
                        <li class="text-center">
                            <div class="dropdown-divider "></div>
                            <a class="dropdown-item btn btn-<?=$nav_color?> text-white" href="<?=base_url('Authentification/deconnexion')?>">
                            <i class="icon-logout"></i>&nbsp;
                            Se déconnecter</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
</div>

