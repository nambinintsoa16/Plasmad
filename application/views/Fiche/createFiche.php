

<div class="card full-height">
    <div class="card-header">
        <div class="card-title"><b>FICHE DE DEMANDE</b></div>
    </div>
    <div class="card-body">
	<div class="container">
	    <div class="row">
		  
		       <div class="form-group col-md-2">
                  <label for="DemandeN">Demande N°</label>
                  <input type="text" class="form-control form-control-sm text-center" required disabled id="DemandeN" required placeholder="" value="<?php if(isset($data->D_ID)){ echo $data->D_ID + 1;}else{echo 0;}?>">
               </div>
               <div class="form-group col-md-2">
                  <label for="ficheN">Fiche N°</label>
                  <input type="text" class="form-control form-control-sm" name="ficheN" id="ficheN" disabled required placeholder="">
               </div>
			     <div class="form-group col-md-5">
                  <label for="Demandeur">Demandeur</label>
                  <input type="text" class="form-control form-control-sm" disabled name="Demandeur" id="Demandeur" required placeholder="" value="<?=$this->session->userdata("nom")." ".$this->session->userdata("prenom") ?>">
               </div>
               <div class="form-group col-md-3">
                  <label for="Date_demande">Date demande</label>
                  <input type="text" class="form-control form-control-sm" disabled name="Date_demande" id="Date_demande" required value="<?=date("d-m-Y")?>">
               </div>
			    <div class="form-group col-md-3">
                  <label for="dateSouitee">Date souhaitée</label>
                  <input type="date" class="form-control form-control-sm dateSouitee"  id="dateSouitee">
               </div>
			   
			    <div class="form-group col-md-3">
                  <label for="nom">Nature</label>
                 <select class="form-control form-control-sm nature">
				     <option>Modification application nineur</option>
					 <option>Modification application majeur</option>
					 <option>Requette</option>
				  </select>
               </div>
			   
			    <div class="form-group col-md-3">
                  <label for="nom">Application</label>
				  <select class="form-control form-control-sm application">
				     <option>Magesty</option>
					 <option>Komone</option>
					 <option>Combo</option>
				  </select>
               </div>
               
		</div>
	</div>	
<hr/>	
    <fieldset>
	   <div class="container">	
		 <div class="row">
		    <div class="col-md-12" style="height: 100px;">
			<label><b>Objet de la demande</b></label>
				<textarea class="form-control border border-primary mh-100 textObjet"></textarea>
				
			</div>
			  <div class="col-md-12 mt-3" style="height: 100px;">
			<a href="#" class="btn btn-primary m-3 pull-right saveFiche">Enregistre</a>
			<!--<div class="col-md-3">
			<label><b>Fichers attachés</b></label>
				<textarea class="form-control border border-primary textAttache"></textarea>
			-->	
			</div>
			</div>
		 </div>
	    </div>  
    </fieldset>
  <hr/>
   
  
 </div>
</div>