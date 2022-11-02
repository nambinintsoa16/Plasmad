<div class="container p-2">
<div class="card">
    <div class="card-header text-white bg-primary">
       <b> NOUVEAU UTLISATEUR</b>
    </div>
    <div class="card-body">
      <form method="post" action="">  
        <div class="row">
             <div class="form-group col-md-12">
                <label>Matricule :</label>
                <input type="text" class="form-control form-control-sm UT_CODE" >
            </div>
            <div class="form-group col-md-12">
                <label>Nom :</label>
                <input type="text" class="form-control form-control-sm UT_NOM" >
            </div>
            <div class="form-group col-md-12">
                <label>Prénom :</label>
                <input type="text" class="form-control form-control-sm UT_PRENOM" >
            </div>
            <div class="form-group col-md-12">
                <label>Type :</label>
                <select class="form-control UT_PROFIL">
                        <option value="1">Administrateur</option>
                        <option value="2">Planning</option>
                        <option value="3">Commercial</option>
                        <option value="4">Production</option>
                        <option value="5">Comptable</option>
                        <option value="6">Stock</option>
                        <option value="7">Magasiner</option>
						<option value="8">Suivi</option>
                </select>    
            </div>

            <div class="form-group col-md-12">
                <label>Mot de passe :</label>
                <input type="password" class="form-control form-control-sm UT_MOT_DE_PASS" >
            </div>

            <div class="form-group col-md-12">
                <label>Confirmer mot de passe :</label>
                <input type="password" class="form-control form-control-sm UT_MOT_DE_PASS_C" >
            </div>
      
       <div class="form-group col-md-12 "> 
              <button type="submit" class="btn btn-success saveuser">Enregistre</button>
              <button type="reset" class="btn btn-danger">Annule</button>
        </div>
        </div>  
      </form>    
    </div>
</div>
</div>
