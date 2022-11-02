<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		 <li class="breadcrumb-item"><a href="#">Accueil</a></li>
		 <li class="breadcrumb-item"><a href="#">Commerciale</a></li>
		 <li class="breadcrumb-item"><a href="#">Bon de commande</a></li>
	</ol>
</nav>
 <div class="card">
   <div class="card-header bg-dark text-white">
      <b> BON DE COMMANDE CINTRE</b>
   </div>
   <div class="card-body">
    <div class="form">
		<form method="post" action="<?=base_url('Commerciale/sauveCommande')?>">	
<fieldset class="col-md-12 border">
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
<script>
	$(document).ready(function(){
		$('.BC_DATE , .BC_DATELIVRE').datepicker();
		$.post(base_url+'Commerciale/numBonCintre',{type:"EPZ"},function(data){
            
  				$('.BC_PE').val("IN"+data);
          	
		},'json');

		$('.BC_TYPEPO').on('change',function(){
	    	var type = $(this).val();
          $.post(base_url+'Commerciale/numBonCintre',{type:type},function(data){
          	if(type=="CMTI"){
 				 $('.BC_PE').val("IN"+data+"C");
          	}else{
  				$('.BC_PE').val("IN"+data);
          	}
        
		},'json');


		});
		$.post(base_url+'Commerciale/numBonCintre')
       $('.saveCintre').on('click',function(event){
              event.preventDefault();
              var BC_DATE = $('.BC_DATE').val();
              var BC_TYPEPO = $('.BC_TYPEPO').val();
              var BC_PE = $('.BC_PE').val();
              var BC_TYPEPRODUIT = $('.BC_TYPEPRODUIT option:selected').val();
              var BC_CLIENT = $('.BC_CLIENT').val();
              var BC_CODE = $('.BC_CODE').val();
              var BC_DATELIVRE = $('.BC_DATELIVRE').val();
              var BC_LIEU = $('.BC_LIEU').val();
              var BC_TYPE_PRODUIT = $('.BC_TYPE_PRODUIT').val();
              var BC_MODEL = $('.BC_MODEL').val();
              var BC_COULEUR = $('.BC_COULEUR').val();
              var BC_QUNTITE = $('.BC_QUNTITE').val();
              var BC_OBSERVATION = CKEDITOR.instances.BC_OBSERVATION.getData();
              var BC_CON_PRIX = $('.BC_CON_PRIX').val();
              chargement();
            $.post(base_url+"Commerciale/saveCintre",{
                BC_DATE:BC_DATE,BC_TYPEPO:BC_TYPEPO,BC_PE:BC_PE,BC_TYPEPRODUIT:BC_TYPEPRODUIT,
                BC_CLIENT:BC_CLIENT,BC_CODE:BC_CODE,BC_DATELIVRE:BC_DATELIVRE,BC_LIEU:BC_LIEU,
                BC_TYPE_PRODUIT:BC_TYPE_PRODUIT,BC_MODEL:BC_MODEL,BC_COULEUR:BC_COULEUR,
                BC_QUNTITE:BC_QUNTITE,BC_OBSERVATION:BC_OBSERVATION,BC_CON_PRIX:BC_CON_PRIX
            },function(data){
                closeDialog();
				       $.post(base_url+'Commerciale/numBonCintre',{type:BC_TYPEPO},function(data){
				          if(BC_TYPEPO =="CMTI"){
			 				 $('.BC_PE').val("IN"+data+"C");
			          	}else{
			  				$('.BC_PE').val("IN"+data);
			          	}
			},'json');
              $('input').val("");
			  CKEDITOR.instances.BC_OBSERVATION.setData("");
              swal({
						title: 'Bon de commande enregistré!',
						text: "Voulez-vous imprimer?",
						type: 'warning',
						buttons: {
							confirm: {
								text: 'OUI',
								className: 'btn btn-success'
							},
							cancel: {
								text:'NON',
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Delete) => {
						if (Delete) {
							/*$.post(base_url+'Commerciale/printFacture',{PO:BC_PE},function(){
								alertMessage("Succè!","Bon de commande enregistré.","success","btn btn-success");
							});*/
							location.replace(base_url + 'Commerciale/printFactureCintre?po=' + BC_PE);
						} else {
							alertMessage("Succè!", "Bon de commande enregistré.", "success", "btn btn-success");
						}
					});
            },'json');
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

function chargement(){
	var htmls='<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
	$.dialog({
	  "title": "",
	  "content": htmls,
	  "show": true,
	  "modal": true,
	  "close": false,
	  "closeOnMaskClick": false,
	  "closeOnEscape": false,
	  "dynamic": false,
	  "height": 150,
	  "fixedDimensions": true
	});   
	  
	  
  }
  
  function closeDialog(){
   $('.jconfirm').remove();
  }
  
	});
</script>






