<div class="form">
		<form method="post" action="<?=base_url('Commerciale/sauveCommande')?>">	
<fieldset class="col-md-12 border bg-white">
    <div class="row">
		<div class="form-group col-md-4">
			<label for="date">Date : </label>
			<input type="text" name="BC_DATE" class="form-control form-control-sm BC_DATE" value="<?=date('d-m-Y')?>">
		</div>
		<div class="form-group col-md-4">
			<label for="BC_PE">TYPE PO  : </label>
			 <select  class="form-control form-control-sm BC_TYPEPO" name="BC_TYPEPO">
				<option>EPZ</option>
				<option>CMTI</option>
			</select> 
	    </div>
		<div class="form-group col-md-4">
			<label for="BC_PE" class="titlePO">PE N° : </label>
			<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
	    </div>
		<div class="form-group col-md-4">
			<label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
			 <select  class="form-control form-control-sm BC_TYPEPRODUIT" name="BC_TYPEPRODUIT">
				<option>CINTRES</option>
				<option>PUCE DE TAILLES</option>
			</select> 
		</div>
		<div class="form-group col-md-3">
			<label for="BC_CLIENT">CLIENT, Référence : </label>
			<input type="text" name="BC_CLIENT" class="form-control form-control-sm BC_CLIENT ">
		</div>
		<div class="form-group col-md-3">
			<label for="BC_CODE">CODE : </label>
			<input type="text" name="BC_CODE" class="form-control form-control-sm BC_CODE">
		</div>
		<div class="form-group col-md-3">
			<label for="BC_DATELIVRE">DATE DE  LIVRAISON : </label>
			<input type="text" name="BC_DATELIVRE" class="form-control form-control-sm BC_DATELIVRE" value=<?=date('d-m-Y')?>>
		</div>
		<div class="form-group col-md-3">
			<label for="BC_LIEU">LIEU DE LIVRAISON : </label>
			<input type="text" name="BC_LIEU" class="form-control form-control-sm BC_LIEU">
		</div>
	</div>			
</fieldset>	
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
        <div class="form-group col-md-4">
				 <label for="BC_PRIX">MODEL : </label>
				 <input type="text" name="BC_MODEL" class="form-control form-control-sm BC_MODEL">
			</div>
			<div class="form-group col-md-4">
				 <label for="BC_CON_PRIX">COULEUR: </label>
				 <input type="text" name="BC_CON_PRIX" class="form-control form-control-sm BC_COULEUR">
			</div>
		   
			<div class="form-group col-md-4">
				 <label for="BC_QUNTITE">Quantité : </label>
				 <input type="text" name="BC_QUNTITE"  class="form-control form-control-sm BC_QUNTITE">
			</div>
			<div class="form-group col-md-4">
				 <label for="BC_QUNTITE">PRIX : </label>
				 <input type="text" name="BC_QUNTITE"  class="form-control form-control-sm BC_CON_PRIX">
			</div>
			
			</div>
	    </div>	 
</fieldset>	 
<fieldset class="col-md-12 border mt-2">
    	<div class="row">  
			<div class="form-group col-md-12">
				<label for="BC_OBSERVATION">Observation : </label>
				<textarea class="form-control obse BC_OBSERVATION" id="BC_OBSERVATION"></textarea>
			</div>	
		</div>
</fieldset>	
		</form>
        </div>
   <div class="card-footer text-right"> 
        <!-- <a href="<?=base_url('Commerciale/printFacture')?>" class="btn btn-info print"><i class="fa fa-print"></i> Imprimer</a>-->
        <button type="submit" class="btn btn-success saveCintre">Enregistre</button>
        <button type="reset" class="btn btn-danger">Annuler</button>
   </div>
  </div>  
</div>  
