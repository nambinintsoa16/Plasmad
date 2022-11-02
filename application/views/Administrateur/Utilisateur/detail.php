<div class="container">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <div class="row">
        
                    <input type="password" class="form-control form-control-sm collapse id" value="<?=$data->UT_ID?>">
                <div class="form-group col-md-12">
                    <label class="label">Nouveau mot de pass : </label>
                    <input type="password" class="form-control form-control-sm pass">
                </div>

                <div class="form-group col-md-12">
                    <label class="label">Type : </label>
                    <select class="form-control type">
                         <option value="1">Administrateur</option>
                         <option value="3">Commercial</option>
                         <option value="3">Comptable</option>
                   </select>
                   
                </div>
                <div class="form-group col-md-12 "> 
                     <button type="submit" class="btn btn-success modifierUtilisateur">Enregistre</button>
                     <button type="reset" class="btn btn-danger">Annule</button>
               </div>
               
      
            </div>
        </div>
    </div>
</div>