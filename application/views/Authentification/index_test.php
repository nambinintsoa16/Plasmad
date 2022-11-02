<?php

 $matricule_incorect = ( $this->session->flashdata("erreur_matricule") === NULL?"":$this->session->flashdata("erreur_matricule"));
 $this->session->flashdata("erreur_matricule");
 $password_incorect = ( $this->session->flashdata("erreur_password") === NULL?"":$this->session->flashdata("erreur_password"));
 $this->session->flashdata("erreur_password");

 $class_erreur_matricule = (!empty($matricule_incorect)?"erreur":"");
 $class_erreur_password = (!empty($password_incorect)?"erreur":"");

?>

<div class="row col-12 login_content">
  <div class="row card col-sm-4 col-lg-12 col-xl-12" id="ch_form_authentification">
    <div class="card-header">
      <div class="d-flex justify-content-center">
        <div id="user_ico" class="d-flex justify-content-center align-items-center">
          <span>K1</span>
        </div>
      </div>
    </div>
    <div class="card-body">

      <form class="form-signin" method="post" action="<?= base_url("authentification")?>">
        <div class="input-group input-login <?= $class_erreur_matricule ?>">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">
              <i class="fa fa-user"></i>
            </span>
          </div>
          <input type="text" class="form-control <?= $class_erreur_matricule ?>" value="<?= ( empty($matricule_incorect) ?set_value("matricule"):"") ?>" name="matricule" placeholder="<?= ( empty($matricule_incorect) ?"Matricule":$matricule_incorect) ?>" required autofocus >
        </div>

        <div class="input-group input-password <?= $class_erreur_password ?>">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <input type="password" class="form-control <?= $class_erreur_password ?>" name="password" placeholder=" <?= ( empty($password_incorect) ?"Mot de passe":$password_incorect) ?>" required>
        </div>

        <button class="btn btn-login btn-primary" name="login" type="submit"><b>Connexion</b></button>

        <div class="col-12 d-flex racourci justify-content-between pt-3">
          <a class="text-white" href="<?= base_url("commercial")  ?>">commercial</a>
          <a class="text-white" href="<?= base_url("coach")  ?>">coach</a>
          <a class="text-white" href="<?= base_url("controlleur")  ?>">controlleur</a>
        </div>

      </form>
    </div>
  </div>
</div>