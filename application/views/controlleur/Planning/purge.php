<nav aria-label="breadcrumb">
	   <ol class="breadcrumb">
		 <li class="breadcrumb-item"><a href="#">Accueil</a></li>
		 <li class="breadcrumb-item"><a href="#">Planning</a></li>
		 <li class="breadcrumb-item active" aria-current="page">Purge</li>
	   </ol>
</nav>
<div class="card">
   <div class="card-header bg-dark text-white">
      <b>PURGE</b>
   </div>
   <div class="card-body">
    <div class="form">
		<form method="post" action="<?=base_url('Commerciale/sauveCommande')?>">	
<fieldset class="col-md-12 border">
    <div class="row">
		<div class="form-group col-md-4">
			<label for="date">Date : </label>
			<input type="date" name="BC_DATE" class="form-control form-control-sm BC_DATE" value=<?=date('d-m-Y')?>>
		</div>
        <div class="form-group col-md-4">
			<label for="date">N°PO : </label>
			<input type="text" name="BC_DATE" class="form-control form-control-sm BC_PO">
		</div>

						<div class="form-group col-md-4">
							<label for="">DEBUT : </label>
							<input type="time" name="" class="form-control form-control-sm hdebe">
						</div>
						<div class="form-group col-md-4">
							<label for="">DUREE : </label>
							<input type="text" name="" class="form-control form-control-sm heuree">
						</div>
						<div class="form-group col-md-4">
							<label for="">DATE FIN : </label>
							<input type="date" name="" class="form-control form-control-sm dateFIne">
						</div>
						<div class="form-group col-md-4">
							<label for="">HEURE FIN : </label>
							<input type="time" name="" class="form-control form-control-sm heurefine">
						</div>
		
		<div class="form-group col-md-4">
			<label for="date">TYPE : </label>
			<select class="form-control TYPE form-control-sm" name="TYPE">
				<option value="PURGE">PURGE</option> 
				<option value="COMPENSATION">COMPENSATION</option>
			</select>
		</div>	

		<div class="form-group col-md-4">
			<label for="date">POID MATIERE : </label>
			<input type="text" name="BC_MATIER" class="form-control form-control-sm BC_MATIER">	
		</div>	

		<div class="form-group col-md-4">
			<label for="date">MACHINE : </label>
			<select class="form-control DJ_MACHINEE form-control-sm" name="TYPE">
				
			</select>
		</div>		


	
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


        <div class="form-group col-md-12 pt-4 text-rigth">
			<a href="#" class="btn btn-success btn-success-sm cree mt-2"><i class="fa fa-">ENREGISTRER</a>
	    </div>

    </div>  

</fieldset>        
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






	$('.DJ_MACHINEE').on('change', function(event) {
			event.preventDefault();
			var date = $(".BC_DATE").val();
			var processus = "IMPRESSION_EXTRUSION";//$('.BC_STATUT option:selected').val();
			var machine = $('.DJ_MACHINEE option:selected').val();
			var poids = $(".matier").val();
			$.post(base_url + 'Planning/calculePlanning', {
				date: date,
				poids: poids,
				machine: machine,
				BC_STATUT: processus
			}, function(data) {
				if (data.message == "true") {

					$('.heuree').val(data.dure);
					$('.hdebe').val(data.hdeb);
					$('.dateFIne').val(data.dateFIn);
					$('.heurefine').val(data.heurefin);
					$(".editData").modal("show");
				} else if (data.message == "over") {
					alertMessage("Erreur!", "Date non disponible! Veuillez choisir une autre!", "error", "btn btn-danger");
					$('.heuree').val('');
					$('.hdebe').val('');
					$('.dateFIne').val('');
					$('.heurefine').val('');
					$('.BC_DATE').val('');

				} else if (data.message == "init") {
					$(".editData").modal("hide");
					swal({
						title: 'DUREE',
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
								className: 'btn btn-success'
							}
						},
					}).then(
						function() {
							var hdeb = $('#input-field').val();
							$.post(base_url + 'Planning/tempsDeProduction', {
								processus: processus,
								date: date,
								machine: machine,
								heure: hdeb
							}, function(data) {
								$('.heuree').val(data.dure);
								$('.hdebe').val($('#input-field').val());
								$('.dateFIne').val(data.dateFIn);
								$('.heurefine').val(data.heurefin);
								$(".editData").modal("show");
							}, 'json');

						}
					);

				} else {
					alertMessage("Ooops!!", data.observation, 'error', 'btn btn-danger');
					$('.heuree').val('');
					$('.hdebe').val('');
					$('.dateFIne').val('');
					$('.heurefine').val('');
					$('.BC_DATE').val('');
				}

			}, 'json');

		});











	   $( ".matier" ).autocomplete({
  		  source: base_url+"Planning/autocompleteSortie",
   		 	appendTo:"#infoCOmmande"
		});
		$.post(base_url+'Planning/machineModaleTable',{type:"IMPRESSION_EXTRUSION"},function(data){
		$('.DJ_MACHINEE').append("<option></option>");
       	data.forEach(element => $('.DJ_MACHINEE').append("<option>"+element+"</option>"));
			   
         },'json');  


		$('.cree').on('click',function(event){
		event.preventDefault();
		var BC_PE = $('.BC_PO').val();
        var type = $('.TYPE option:selected').val();
		chargement();   

		var  BC_PO = $('.BC_PO').val();
		var date =  $('.BC_DATE').val();
		var  matier = $('.BC_MATIER').val();
	    var DJ_MACHINEE = $('.DJ_MACHINEE option:selected').val();
		var  BC_STATUT ="IMPRESSION_EXTRUSION";

		var  hdebe = $('.hdebe').val();
		var  heuree = $('.heuree').val();
		var  dateFIne = $('.dateFIne').val();
		var  heurefine = $('.heurefine').val();
			/*qtt*/
	   $.post(base_url+"Planning/creetPurge",{BC_PO:BC_PO,type:type,BC_PE:BC_PE,date:date,DJ_MACHINEE:DJ_MACHINEE,matier:matier,BC_STATUT:BC_STATUT,hdebe:hdebe,heuree:heuree,dateFIne:dateFIne,heurefine},function(){

	   	});
		


			  $('.tbody-modaltable tr').each(function( index ){
			     var MU_DESIGNATION = $(this).children().eq(1).text(); 
			     var MU_QUANTITE = $(this).children().eq(2).find("input").val();
			     var MU_PRIX =$(this).children().eq(3).text();
			     $.post(base_url+'Planning/saveMartierPr',{type:type,BC_PE:BC_PE,MU_DESIGNATION:MU_DESIGNATION,MU_QUANTITE:MU_QUANTITE,MU_PRIX:MU_PRIX},function(){
			     	$('input').val('');
			     	$('.tbody-modaltable').empty();
			     	closeDialog();

			     }); 
			      
			  });		
				
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