<div class="container p-2">
<div class="card">
    <div class="card-header text-white bg-primary">
       <b> NOUVEAU OPERATEUR</b>
    </div>
    <div class="card-body">
      <form method="post" action="">  
        <div class="row">
           <div class="form-group col-md-12">
                <label>Matricule :</label>
                <input type="text" class="form-control form-control-sm OP_MATRICULES" >
            </div>

            <div class="form-group col-md-12">
                <label>Nom :</label>
                <input type="text" class="form-control form-control-sm OP_NOM" >
            </div>
            <div class="form-group col-md-12">
                <label>Fonction :</label>
                <select class="form-control OP_FONCTION">
                        <option>Chef d'equpe</option>
                        <option>Operateur</option>
                </select> 
            </div>
             <div class="form-group col-md-12">
                <label>MACHINE :</label>
                <select class="form-control OP_MACHINE">
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
            
       <div class="form-group col-md-12 "> 
              <button class="btn btn-success saveuser">Enregistre</button>
              <button type="reset" class="btn btn-danger">Annule</button>
        </div>
        </div>  
      </form>    
    </div>
</div>
</div>
