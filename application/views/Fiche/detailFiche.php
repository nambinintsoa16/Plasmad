<div class="card full-height">
    <div class="card-header">
        <div class="card-title"><b>FICHE DE DEMANDE</b></div>
    </div>
    <div class="card-body">
	<div class="container">
	    <div class="row">
		  
		       <div class="form-group col-md-2">
                  <label for="DemandeN">Demande N°</label>
                  <input type="text" class="form-control form-control-sm text-center" required disabled id="DemandeN" required placeholder="" value="<?=$data->D_ID?>">
               </div>
               <div class="form-group col-md-2">
                  <label for="ficheN">Fiche N°</label>
                  <input type="text" class="form-control form-control-sm" name="ficheN" id="ficheN" disabled value="<?=$data->F_ID?>">
               </div>
			     <div class="form-group col-md-5">
                  <label for="Demandeur">Demandeur</label>
                  <input type="text" class="form-control form-control-sm" disabled required name="Demandeur" id="Demandeur" required placeholder="" value="<?=$data->D_DEMANDEUR?>">
               </div>
               <div class="form-group col-md-3">
                  <label for="Date_demande">Date demande</label>
                  <input type="text" class="form-control form-control-sm" disabled name="Date_demande" id="Date_demande" required value="<?=$data->D_DATE?>">
               </div>
			    <div class="form-group col-md-3">
                  <label for="nom">Date souhaitée</label>
                  <input type="text" class="form-control form-control-sm dateSouitee" disabled value="<?=$data->D_DATESOUHAITE?>">
               </div>
			   
			    <div class="form-group col-md-3">
                  <label for="nom">Nature</label>
                  <input type="text" class="form-control form-control-sm dateSouitee" disabled value="<?=$data->D_NATURE?>">
               </div>
			   
			    <div class="form-group col-md-3">
                  <label for="nom">Application</label>
				  <input type="text" value="<?=$data->D_APPLICATION?>" class="form-control form-control-sm" disabled >
               </div>
               
		</div>
	</div>	
<hr/>	
    <fieldset>
	   <div class="container">	
		 <div class="row">
		    <div class="col-md-9" style="height: 100px;">
			<label><b>Objet de la demande</b></label>
				<textarea class="form-control border border-primary mh-100 textObjet text-left" disabled>
				<?=$data->D_OBJECT?>
				</textarea>
			</div>
			<div class="col-md-3">
			<label><b>Fichers attachés</b></label>
				<textarea class="form-control border border-primary textAttache" disabled>
				<?=$data->D_TEXT?>
				</textarea>
			<label><b>Motifs sans suite</b></label>	
				<textarea class="form-control border border-primary MotifSAnsuite" disabled>
				<?=$data->D_TEXT?>
				</textarea>
			</div>
		 </div>
	    </div>  
    </fieldset>
  <hr/>
   <div class="container">
      <div class="row">
	     <div class="form-group col-md-6">
		  <label><u>Previsionnel</u></label>
		     <div class="row">
		          <div class="form-group col-md-12">
                    <label for="dev">Développeur</label>
                    <input type="text" class="form-control form-control-sm col-md-6 devMatrr" id="dev">
                  </div>
				   <div class="form-group col-md-6">
                    <label for="nom">Début</label>
                    <input type="date" class="form-control form-control-sm DEVDebut" required name="EL_NOM" id="nom" required placeholder="Nom">
                  </div>
				   <div class="form-group col-md-6">
                    <label for="nom">Fin</label>
                    <input type="date" class="form-control form-control-sm DEVFin" required name="EL_NOM" id="nom" required placeholder="Nom">
                  </div>
			 </div>  
			 <hr/>
			  <label><u>Réalisation</u></label>
			<div class="row">
			      <div class="form-group col-md-2">
						
                  </div>
		          <div class="form-group col-md-4 p-0 m-1">
						<a href="#" class="btn btn-primary btn-sm w-100 creerFiche">Céer Fiche</a>
                  </div>
				   <div class="form-group col-md-4 p-0 m-1"> 
						<a href="#" class="btn btn-success btn-sm w-100 Terminer">Terminer</a>
                  </div>
				  <div class="form-group col-md-2">
						
                  </div>
			 </div>  
			 <hr/>
			 <div class="row">
			      <div class="form-group col-md-12">
						<label>Développeur</label>
						 <input type="text" class="form-control form-control-sm col-md-6" required name="EL_NOM" id="nom" required placeholder="Nom">
                  </div>
		          <div class="form-group col-md-4 p-0 m-1">
				    <label>Début</label>	
					<input type="date" class="form-control form-control-sm" required name="EL_NOM" id="nom" required placeholder="Nom">
					<label>Fin</label>	
					<input type="date" class="form-control form-control-sm" required name="EL_NOM" id="nom" required placeholder="Nom">
                  </div>
				   <div class="form-group col-md-4 p-0 m-1">
					<label>Fin développement</label>				   
					<input type="date" class="form-control form-control-sm" required name="EL_NOM" id="nom" required placeholder="Nom">
                  </div>
				  <div class="form-group col-md-2">
						
                  </div>
			 </div>   
		    </div> 
		 <div class="form-group col-md-6">
		 <label><u>Signature</u></label>
             <div class="row p-0">
			      <div class="form-group col-md-3">
						
                  </div>
		          <div class="form-group col-md-3">
						<a href="#" class="btn btn-success btn-sm w-100 Responsable">Responsable</a>
                  </div>
				   <div class="form-group col-md-3">
						<a href="#" class="btn btn-success btn-sm w-100 Direction">Direction</a>
                  </div>
				   <div class="form-group col-md-3"> 
						<a href="#" class="btn btn-danger btn-sm w-100 Sans_suite">Sans suite</a>
                  </div>
				  
			 </div>  
			 
		 <div class="container">	 
			 <div class="row">
			 <div class="form-group col-md-3">
						<label>Signataire</label>
                  </div>
		          <div class="form-group col-md-3">
						<input type="text" class="form-control form-control-sm w-100" required name="EL_NOM" id="nom" required>
                  </div>
				   <div class="form-group col-md-3">
						<input type="text" class="form-control form-control-sm w-100" required name="EL_NOM" id="nom" required>
                  </div>
				   <div class="form-group col-md-3"> 
						<input type="text" class="form-control form-control-sm w-100" required name="EL_NOM" id="nom" required>
                  </div>
			 </div>  
		  </div>
		  
		  
		   <hr/>
			 
			 <div class="row">
			      <div class="form-group col-md-8"> 
					<label>Motif remise en Instance</label>
                  </div>
			    
				   <div class="form-group col-md-4"> 
						<a href="#" class="btn btn-warning btn-sm w-100 Remetre_en_instance">Remetre en instance</a>
                  </div>
				   <div class="form-group col-md-12"> 
						<textarea class="form-control border border-primary w-100"></textarea>
                  </div>
				  
			 </div> 
			 
        </div>	
       </div>		
	  </div> 
   </div>
  </div>   
 </div>
</div>