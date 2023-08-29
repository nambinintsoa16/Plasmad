<fieldset class="border p-4 bg-white">
    <form method="POST" action="">
           <div class="form-group col-md-12">
                <label>Matricule</label>
                <input type="text" class="form-control form-control-sm input" id="OP_MATRICULES" >
            </div>

            <div class="form-group col-md-12">
                <label>Nom et Prénom</label>
                <input type="text" class="form-control form-control-sm input" id="OP_NOM" >
            </div>
            <div class="form-group col-md-12">
                <label>Fonction</label>
                <select class="form-control" id="OP_FONCTION">
                        <option>Chef d'equpe</option>
                        <option>Operateur</option>
                </select> 
            </div>
             <div class="form-group col-md-12">
                <label>MACHINE</label>
                <select class="form-control" id="OP_MACHINE">
                    <option>EXTRUSION 1</option>
                    <option>EXTRUSION 2</option>
                    <option>EXTRUSION 3</option>
                    <option>COUPE</option>
                    <option>COUPE MANUEL</option>
                    <option>IMPRESSION A</option>
                    <option>IMPRESSION B</option>
                    <option>IMPRESSION C</option>
                    <option>INJECTION</option>
                </select> 
            </div>
            
       <div class="form-group col-md-12 text-right"> 
              <a href="#" class="btn btn-success" id="save_operateur"><i class="fa fa-save"></i>&nbsp;Enregistrer</a>
              <a href="#" class="btn btn-danger" id="annuler"><i class="fa fa-trash"></i>&nbsp;Annuler</a>
        </div>
        </div>  
      </form>  
</fieldset>    