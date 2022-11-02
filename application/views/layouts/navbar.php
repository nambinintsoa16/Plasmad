<div class="wrapper overlay-sidebar">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="dark">
				
				<a href="index.html" class="logo">
					<!--<img src="<?php //base_url("assets/img/icon.png")?>" alt="navbar brand" class="navbar-brand" width="68px">-->
				
				</a><span class="text-white"><b>PLASMAD</b></span>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle sidenav-overlay-toggler">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
				
				<div class="container-fluid">

				<div class="text-white logo">
						      	<h5><b><?=naveTitle($this->session->userdata('fonction'))?></b></h5>
							</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="<?=user($this->session->userdata('matricule'))?>" alt="<?=$this->session->userdata('matricule')?>" class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									  <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="<?=user($this->session->userdata('matricule'))?>" alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4><?=ucfirst($this->session->userdata("nom"))?></h4>
									<p class="text-muted"><?=ucfirst($this->session->userdata("prenom"))?></p>
									<a href="#" class="btn btn-xs btn-primary btn-sm modifImage">Modifier image</a>
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