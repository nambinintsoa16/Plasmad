<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>SORTIE</b>
   </div>
<div class="card-body">
        <div class="row">

         <div class="form-group col-md-12"> 
            <div class="alert alert-danger contentInfo"  role="alert w-100">
               <ol class="activity-feed "></ol>
            </div>
         </div>    
        <fieldset class="col-md-12 border w-100">
            <div class="row">
               <div class="form-group col-md-4 text-right">
                     <input type="text" name="PO" class="form-control form-control-sm machine pull-right  w-100" placeholder="Machine">
                  </div>
                  <div class="form-group col-md-4 text-right">
                     <input type="text" name="PO" class="form-control form-control-sm recherchePos pull-right  w-100" placeholder="Entrée PO">
                  </div>
                  <div class="form-group col-md-2 text-right">
                     <a href="#" class="btn btn-info btn-sm modalInfo w-20"><i class="fas fa-info"></i>&nbsp;Détail PO</a>
                     <a href="#" class="btn btn-primary btn-sm recherchePosBtn w-80"><i class="fas fa-desktop"></i>&nbsp;Afficher</a>
                  </div>
            </div>      
	    </fieldset>
   
         
      <fieldset class="col-md-12 border mt-2 w-100 p-3">
    
        <div class="row w-100 border m-0 ">  
			<div class="form-group col-md-4">
				<input type="text" class="form-control form-control-sm stock_sortie " placeholder="Entre désignation" >  
			</div>	
			<div class="form-group col-md-4">
				<input type="number" class="form-control form-control-sm Quantite" placeholder="Quantite" aria-label="Entre désignation" aria-describedby="basic-addon2">	
			</div>
         <div class="form-group col-md-4">  
            <a href="#" class="btn btn-primary text-white form-control-sm add-table w-25" ><i class="fa fa-plus"></i></a> 
            <a href="#" class="btn btn-success text-white form-control-sm savesortie" ><i class="fa fa-save"></i>&nbsp;ENREGISTRE</a>
         </div>
			</div>
        
            <table class=" table-sm table-bordered table-hover table-strepted  w-100 ">
               <thead class="bg-dark text-white">
                  <tr>
                     <th>MACHINE</th> 
                     <th>RECEPTIONNAIRE</th>							
                     <th>ARTICLE </th>
                     <th>QUANTITE</th>
                     <th>SAC</th>
                     <th>PIX</th>
                     <th></th>
                    
		            </tr>
	            </thead>
	            <tbody class="tableSortie">
                    
	            </tbody>
            </table>
      </fieldset> 
        </div>     
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
										<input type="text" name="date" disabled class="form-control form-control-sm date">
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
										<input type="text" name="BC_REASSORT" disabled class="form-control form-control-sm BC_REASSORT ">
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
										<input type="text" name="BC_SOUFFLET" disabled class="form-control form-control-sm BC_SOUFFLET">
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
										<input type="text" name="BC_QUNTITE" disabled class="form-control form-control-sm BC_QUNTITE">
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
								<textarea disabled class="form-control BC_OBSERVATION"></textarea>
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
   $( ".stock_sortie" ).autocomplete({
    source: base_url+"Planning/autocompleteSortie",
    
});
$('.add-table').on('click',function(e){
  e.preventDefault(); 
  var rep = $('.recherchePos').val();
  var machine = $('.machine').val();
  if (rep ==""){
   alertMessage("Ooops!!","PO introvable",'error','btn btn-danger');

  }else{
  if($('.stock_sortie').val()!="" && $('.Quantite').val()!=""){
  var data =$('.stock_sortie').val().split("|");
  
  var i =  1;
  if (typeof($('.tableSortie > tr').html()) == 'undefined') { 
         $('.tableSortie').append('<tr><td>'+machine+'</td><td>'+rep+'</td><td>'+data[0].trim()+'</td>'+
         '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="'+ $('.Quantite').val()+
         '"></td><td>'+i+
         '</td><td class="text-center">'+data[1].trim()+'</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>'+
         '</td></tr>');
         $('.stock_sortie').val("");
        $('.Quantite').val("");
        deleteTd();
        
  }else{
     var table =[];
     $('.tableSortie > tr').each(function(){
         table.push($(this).children().eq(1).text());   
     });  
   
       if ($.inArray(data, table) != -1) {
        alertMessage("Ooops!!","Ce materiel existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre materiel.",'error','btn btn-danger');
       } else {
         i++;
         $('.tableSortie').append('<tr><td>'+machine+'</td><td>'+rep+'</td><td>'+data[0].trim()+'</td>'+
         '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="'+ $('.Quantite').val()+
         '"></td><td>'+i+
         '</td><td class="text-center">'+data[1].trim()+'</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>'+
         '</td></tr>');
         $('.stock_sortie').val("");
         $('.Quantite').val("");
         deleteTd();
         
       }

   }
  }else{
   alertMessage("Ooops!!","Champs designation et Champs Quantite obligatoire",'error','btn btn-danger');
  }
}
});  

function deleteTd(){
   $('tbody .delete-td').on('click',function(e){
      e.preventDefault();
      $(this).parent().parent().remove();
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

$('.savesortie').on('click',function(e){
e.preventDefault();
var i = 0;
$('.tableSortie > tr').each(function(){
    i++;  
 });

let machine = $('.machine').val();
let po = $('.recherchePos').val();
 
$.post(base_url+"Magasiner/SauveSortieMatierAValider",{machine,po},function(){
 $('.tableSortie > tr').each(function(){
    i--;
   var produitForn = $(this).children().eq(2).text();
    var receptQuantite = $(this).children().eq(3).find('input').val();
    var prix =  $(this).children().eq(5).text();
    var reference = $(this).children().eq(1).text();
    
   $.post(base_url+"Magasiner/saveDetailValideSortie",{po,produitForn,receptQuantite,prix,reference},function(){
        if(i==0){
         alertMessage("","Sortie enregistre avec succée",'success','btn btn-success');
          $('.tableSortie').empty();
          $('input').val('');
        }
   }); 
 }); 

 });
       
});



$('.machine').autocomplete({
   source :"Magasiner/machine"

});



$('.modalInfo').on('click', function(event) {
					event.preventDefault();
					var pe = $(".recherchePos").val();
					$.post(base_url + "magasiner/detailBon", {
						pe: pe
					}, function(data) {
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
					}, "json");
				});
});
</script>