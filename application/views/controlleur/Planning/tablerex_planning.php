<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>REEXTRUSION</b>
   </div>
<div class="card-body">
<p class="mt-3 mb-3">
	<button class="btn btn-success text-left" style="width: 200px" type="button"  aria-expanded="false" aria-controls="NON_PLANNIFIER">
		<i class="fa fa-check"></i> REEXTRUSION
	</button>
</p>
<fieldset class="col-md-12 border">
    <div class="row">
<div class="form-group col-md-4">
			<label for="date">PO : </label>
			<input type="text" name="BC_PO" class="form-control form-control-sm BC_PO">
		</div>
        <div class="form-group col-md-4 pt-4">
			<a href="#" class="btn btn-info mt-3 btn-sm mr-2 info"><i class="fa fa-info"></i></a>
			<a href="#" class="btn btn-success cree mt-3 btn-sm"><i class="fa fa-save"></i>&nbsp;Crée</a>
	    </div>
</fieldset>		
</div>
</div>









<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">

<div class="card">

   <div class="card-header bg-dark text-white">

      <b> BON DE COMMANDE</b>

   </div>

   <div class="card-body">

    <div class="form">

		<form>	

	

       

<fieldset class="col-md-12 border">

    <div class="row">

			   <div class="form-group col-md-4">

				 <label for="date">Date : </label>

				 <input type="text" name="date"  disabled class="form-control form-control-sm date" >

				</div>

				<div class="form-group col-md-4">

				 <label for="BC_PE">PE N° : </label>

				 <input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">

				</div>

				 <div class="form-group col-md-4">

				 <label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
				   <input type="text" name="BC_CLIENT" disabled class="form-control form-control-sm BC_TYPEPRODUIT ">
				</div>
				<div class="form-group col-md-3">
				 <label for="BC_CLIENT">CLIENT, Référence : </label>
				 <input type="text" name="BC_CLIENT" disabled class="form-control form-control-sm BC_CLIENT ">
				</div>
				<div class="form-group col-md-3">
				 <label for="BC_CODE">CODE : </label>
				 <input type="text" name="BC_CODE" disabled class="form-control form-control-sm BC_CODE">
				</div>
				<div class="form-group col-md-3">
				 <label for="BC_DATELIVRE">Date de livraison : </label>
				 <input type="date" name="BC_DATELIVRE" disabled class="form-control form-control-sm BC_DATELIVRE">
				</div>
	</div>			
</fieldset>	
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
				<div class="form-group col-md-4">
				 <label for="BC_REASSORT">Reassort : </label>
				 <input type="text" name="BC_REASSORT" disabled  class="form-control form-control-sm BC_REASSORT ">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_ECHANTILLON">Echantillon : </label>
				 <input type="text" name="BC_ECHANTILLON" disabled class="form-control form-control-sm BC_ECHANTILLON">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_DIMENSION">Dimension : </label>
				 <input type="text" name="BC_DIMENSION" disabled class="form-control form-control-sm BC_DIMENSION">
				</div>		
				<div class="form-group col-md-4">
				 <label for="BC_RABAT">Rabat : </label>
				 <input type="text" name="BC_RABAT" disabled class="form-control form-control-sm BC_RABAT">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_SOUFFLET">Soufflet : </label>
				 <input type="text" name="BC_SOUFFLET" disabled  class="form-control form-control-sm BC_SOUFFLET">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_PERFORATION">Perforation : </label>
				 <input type="text" name="BC_PERFORATION" disabled class="form-control form-control-sm BC_PERFORATION">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_TYPE">Type : </label>
				 <input type="text" name="BC_TYPE" disabled class="form-control form-control-sm BC_TYPE">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_IMPRESSION">Impression : </label>
				 <input type="text" name="BC_IMPRESSION" disabled class="form-control form-control-sm BC_IMPRESSION">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_CYLINDRE">Cylindre : </label>
				 <input type="text" name="BC_CYLINDRE" disabled class="form-control form-control-sm BC_CYLINDRE">
				</div>
			</div>	
</fieldset>
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
        	<div class="form-group col-md-4">
				 <label for="BC_TYPEMATIER">Matiér : </label>
				  <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_TYPEMATIER">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_TYPEMATIER">QUANTITE A PRODUIRE EN METRE : </label>
				 <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_QUANTITEAPRODUIREENMETRE">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_TYPEMATIER">POIDS EN KG : </label>
				 <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_POISENKGSAVECMARGE">
				 
				</div>

				<div class="form-group col-md-4">
				 <label for="BC_QUNTITE">Quantité : </label>
				 <input type="text" name="BC_QUNTITE" disabled  class="form-control form-control-sm BC_QUNTITE">
				</div>
				<div class="form-group col-md-4">
				 <label for="BC_PRIX">Prix : </label>
				 <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_PRIX">
				</div>
			 </div>
	   </div>	 
</fieldset>	 
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
			<div class="form-group col-md-12">
			<label for="BC_OBSERVATION">Observation : </label>
			<textarea  disabled class="form-control BC_OBSERVATION"></textarea>
		</div>	
	</div>
</fieldset>	
	</div>
	
	</div>  
 </div>  
 </div>
</div>
</div>
</div>

<script>
	$(document).ready(function(){
		$('.BC_PO').autocomplete({
			source : base_url + "Production/autocompletPo",
			select : function(ui,iteme){
			/*var param= iteme.item.value.trim();
			$.post(base_url+"Production/recherchePE",{param:param},function(data){
				if(data.result==""){
				alertMessage("Erreur","PO Introvable","error","btn btn-danger");
				}else{
				//$('.equipe').empty().append(data.result); 
				}    
			},'json');*/
			}
       });
	   $('.info').on('click',function(){
		event.preventDefault();
		var pe =  $(".BC_PO").val();
      $.post(base_url+"magasiner/detailBon",{pe:pe},function(data){
        $(".BC_PE").val(data.BC_PE);
        $(".date").val(data.BC_DATE);
        $(".BC_CLIENT").val(data.BC_CLIENT);
        $(".BC_CODE").val(data.BC_CODE);
        $(".BC_DATELIVRE").val(data.BC_DATELIVRE);
        $(".BC_REASSORT").val(data.BC_REASSORT);
        $(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);	 
        $(".BC_DIMENSION").val(data.BC_DIMENSION);
        $(".BC_RABAT").val(data.BC_RABAT);
        $(".BC_SOUFFLET").val(data.BC_SOUFFLET);
        $(".BC_PERFORATION").val(data.BC_PERFORATION);
        $(".BC_TYPE").val(data.BC_TYPE);
        $(".BC_TYPEPRODUIT").val(data.BC_TYPEPRODUIT);
        $(".BC_IMPRESSION").val(data.BC_IMPRESSION);
        $(".BC_QUNTITE").val(data.BC_QUNTITE);
        $(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
        $(".BC_TYPEMATIER").val(data.BC_TYPEMATIER);
        $(".BC_PRIX").val(data.BC_PRIX);
        $(".BC_POISENKGSAVECMARGE").val(data.BC_POISENKGSAVECMARGE);
        $(".BC_QUANTITEAPRODUIREENMETRE").val(data.BC_QUANTITEAPRODUIREENMETRE);
        $(".BC_OBSERVATION").val(data.BC_OBSERVATION);
        $("#infoCOmmande").modal("show");	
        },"json");
  
	   });


	   $('.cree').on('click',function(event){
		event.preventDefault();
		var pe =  $(".BC_PO").val();
			$.post(base_url+"planning/reex",{pe:pe},function(data){
			
			}).done(function(){
				alertMessage("Succè!","Réextrusion enregistré.","success","btn btn-success");
			}).fail(function(){
				alertMessage("Erreur!","Réextrusion non enregistré.","error","btn btn-danger");
			});

	   });

	   function alertMessage(title,message,icons,btn){
			swal(title,message, {
				icon : icons,
				buttons: {              
					confirm: {
						className : btn
							}
						},
				});
		}			
	});
</script>