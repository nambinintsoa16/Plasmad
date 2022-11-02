
<?php
$matricule_incorect = ( $this->session->flashdata("erreur_matricule") === NULL?"":$this->session->flashdata("erreur_matricule"));
$password_incorect = ( $this->session->flashdata("erreur_password") === NULL?"":$this->session->flashdata("erreur_password"));
$class_erreur_matricule = (!empty($matricule_incorect)?"erreur":"");
$class_erreur_password = (!empty($password_incorect)?"erreur":"");
?>
    <div class="form-box card" id="login-box">
        <form action="<?=base_url("authentification")?>" method="post">
		  <div class="body bg-gray">
			        <div class="form-group"> 
                        <input type="text" name="userid" class="form-control <?= $class_erreur_matricule ?>" value="<?= ( empty($matricule_incorect) ?set_value("User ID"):"") ?>" name="User_ID" placeholder="<?= ( empty($matricule_incorect) ? "Matricule":$matricule_incorect) ?>" required autofocus/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control <?= $class_erreur_password ?>" name="password" placeholder="<?=( empty($password_incorect) ? "Password":$password_incorect) ?>" required/>
                    </div>                                                                      
                    <button type="submit" class="btn bg-dark btn-block text-white">Connexion</button>  
                </div>
            </form>
        </div>
