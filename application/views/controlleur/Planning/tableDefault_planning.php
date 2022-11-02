 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>NON PLANNIFIER</b>
   </div>
<div class="card-body">

<fieldset class="border p-3">
<div class="col-sm-12 ">
	<div class="row text-rigth">
	    <input type="date" name="" class="form-control form-control-sm col-md-4 dateAffiche">
	    <button class="btn btn-primary btn-sm col-md-2 ml-2 afficheDefult"><i class="fa fa-tv"></i> Afficher</button>
	</div>
</div>
</fieldset>
<fieldset class="border p-3 mt-2">
<div class="table-responsive mt-3">
<table class="w-100 table-bordered bordered-dark table-hover table-sm Ttab table-responsive"  style="font-size: 13px!important;">
    <thead class="bg-dark text-white text-center text-sm">
        <tr >
      <th>PO</th>	
			<th>DATE</th>
			<th>LIVRAISON</th>
			<th>CLIENT</th>	
			<th>CODE</th>
			<th>PRODUIT</th>
			<th>MATIERE</th>
			<th>TYPE</th>
			<th>ECHANTILLON</th>
			<th>MODELE</th>	
			<th>IMPRESSION</th>	
			<th>DIMENSION</th>
			<th>REASSORT</th>
			<th>RABAT</th>
			<th>SOUFFLET</th>
			<th>PERFORATION</th>
			<th>QTY	</th>
			<th>QTY PROD</th>
			<th>P.SACHET</th>
			<th>P.AVEC MARGE</th>
      <th>DIMENSION PROD</th>
			<th>ROULEAUX</th>
			<th>OBSERVATION</th>
      <th></th>
	    </tr>
    </thead>
    <tbody class="bg-default text-dark tbody noplan">
    <?php foreach ($data as $key => $data):?>  
		<tr> 
	    	<td> <?= $data->BC_PE?></td>
			<td> <?= $data->BC_DATE?></td>
			<td> <?= $data->BC_DATELIVRE?></td>
			<td> <?= $data->BC_CLIENT?></td>
			<td> <?= $data->BC_CODE?></td>
			<td> <?= $data->BC_TYPEPRODUIT?></td>
			<td> <?= $data->BC_TYPEMATIER?></td>
			<td> <?= $data->BC_TYPE?></td>
			<td> <?= $data->BC_ECHANTILLON?></td>
			<td> <?= $data->BC_MODEL?></td>
			<td> <?= $data->BC_IMPRESSION?></td>
			<td> <?= $data->BC_DIMENSION?></td>
			<td> <?= $data->BC_REASSORT?></td>
			<td> <?= $data->BC_RABAT?></td>
			<td> <?= $data->BC_SOUFFLET?></td>
			<td> <?= $data->BC_PERFORATION?></td>
			<td> <?= $data->BC_QUNTITE?></td>
		  <td> <?= $data->BC_QUANTITEAPRODUIREENMETRE;?></td>
		  <td> <?= $data->BC_POIDSDUNSACHET;?></td>
		  <td> <?= $data->BC_POISENKGSAVECMARGE;?></td>
      <td> <?= $data->BC_DIMENSIONPROD;?></td>
		  <td> <?= $data->BC_ROULEAUX;?></td>
			<td><?php 
      
      if($data->BC_OBSERVATION!=""):?>
<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#<?=$data->BC_PE?>">
OBSERVATION
</button>

<!-- Modal -->
<div class="modal fade classVide" id="<?=$data->BC_PE?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">OBSERVATION</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
		     <textarea class="form-control"><?=$data->BC_OBSERVATION?></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">FERMER</button>
				
			</div>
		</div>
	</div>
</div>

      <?php endif;?></td>
    <td><a href="#" class="btn btn-warning btn-sm editdata"><i class="fa fa-edit"></i></td>
		</tr>	
	<?php endforeach;?>  
    </tbody>
</table>
</div></div>
</fieldset>
<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
<div class="card">
   <div class="card-header bg-dark text-white">
      <b>CREATION JOB CARD</b>
   </div>
   <div class="card-body">
    <div class="form">
		<form method="post" action="<?=base_url('Commerciale/sauveCommande')?>">	
<fieldset class="col-md-12 border">
    <div class="row">
	<div class="form-group col-md-6">
				 <label for="BC_PE">PO N° : </label>
				 <input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
				</div>
				 <div class="form-group col-md-6">
				 <label for="JO_ID">JOB CARD N° : </label>
				 <input type="text" name="JO_ID"  disabled class="form-control form-control-sm JO_ID">
				</div>
        </div>			
</fieldset>			
<fieldset class="col-md-12 border mt-2">
    <div class="row">			
				<div class="form-group col-md-4">
				<label for="BC_QUANTITEAPRODUIREENMETRE">QUANTITE A PRODUIRE EN METRE : </label>
				<input type="text" name="BC_QUANTITEAPRODUIREENMETRE" class="form-control form-control-sm BC_QUANTITEAPRODUIREENMETRE">
				</div>
				<div class="form-group col-md-4">
				<label for="BC_POISENKGSAVECMARGE">POIDS EN KG AVEC MARGE : </label>
				<input type="text" name="BC_POISENKGSAVECMARGE" class="form-control form-control-sm BC_POISENKGSAVECMARGE">
				</div>
                
        <div class="form-group col-md-3">
				<label for="BC_ROULEAUX">NOMBRE DE ROULEAUX: </label>
				<input type="text" name="BC_ROULEAUX" class="form-control form-control-sm BC_ROULEAUX">
				</div>
				
        <div class="form-group col-md-4">
				<label for="POIDSSACHET">POIDS D'UN SACHET : </label>
				<input type="text" name="POIDSSACHET" class="form-control form-control-sm  POIDSSACHET">
				</div>
        <div class="form-group col-md-4">
				<label for="BC_DIMENSIONPROD">DIMENSION POUR LA PRODUCTION : </label>
				<input type="text" name="BC_DIMENSIONPROD" class="form-control form-control-sm  BC_DIMENSIONPROD">
				</div>

				
			
	</div>			
</fieldset>	
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
			<div class="form-group col-md-4">
				<label for="BC_OBSERVATION">Matière première : </label>
			</div>	
			<div class="form-group col-md-4">
				<div class="form-group">
					<div class="input-group-append">
				<input type="text" class="form-control form-control-sm stock_sortie " placeholder="Entre désignation" >   </div>
				</div>
			</div>	
			<div class="form-group col-md-4">
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" class="form-control form-control-sm Quantite" placeholder="Quantité" aria-label="Entre désignation" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<a href="#" class="input-group-text btn btn-primary text-white form-control-sm add-table" id="basic-addon2"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
			   	
			</div>	
			<div class="form-group col-md-12">
				    <table class="w-100 table-bordered table-hover table-sm">
				    	<thead class="bg-dark text-white text-center">
				    		<tr>
				    			<th>N°</th>
				    			<th>Designation</th>
				    			<th>Quantite</th>
				    			<th>PU</th>
				    			<th></th>
				    		</tr>
				    	</thead>
				    	<tbody class="tbody-modaltable text-center">
				    		
				    	</tbody>
				    </table>
			</div>					  
			
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

   </div>
   <div class="card-footer text-right"> 
         <button type="submit" class="btn btn-success UpdateCommande">ENREGISTRE</button>
         <button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
   </div>
</form>
  </div>  
</div>  
			</div>
	
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){

//Job_card();
$('.afficheDefult').on('click',function(e){
  e.preventDefault(); 
  var date = $('.dateAffiche').val();
 $.post(base_url+"Planning/page_jobs",{date:date,page:"NON PLANNIFIER"},function(data){
	$(".containt-result").empty().append(data);
 });
 

});
function Job_card(){
  $('.btn-click-planning').on('click',function(e){
    e.preventDefault();
    var page = $(this).children().find('b').text();
    $.post(base_url+"Planning/page_jobs",{page:page},function(data){
          $('.containt-result').empty().append(data);
       });
   });
  
  }
function lasteHeure(){
  $('.DJ_MACHINE').on('change',function(){
      var machine = $('.DJ_MACHINE option:selected').val();  
      $.post(base_url+'Planning/testHeure', {machine: machine}, function(data) {
             $('.hdeb').val(data);
      });
  });

}


$(".Ttab").DataTable({
    processing: true,
    language: {
      url :base_url+"assets/dataTableFr/french.json"
    },
  });
 
$( ".stock_sortie" ).autocomplete({
    source: base_url+"Planning/autocompleteSortie",
    appendTo:"#infoCOmmande"
});
$('.add-table').on('click',function(e){
  e.preventDefault(); 
  if($('.stock_sortie').val()!="" && $('.Quantite').val()!=""){
  var data =$('.stock_sortie').val().split("|");
  var i =  1;
  if (typeof($('.tbody-modaltable > tr').html()) == 'undefined') { 
         $('.tbody-modaltable').append('<tr><td>'+i+
         '</td><td>'+data[0].trim()+'</td>'+
         '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="'+ $('.Quantite').val()+
         '"></td><td class="text-center">'+data[1].trim()+'</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>'+
         '</td></tr>');
         $('.stock_sortie').val("");
        $('.Quantite').val("");
        deleteTd();
  }else{
     var table =[];
     $('.tbody-modaltable > tr').each(function(){
         table.push($(this).children().eq(1).text());   
     });  
   
       if ($.inArray(data, table) != -1) {
        alertMessage("Ooops!!","Ce materiel existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre materiel.",'error','btn btn-danger');
       } else {
         i++;
         $('.tbody-modaltable').append('<tr><td>'+i+
         '</td><td>'+data[0].trim()+'</td>'+
         '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="'+ $('.Quantite').val()+
         '"></td><td class="text-center">'+data[1].trim()+'</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>'+
         '</td></tr>');
         $('.stock_sortie').val("");
         $('.Quantite').val("");
         deleteTd();
         
       }

   }
  }else{
   alertMessage("Ooops!!","Champs designation et Champs Quantite obligatoire",'error','btn btn-danger');
  }
});  

$('.date_prod').on('change',function(event){
  event.preventDefault();
  var date = $(this).val(); 
  var poids = $('.ENPRODUCTION').val();
  var machine = $('.DJ_MACHINE option:selected').val();
  var processus = $('.BC_STATUT option:selected').val();

   if(poids!=""){ 
    $.post(base_url+'Planning/calculePlanning',{poids:poids,date:date,machine:machine,BC_STATUT:processus},function(data){
      if(data.message=="true"){
        $('.heure').val(data.dure);
        $('.hdeb').val(data.hdeb);
        $('.dateFIn').val(data.dateFIn);
        $('.heurefin').val(data.heurefin);
             $('#infoCOmmande').modal("show");
      }else if(data.message=="over"){
        alertMessage("Erreur!","Date non disponible! Veuillez choisir un autre!","error","btn btn-danger");
        $('.heure').val('');
        $('.hdeb').val('');
        $('.dateFIn').val('');
        $('.heurefin').val('');
        $('.date_prod').val('');

      }else if(data.message=="init"){
        $('#infoCOmmande').modal("hide");
        swal({
          title:'DUREE',
          html: '',
          content: {
            element: "input",
            attributes: {
              type: "time",
              id: "input-field",
              className: "form-control"
            },
          },
          buttons: {
            cancel: {
              visible: true,
              className: 'btn btn-danger'
            },
            confirm: {
              className : 'btn btn-success'
            }
          },
        }).then(
        function() {
          var hdeb = $('#input-field').val();
          $.post(base_url+'Planning/tempsDeProduction',{processus:processus,date:date,poids:poids,machine:machine,heure:hdeb},function(data){
             $('.heure').val(data.dure);
             $('.hdeb').val($('#input-field').val());
             $('.dateFIn').val(data.dateFIn);
             $('.heurefin').val(data.heurefin);
             $('#infoCOmmande').modal("show");
          },'json');
           
        }
        );

      }else{  
        alertMessage("Ooops!!",data.observation,'error','btn btn-danger');
        $('.heure').val('');
        $('.hdeb').val('');
        $('.dateFIn').val('');
        $('.heurefin').val('');
        $('.date_prod').val('');
      }

    },'json');
  }else{
    alertMessage("Ooops!!","Champs 'POIDS EN KG AVEC MARGE' est obligatoire",'error','btn btn-danger');
  }

});



$('.UpdateCommande').on('click',function(e){
   e.preventDefault();

   var BC_PE = $('.BC_PE').val().trim(); 
   var BC_QUANTITEAPRODUIREENMETRE = $('.BC_QUANTITEAPRODUIREENMETRE').val();
   var BC_POISENKGSAVECMARGE = $('.BC_POISENKGSAVECMARGE').val();
   var BC_DIMENSIONPROD = $('.BC_DIMENSIONPROD').val();
   var BC_ROULEAUX = $('.BC_ROULEAUX').val();
   var POIDSSACHET = $('.POIDSSACHET').val();
   chargement();   
  $('.tbody-modaltable tr').each(function( index ){
     var MU_DESIGNATION = $(this).children().eq(1).text(); 
     var MU_QUANTITE = $(this).children().eq(2).find("input").val();
     var MU_PRIX =$(this).children().eq(3).text();
     $.post(base_url+'Planning/saveMartierPr',{BC_PE:BC_PE,MU_DESIGNATION:MU_DESIGNATION,MU_QUANTITE:MU_QUANTITE,MU_PRIX:MU_PRIX},function(){
        
     }); 
      
  });
  
   $.post(base_url+'Planning/createJobScartEtat1',{POIDSSACHET:POIDSSACHET,BC_PE:BC_PE.trim(),BC_QUANTITEAPRODUIREENMETRE:BC_QUANTITEAPRODUIREENMETRE,BC_POISENKGSAVECMARGE:BC_POISENKGSAVECMARGE,BC_DIMENSIONPROD:BC_DIMENSIONPROD,BC_ROULEAUX:BC_ROULEAUX},function(data){
           $('input').val("");
          $('.tbody-modaltable tr').empty();
          $("#infoCOmmande").modal("hide");
          alertMessage("","Job carte enregistre avec success",'success','btn btn-success');
          closeDialog();
   });

});
tableloade();

function tableloade(){

    $(".editdata").on("click",function(e){
      e.preventDefault();
     
          var $tr=$(this).parent().parent();
        
          var type =  $tr.children().eq(5).text();
          
          if(type=="SACHETS"){
            $('.BC_STATUT').children().first().empty().append("EXTRUSION");
          }else{
             $('.BC_STATUT').children().first().empty().append("INJECTION");
          }
          $('.BC_PE').val( $tr.children().first().text());
          var BC_QUANTITEAPRODUIREENMETRE =  $tr.children().eq(17).text();
          var BC_POISENKGSAVECMARGE =  $tr.children().eq(19).text();
          var BC_ROULEAUX = $tr.children().eq(21).text();
          var POIDSSACHET = $tr.children().eq(18).text();
          var BC_DIMENSIONPROD = $tr.children().eq(20).text();

          $.post(base_url+"Planning/lastIdJob",{},function(data){
               $('.JO_ID').empty().val(data);
               $('.tbody-modaltable').empty();   
               $('.BC_QUANTITEAPRODUIREENMETRE').val(BC_QUANTITEAPRODUIREENMETRE);
               $('.BC_POISENKGSAVECMARGE').val(BC_POISENKGSAVECMARGE);
               $('.BC_ROULEAUX').val(BC_ROULEAUX);
               $('.POIDSSACHET').val(POIDSSACHET);
               $('.BC_DIMENSIONPROD').val(BC_DIMENSIONPROD);

               $("#infoCOmmande").modal("show");
               lasteHeure();
          }); 
      

});
var types =  $('.BC_STATUT option:selected').val();
$.post(base_url+'Planning/machineModaleTable',{type:types},function(data){
      $('.DJ_MACHINE').empty();
      data.forEach(element => $('.DJ_MACHINE').empty().append("<option>"+element+"</option>"));
      $('.tbody-modaltable').empty();
      $('.stock_sortie').val("");
      $('.Quantite').val("");
      $('.BC_QUANTITEAPRODUIREENMETRE').val("");
      $('.BC_POISENKGSAVECMARGE').val("");
      $('.date_prod').val(""); 
},'json');  
$('.BC_STATUT').on('change',function(){
  var types  = $(this).val();
  $.post(base_url+'Planning/machineModaleTable',{type:types},function(data){
    $('.DJ_MACHINE').empty();
    data.forEach(element => $('.DJ_MACHINE').append("<option>"+element+"</option>"));
},'json');  
});
}
function deleteTd(){
   $('tbody .delete-td').on('click',function(e){
      e.preventDefault();
      $(this).parent().parent().remove();
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