<div class="card">
<div class="card-header bg-dark text-white">
      <b>ENTREE - MAGASIN</b>
   </div>
   <div class="card-body">
<fieldset class="border p-4">
<form method="POST" action="">          
<div class="row">
<div class="form-group col-md-3">
        <label for="date-sortie">DATE D'ENTRE : </label>
        <input type="date" class="form-control form-control-sm" name="date">
    </div>  
    <div class="form-group col-md-3">
        <label for="reception">N°PO : </label>
        <input type="text" class="form-control reception form-control-sm auto" name="PO">
    </div>  
    <div class="form-group col-md-3">
        <label for="reception">Référence CLIENT : </label>
        <input type="text" disabled class="form-control reception form-control-sm client">
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">Code CLIENT : </label>
        <input type="text" disabled class="form-control reception form-control-sm Codeclient">
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">DIM : </label>
        <input type="text" disabled class="form-control reception form-control-sm dim" >
    </div> 
    <div class="form-group col-md-3">
        <label for="reception">TAILLE : </label>
        <input type="text"  class="form-control reception form-control-sm " name="taille" >
    </div> 

   <div class="form-group col-md-3">
        <label for="reference">ENTRE : </label>
        <input type="text" class="form-control reference form-control-sm" name="entre">
    </div>   
 
    <div class="form-group col-md-3 ">
        <label for="quantite">TYPE : </label>
        <select class="form-control form-control-sm typeSortie" name="type">
            <option>ENTRE</option>
            <option>RETOUR</option>
        </select>
    </div>
    <div class="form-group col-md-12">
        <label for="quantite">OBSERVATION</label>
       <textarea class="form-control" name="obs"></textarea>
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
      source : base_url + "Magasiner/autocompletPo",
      select : function(data,iteme){
         var param= iteme.item.value.trim();
			$.post(base_url+"Magasiner/recherchePE",{param:param},function(data){
				if(data.mesage=="false"){
					alertMessage("Erreur","PO Introvable","error","btn btn-danger");
				}else{
               $('.client').val(data.client); 
               $('.dim').val(data.dim);
               $('.Codeclient').val(data.code);
            
				}    
			},'json');
      }
   });
   $('form').on('submit',function(event){
    event.preventDefault();
      var formData = new FormData(this);
   $.ajax({
      type:'POST',
      url: base_url+"Magasiner/saveEntre",
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      success: (data) => {
         $('input').val('');
         $('textarea').val('');
         alertMessage("Succè!","Enregistré!","success","btn btn-success");
       },
       error:function(){
         alertMessage("Erreur","PO Introvable","error","btn btn-danger");
       }
   });
     /* $.post(,function(){
         alert();
      })*/
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

    });
</script>
