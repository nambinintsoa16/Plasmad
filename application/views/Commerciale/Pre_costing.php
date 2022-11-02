<nav aria-label="breadcrumb">

	   <ol class="breadcrumb">

		 <li class="breadcrumb-item"><a href="#">Accueil</a></li>

		 <li class="breadcrumb-item"><a href="#">Commerciale</a></li>

		 <li class="breadcrumb-item"><a href="#">Pre costing</a></li>

		

	   </ol>

      </nav>


 <div class="card">
   <div class="card-header bg-dark text-white">
      <b> PRE COSTING</b>
   </div>
   <div class="card-body">
    <div class="form">
		<form method="post" action="<?=base_url('Commerciale/sauveCommande')?>">	
<fieldset class="col-md-12 border">
    <div class="row">
		<div class="form-group col-md-4">
			<label for="date">Date : </label>
			<input type="text" name="BC_DATE" class="form-control form-control-sm BC_DATE" value=<?=date('d-m-Y')?>>
		</div>
		<div class="form-group col-md-4">
			<label for="BC_PE">TYPE PO  : </label>
			 <select  class="form-control form-control-sm BC_TYPEPO" name="BC_TYPEPO">
				<option>EPZ</option>
				<option>CMTI I</option>
		        <option>CMTI MADA</option>
			</select> 
	    </div>
		<div class="form-group col-md-4">
			<label for="BC_PE" class="titlePO">PE N° : </label>
			<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="<?php //$BC_PE?>">
	    </div>
		<div class="form-group col-md-4">
			<label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
			 <select  class="form-control form-control-sm BC_TYPEPRODUIT" name="BC_TYPEPRODUIT">
				<option>CINTRES</option>
				<option>SACHETS</option>
		        <option>GAINES</option>
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
			<input type="date" name="BC_DATELIVRE" class="form-control form-control-sm BC_DATELIVRE">
		</div>
		<div class="form-group col-md-3">
			<label for="BC_LIEU">LIEU DE LIVRAISON : </label>
			<input type="text" name="BC_LIEU" class="form-control form-control-sm BC_LIEU">
		</div>
		<div class="form-group col-md-3">
				 <label >Type de produit</label>
				 <select class="form-control typeDeproduit form-control-sm BC_TYPE_PRODUIT" name="BC_TYPE_PRODUIT">
					<option value="1">direct Printed PE rolls</option>
					 <option value="2">PE Plain Guzzet Bags</option>
					 <option value="3">Direct rolls PE plain</option>
					 <option value="4">PE Plain Bottom Seal Bag</option>
					 <option value="5">PE Bottom seal Colour</option>
					 <option value="6">PE Bottom Seal Bag printed</option>
					 <option value="7">PE Side Seal Printed bag</option>
					 <option value="8">PP side seal Plain bag</option>
					 <option value="9">PP side seal Printed</option>
					 <option value="10">PE Polysheet</option>
				 </select>	
		</div>
	</div>			
</fieldset>	
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
			<div class="form-group col-md-4">
				<label for="BC_REASSORT">Reassort : </label>
				 <input type="text" name="BC_REASSORT"   class="form-control form-control-sm BC_REASSORT ">
			</div>
			<div class="form-group col-md-4">
				<label for="BC_ECHANTILLON">Echantillon : </label>
				<input type="text" name="BC_ECHANTILLON"  class="form-control form-control-sm BC_ECHANTILLON">
			</div>
			<div class="form-group col-md-4">
				<label for="BC_DIMENSION">Dimension : </label>
				 <input type="text" name="BC_DIMENSION"  class="form-control form-control-sm BC_DIMENSION">
			</div>		
			<div class="form-group col-md-4">
				<label for="BC_RABAT">Rabat : </label>
				<input type="text" name="BC_RABAT"  class="form-control form-control-sm BC_RABAT">
			</div>
			<div class="form-group col-md-4">
				 <label for="BC_SOUFFLET">Soufflet : </label>
				 <input type="text" name="BC_SOUFFLET"  class="form-control form-control-sm BC_SOUFFLET">
			</div>
			<div class="form-group col-md-4">
				 <label for="BC_PERFORATION">Perforation : </label>
				 <input type="text" name="BC_PERFORATION"  class="form-control form-control-sm BC_PERFORATION">
			</div>
			<div class="form-group col-md-4">
			 	<label for="BC_TYPE">Type : </label>
				<select class="form-control BC_TYPE form-control-sm" name="BC_TYPE">
				 	<?php foreach ($type as $key => $type):?> 
					<option><?=$type->TF_DESIGNATION?></option>
					<?php endforeach;?>
				 </select>
			</div>
			<div class="form-group col-md-4">
				<label for="BC_IMPRESSION">Impression : </label>
				<input type="text" name="BC_IMPRESSION"  class="form-control form-control-sm BC_IMPRESSION">
			</div>
			<div class="form-group col-md-4">
				 <label for="BC_CYLINDRE">Cylindre : </label>
				 <input type="text" name="BC_CYLINDRE"  class="form-control form-control-sm BC_CYLINDRE">
			</div>
		</div>	
</fieldset>
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
		    <div class="form-group col-md-4">
				 <label for="BC_TYPEMATIER">Matière : </label>
				 <select class="form-control BC_TYPEMATIER form-control-sm" name="BC_TYPEMATIER">
					<?php foreach ($type_de_matier as $key => $type_de_matier):?> 
						<option><?=$type_de_matier->TM_DESIGNATION?></option>
					<?php endforeach;?>
				  </select>
			</div>
			<div class="form-group col-md-4">
				 <label for="BC_QUNTITE">Quantité : </label>
				 <input type="text" name="BC_QUNTITE"  class="form-control form-control-sm BC_QUNTITE">
			</div>
			<div class="form-group col-md-4">
				<label for="BC_CON_PRIX">Prix consentie par le client: </label>
				
				 <input type="text" name="BC_PRIX" class="form-control form-control-sm BC_PRIX">
			</div>
			<div class="form-group col-md-4">
				<label for="BC_CON_PRIX">Prix consentie par le client: </label>
				
				 <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_PRIX">
			</div>
			<div class="form-group col-md-4">
				  <label for="BC_PRIX">Prix : </label>
				 <input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm BC_CON_PRIX">
			</div>



			</div>
	    </div>	 
</fieldset>	 
<fieldset class="col-md-12 border mt-2">
<div class="row">        

         <!--/***************************************** PLanning ***************************************************/-->
		 <div class="form-group col-md-4 ">
				  <label for="BC_PRIX">Quantité à produire en mètre : </label>
				 <input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm QttMetre">
			</div>


			<div class="form-group col-md-4 ">
				  <label for="BC_PRIX">Poids d'un sachet : </label>
				 <input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm poidSachet">
			</div>
			<div class="form-group col-md-4 ">
				  <label for="BC_PRIX">Poids en Kg avec marge : </label>
				 <input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm poidMarge">
			</div>


			<div class="form-group col-md-4 ">
				  <label for="BC_PRIX">Dimension pour la production : </label>
				 <input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm rollDim">
			</div>

			<div class="form-group col-md-4 ">
				  <label for="BC_PRIX">Nombre de rouleaux : </label>
				 <input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm NROULEAUX">
			</div>

         <!--/*******************************************************************************************************/-->
</div>  
</fieldset>	 		 
<fieldset class="col-md-12 border mt-2">
    	<div class="row">  
			<div class="form-group col-md-12">
				<label for="BC_OBSERVATION">Observation : </label>
				<textarea class="form-control BC_OBSERVATION"></textarea>
			</div>	
		</div>
</fieldset>	
		</form>
   </div>
   <div class="card-footer text-right"> 
        <!-- <a href="<?=base_url('Commerciale/printFacture')?>" class="btn btn-info print"><i class="fa fa-print"></i> Imprimer</a>-->
        <button type="submit" class="btn btn-success saveCommande">Enregistre</button>
        <button type="reset" class="btn btn-danger">Annuler</button>
   </div>
  </div>  
</div>  
<script>
	$(document).ready(function(){
       $('.addPro').on('click',function(event){
       	  event.preventDefault();
       	  var UNITE = $('.UNITE').val();
       	  var QTE = $('.QTE').val();
       	  var Designation = $('.Designation').val();
       	  var CU = $('.CU').val();
       	  $('.tbody-pro').append('<tr><td>'+Designation+'</td><td>'+QTE+'</td><td>'+UNITE+'</td><td>'+CU+'</td><td>'+QTE*CU+'</td><tr>');
       	  $('.UNITE').val("");
       	  $('.QTE').val("");
       	  $('.Designation').val("");
       	  $('.CU').val("");

       });
		$('.validers').on('click',function(event){
			event.preventDefault();
			var somme = 0;
			$('.tbody-pro > tr').each(function(index, el) {
			var data ="";
			data = $(this).children().eq(4).text();
			somme = parseFloat(somme)  + parseFloat(data);
			});
		
		});
	});
</script>








