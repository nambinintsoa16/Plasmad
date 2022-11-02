<div class="card">
   <div class="card-header bg-dark text-white">
      <b>MODIFIER JOB CARD</b>
   </div>
   <div class="card-body">
    <div class="form">
		<form method="post" action="<?=base_url('Commerciale/sauveCommande')?>">	
<fieldset class="col-md-12 border">
    <div class="row">
	<div class="form-group col-md-2">
				 <label for="BC_PE">PO N° : </label>
				 <input type="text" name="BC_PE" value="<?=$job->BC_PE?>" disabled class="form-control form-control-sm BC_PE" value="">
				</div>
				<div class="form-group col-md-3">
				    <label for="DJ_MACHINE">PROCESSUS</label>
					<input type="text" name=""  value="<?=$job->JO_TYPE?>" disabled  class="form-control form-control-sm procs">
				</div>
		
				 <div class="form-group col-md-3">
				 <label for="JO_ID">JOB CARD N° : </label>
				 <input type="text" name="JO_ID" value="<?=$job->JO_ID?>" disabled class="form-control form-control-sm JO_ID">
				</div>
				<div class="form-group col-md-3">
				 <label for="">DEBUT : </label>
				 <input type="time" name="" value="<?=$job->JO_DEB?>"  disabled class="form-control form-control-sm hdeb">
				</div>
				<div class="form-group col-md-3">
				 <label for="">DUREE : </label>
				 <input type="text" name=""  value="<?=$job->JO_DURE?>" disabled  class="form-control form-control-sm heure">
				</div>
			
				<div class="form-group col-md-4">
				<label for="BC_QUANTITEAPRODUIREENMETRE">QUANTITE A PRODUIRE EN METRE : </label>
				<input type="text" name="BC_QUANTITEAPRODUIREENMETRE" value="<?=$job->BC_QUANTITEAPRODUIREENMETRE?>" class="form-control form-control-sm BC_QUANTITEAPRODUIREENMETRE">
				</div>
				<div class="form-group col-md-4">
				<label for="BC_POISENKGSAVECMARGE">POIDS EN KG AVEC MARGE : </label>
				<input type="text" name="BC_POISENKGSAVECMARGE" value="<?=$job->BC_POISENKGSAVECMARGE?>" class="form-control form-control-sm BC_POISENKGSAVECMARGE">
				</div>

				<div class="form-group col-md-4">
				<label for="TERMINER">TERMINER : </label>
				<input type="text" name="TERMINER"  id ="TERMINER" value="<?=$job->JO_AV?>" class="form-control form-control-sm terminer">
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
						<input type="text" class="form-control form-control-sm Quantite" placeholder="Quantite" aria-label="Entre désignation" aria-describedby="basic-addon2">
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
				    			<th></th>
				    		</tr>
				    	</thead>
				    	<tbody class="tbody-modaltable text-center">
				    		<?php foreach ($matier as $key => $matier):?>
								<tr>
									<td><?= $matier->MU_ID?></td>
									<td><?= $matier->MU_DESIGNATION?></td>
									<td><?= $matier->MU_QUANTITE?></td>
									<td><a href="#" id="<?= $matier->MU_ID?>" class="btn btn-danger btn-sm dell"><i class="fa fa-times"></i></a></td>
								</tr>	
							<?php endforeach;?>
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
<script>
	$(document).ready(function(){
	

    function  deleteTd(){
		$('.dell').on('click',function(event){
		  event.preventDefault();
		  var parent =  $(this).parent().parent();
		  var id =parent.children().eq(0).text();
		  $.post(base_url+'planning/deleTeMatier',{id:id},function(){
			parent.remove();
			swal("succè! ", "Matier supprimer", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});  
		  });

	   });
	   $( ".stock_sortie" ).autocomplete({
    source: base_url+"Planning/autocompleteSortie",
    appendTo:"#infoCOmmande"
});

}

$('.DJ_MACHINEE').on('change',function(){
	var machine = $(this).val();
	var BC =  $('.JO_ID').val();
	if($('.terminer').val()==""){
		var poids = $('.BC_POISENKGSAVECMARGE').val();
	}else{
		var poids = $('.terminer').val();
	}
	var date = $('.date_prod').val();
	var type = $('.procs').val();
	$.post(base_url+'Planning/calculePlanning',{poids:poids,date:date,machine:machine},function(data){
		if(data.message=="init"){
			var debut = $('.hdeb').val();
			var dure = $('.heure').val();
			$.post(base_url+"Planning/crateJobsMachine",{debut:debut,dure:dure,BC:BC,machine:machine,type:type},function(datas){
				swal("succè! ", "Machine modifier", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});  
			});
		}else{
			var debut = data.debut;
			var dure = data.dure;
			$.post(base_url+"Planning/crateJobsMachine",{debut:debut,dure:dure,BC:BC,machine:machine,type:type},function(datas){
				swal("succè! ", "Machine  modifier", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});  
			});
		}
         
	},'json');
	

});
$('.BC_POISENKGSAVECMARGE').on('change',function(){
	event.preventDefault();
	var data = $(this).val();
	var BC =  $('.BC_PE').val();
	$.post(base_url+'Planning/updatPoid',{data:data,BC:BC},function(data){
		if(data==1){
			swal("succè! ", "POIDS EN KG AVEC MARGE modifier", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});  
		}else{
			swal("Erreur! ", "POIDS EN KG AVEC MARGE non modifier", {
				icon : "error",
				buttons: {
					confirm: {
						className : 'btn btn-danger'
					}
				},
			});  
		}	        
    });

});

$('.BC_QUANTITEAPRODUIREENMETRE').on('change',function(){
	event.preventDefault();
	var data = $(this).val();
	var BC =  $('.BC_PE').val();
	$.post(base_url+'Planning/updatemetre',{data:data,BC:BC},function(data){
		if(data==1){
			swal("succè! ", "Quantite modifier", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});  
		}else{
			swal("Erreur! ", "Quantite non modifier", {
				icon : "error",
				buttons: {
					confirm: {
						className : 'btn btn-danger'
					}
				},
			});  
		}	        
    });

});
$('#TERMINER').on('change',function(event){
	event.preventDefault();
	var data = $(this).val();
	var BC =  $('.JO_ID').val();
	$.post(base_url+'Planning/updateteminer',{data:data,BC:BC},function(data){
		if(data==1){
			swal("succè! ", "Poids modifier", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});  
		}else{
			swal("Erreur! ", "Poids non modifier", {
				icon : "error",
				buttons: {
					confirm: {
						className : 'btn btn-danger'
					}
				},
			});  
		}	        
    });
});
 

deleteTd();

$('.add-table').on('click',function(e){
  e.preventDefault(); 
  if($('.stock_sortie').val()!="" && $('.Quantite').val()!=""){
  var data =$('.stock_sortie').val().split('|');
  var i =  1;
  if (typeof($('.tbody-modaltable > tr').html()) == 'undefined') { 
         $('.tbody-modaltable').append('<tr><td>'+i+
         '</td><td>'+data[0]+'</td>'+
         '<td>'+ $('.Quantite').val()+'</td><td class="text-center"><a href="#" class="btn btn-danger btn-sm dell"><i class="fa fa-times"></i></a>'+
         '</td></tr>');
      
		var DESIGNATION = data[0];
		var QUANTITE =   $('.Quantite').val();
		var BC =   $('.BC_PE').val();
		 $.post(base_url+"planning/sauveMatier",{DESIGNATION:DESIGNATION,QUANTITE:QUANTITE,BC:BC},function(Response){
			swal("succè! ", "Matier ajouter", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});  
           $('.stock_sortie').val("");
           $('.Quantite').val("");
		});
        deleteTd();
  }else{
     var table =[];
     $('.tbody-modaltable > tr').each(function(){
         table.push($(this).children().eq(1).text());   
     });  
   
       if ($.inArray(data[0], table) != -1) {
        alertMessage("Ooops!!","Ce materiel existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre materiel.",'error','btn btn-danger');
       } else {
         i++;
         $('.tbody-modaltable').append('<tr><td>'+i+
         '</td><td>'+data[0]+'</td>'+
         '<td>'+ $('.Quantite').val()+'</td><td class="text-center"><a href="#" class="btn btn-danger btn-sm dell"><i class="fa fa-times"></i></a>'+
         '</td></tr>');
    
		 var DESIGNATION =data[0];
	     var QUANTITE =   $('.Quantite').val();
		 var BC =   $('.BC_PE').val();
		 $.post(base_url+"planning/sauveMatier",{DESIGNATION:DESIGNATION,QUANTITE:QUANTITE,BC:BC},function(Response){
			swal("succè! ", "Matier ajouter", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			}); 
     $('.stock_sortie').val("");
         $('.Quantite').val("");
		});
         deleteTd();
         
       }

   }
  }else{
   alertMessage("Ooops!!","Champs designation et Champs Quantite obligatoire",'error','btn btn-danger');
  }
});  













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
function closeDialog(){
   $('.jconfirm').remove();
  }

	});
</script>