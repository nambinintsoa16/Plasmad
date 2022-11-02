<div class="card">
<div class="card-header bg-dark text-white">
      <b>SORTIE DEUXIEME CHOIX</b>
   </div>
   <div class="card-body">
<fieldset class="border p-4">
<form>          
<div class="row">
<div class="form-group col-md-3">
        <label for="date-sortie">DATE DE SORTIE : </label>
        <input type="date" class="form-control form-control-sm" name="CS_DATE">
    </div>  
    <div class="form-group col-md-3">
        <label for="reception">N°PO : </label>
        <input type="text" class="form-control reception form-control-sm auto" name="CS_PO">
    </div>  
    <div class="form-group col-md-3">
        <label for="reception">DIM : </label>
        <input type="text"  class="form-control reception form-control-sm dim" >
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">TAILLE : </label>
        <select class="form-control form-control-sm tail" name="CS_DIM">
        <select>
    </div> 
   <div class="form-group col-md-3">
        <label for="reference">SORTIE : </label>
        <input type="text" class="form-control reference form-control-sm" name="CS_QTT">
    </div>   
 
    <div class="form-group col-md-3">
        <label for="quantite">N°BL : </label>
        <input type="text" id="quantite" class="form-control quantite form-control-sm" name="CS_BL">
    </div>
    <div class="form-group col-md-12">
        <label for="quantite">OBSERVATION</label>
       <textarea class="form-control" name="CS_obs"></textarea>
    </div>
<div class="form-group col-md-12 text-right">
   <button  class="btn btn-danger  m-2">Annule</button>
   <button class="btn btn-success">Enregistré</button>
</div>   
</form>
</fieldset>  
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
               $('.dim').val(data.dim);
               $('.tail').empty();
               data.tail.forEach(element => $('.tail').append("<option>"+element+"</option>"));
				}    
			},'json');
      }
   });



   $("form").on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                var po = $('.npo').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + "Controle_Qualite/saveQC",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        swal("Succé ", "Control enregistre", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            },
                        });

                    },
                    error: function(data) {
                        swal("Erreur ", "Veuillez réessayer!", {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-danger'
                                }
                            },
                        });
                    }

                });

            });


    function alertMessage(title,message,icons,btn){
      swal(title, message, {
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

