
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LIVRAISON</b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<form method="post" action="">
	<div class="row">
	  <div class="form-group col-md-4">
        <input type="text" class="form-control reception form-control-sm auto" name="PO" placeholder="N°PO :">
	  </div>
	</div>  
</fieldset> 

<fieldset class="col-md-12 border mt-2 w-100 pt-3">
	<div class="row">
	    <div class="form-group col-md-3">
	    <label for="reception">CODE CLIENT : </label>
        <input type="text" class="form-control reception form-control-sm code">
        </div>  
    <div class="form-group col-md-3">
        <label for="reception">CLIENT : </label>
        <input type="text" class="form-control reception form-control-sm client">
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">DIM : </label>
        <input type="text"  class="form-control reception form-control-sm dim" >
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">QUANTITE : </label>
        <input type="text"  class="form-control reception form-control-sm quantite" >
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">LIVREE : </label>
        <input type="text"  class="form-control reception form-control-sm livre" >
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">RESTE A LIVRE : </label>
        <input type="text"  class="form-control reception form-control-sm reste" >
    </div> 
	</div>  
</fieldset> 

<fieldset class="border p-4">   
<div class="row">
    <div class="form-group col-md-4">
        <label for="date-sortie">DATE DE SORTIE : </label>
        <input type="date" class="form-control form-control-sm date_entre" name="date_entre">
    </div>  
   
    <div class="form-group col-md-4">
        <label for="reception">TAILLE : </label>
        <select class="form-control form-control-sm tail" name="tail"> 
        <select>
    </div> 

   <div class="form-group col-md-4">
        <label for="reference">SORTIE : </label>
        <input type="text" class="form-control sortie form-control-sm" name="sortie">
    </div>   
    <div class="form-group col-md-4">
        <label for="surplus">N° PO SURPLUS : </label>
        <input type="text" id="surplus" class="form-control surplus form-control-sm" name="BL">
    </div>
    
    <div class="form-group col-md-4">
        <label for="reception">TAILLE SURPLUS : </label>
        <select class="form-control form-control-sm tailSuplus" name="tailSuplus"> 
        <select>
    </div> 
    <div class="form-group col-md-4">
        <label for="quantite">QUANTITE SURPLUS : </label>
        <input type="text" id="quantite" class="form-control quantitesuplus form-control-sm" name="BL"> 
    </div>
     <div class="form-group col-md-4">
        <label for="quantite">N°BL : </label>
        <input type="text" id="quantite" class="form-control form-control-sm BL" name="BL">
    </div>
    <div class="form-group col-md-12">
        <label for="quantite">OBSERVATION</label>
       <textarea class="form-control obs" name="obs"></textarea>
    </div>
<div class="form-group col-md-12 text-right">
   <button  class="btn btn-danger  m-2">Annulé</button>
   <button type="submit" class="btn btn-success savesortie">Enregistré</button>
</div>   

<div class="form-group col-md-12">
<fieldset class="border p-2">
   <label for="">Sortie surplus</label> 
   <table class="table table-border table-stripted table-hover w-100">
	    <thead class="bg-dark text-white">
			<tr>
			    <th>DATE</th>
				<th>PERSONNEL</th>
				<th>PO</th>
				<th>QUANTITE</th>
				
			</tr>
		</thead>
		<tbody class="dataSortie">

		</tbody>
   </table>
   </fieldset>
</div>  
</form>
</fieldset>  
</div>
</div>
</div>
<script>
	$(document).ready(function(){
	$('.auto').autocomplete({
      source : base_url + "Magasiner/autocompletSortie",
      select : function(data,iteme){
      var param= iteme.item.value.trim();
			$.post(base_url+"Magasiner/recherchePESort",{param:param},function(data){
				if(data.mesage=="false"){
					alertMessage("Erreur","PO Introvable","error","btn btn-danger");
				}else{
	               $('.client').val(data.client); 
	               $('.dim').val(data.dim);
	               $('.code').val(data.code);
	               $('.tail').empty();
                   $('.quantite').val(data.quantite);
                   $('.reste').val(data.reste);
                   $('.livre').val(data.sortie);
	               data.tail.forEach(element => $('.tail').append("<option>"+element+"</option>"));    
				   $('.dataSortie').empty().append(data.sortiedata);
				}	
			},'json');
      }
   });

   $('.surplus').autocomplete({
      source : base_url + "Magasiner/autocompletsurplus",
      select : function(data,iteme){
      var param= iteme.item.value.trim();
      $.post(base_url+"Magasiner/recherchePESort",{param:param},function(data){
        if(data.mesage=="false"){
          alertMessage("Erreur","PO Introvable","error","btn btn-danger");
        }else{
                 
                 $('.tailSuplus').empty();
                 data.tail.forEach(element => $('.tailSuplus').append("<option>"+element+"</option>"));
          }    
      },'json');
      }
     });
     $('.savesortie').on('click',function(event){
      event.preventDefault();
      var PO = $('.auto').val();
      var sortie =$('.sortie').val();
      var tail=$('.tail option:selected').val();
      var date_entre=$('.date_entre').val();
      var BL =$('.BL').val();
      var obs = $('.obs').val();
      var surplus = $('.surplus').val();
      var tailSuplus=$('.tailSuplus option:selected').val();
      var quantitesuplus = $('.quantitesuplus').val();
   if(date_entre==""){
      alertMessage("","Date de sortie obligatoire","error","btn btn-danger");
   }else if(sortie=="" && quantitesuplus==""){   
      alertMessage("","Quantité à sortir obligatoire","error","btn btn-danger");
   }else if(BL==""){   
      alertMessage("","N° BL obligatoire","error","btn btn-danger");
   }else{ 

    if(sortie!=""){
      $.post(base_url+"Magasiner/savesortie",{PO:PO,tail:tail,sortie:sortie,date_entre:date_entre,BL:BL,obs:obs},function(){
        if(quantitesuplus !=""){
            $.post(base_url+'Magasiner/echangeStockFini',{tail:tailSuplus,POS:PO,sortie:quantitesuplus,PO:surplus,date_entre:date_entre,BL:BL,obs:obs},function(){
                    alertMessage("Succè!","Enregistré!","success","btn btn-success");
                    $('input').val('');
                });
            }else{
                alertMessage("Succè!","Enregistré!","success","btn btn-success");
                $('input').val('');
        }
          
      });
    }else{
      if(quantitesuplus !=""){
            $.post(base_url+'Magasiner/echangeStockFini',{tail:tailSuplus,POS:PO,sortie:quantitesuplus,PO:surplus,date_entre:date_entre,BL:BL,obs:obs},function(){
                    alertMessage("Succè!","Enregistré!","success","btn btn-success");
                    $('input').val('');
                });
            }else{
                alertMessage("Succè!","Enregistré!","success","btn btn-success");
                $('input').val('');
        }

      }
    }


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
