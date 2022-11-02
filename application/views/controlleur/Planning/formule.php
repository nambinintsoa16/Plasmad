<div class="card w-100">
   <div class="card-header bg-dark text-white">
   <b>FORMULE</b>
   </div>
<div class="card-body">
<div class="alert danger">
        width ,
        length ,
        thickness ,
        Flap ,
        Gusset ,
        Order ,
        marge ,
        total , 
        prix 
 </div>       
            <form class="form" action="Administrateur/parametrePrixSaves" method="post">
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" name="FOR_DESIGNATION" id="" class="form-control FOR_DESIGNATION" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                        <textarea class="form-control w-100" name="FOR_TEXT"  rows="10"></textarea>
                </div>
                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-success">ENREGISTRE</button>
                </div>
        </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){

$('.FOR_DESIGNATION').autocomplete({
       source:base_url+"Administrateur/autocompleteFormule"
});
  $('form').on('submit',function(event){
        event.preventDefault();
         var $this=$(this); 
         var formData = new FormData(this);
        /* $.post(base_url+'Administrateur/caltculPrix',{param:formData},function(data){
             console.log(data);
         });*/
            var link = $('.form').attr('action');
            $.ajax({
                type:'POST',
                url:base_url+link,
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                this.reset();
                  $('.content-table').empty().append(data);
                },
                error: function(data){
                    swal("Erreur ", "Veuillez réessayer!", {
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

});
</script>