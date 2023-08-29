<?php
$matricule_incorect = ($this->session->flashdata("erreur_matricule") === NULL ? "" : $this->session->flashdata("erreur_matricule"));
$password_incorect = ($this->session->flashdata("erreur_password") === NULL ? "" : $this->session->flashdata("erreur_password"));
$class_erreur_matricule = (!empty($matricule_incorect) ? "erreur" : "");
$class_erreur_password = (!empty($password_incorect) ? "erreur" : "");
?>
<div class="form-box card" id="login-box">
    <form action="<?= base_url("authentification/check_utilisateur") ?>" method="post">
        <div class="body bg-gray">

            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="motDePasse">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="text" name="matricule"  class="matricule form-control " value="" name="matricule" placeholder="Matricule" required autofocus />
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="motDePasse">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
                <input type="password" class="form-control  password" name="password" placeholder="Mot de passe" aria-describedby="motDePasse" required />
                <div class="input-group-prepend">
                    <span class="input-group-text" id="motDePasse">
                        <a href="#" class="control-input-pass"><i class="fa fa-eye-slash"></i></a>
                    </span>
                </div>
         </div>
         <div class="alert alert-danger m-auto <?= (!empty($matricule_incorect) | !empty($password_incorect) ?"": "collapse"  ) ?>" role="alert">
                    <?= $matricule_incorect ?>
                    <?= $password_incorect ?>
            </div>
            <button type="submit" class="btn bg-primary btn-block text-white login mt-1"><b>Se connecter</b></button>
        </div>
    </form>
</div>