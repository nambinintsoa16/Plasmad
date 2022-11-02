 <div class="card w-100">
     <div class="card-header bg-dark text-white">
         <b>PROGRESSION</b>
     </div>
     <div class="card-body">

         <fieldset class="w-100 border p-2">
             <div class="row">
                 <div class="col-sm-6 col-lg-3 btn-clickp">
                     <div class="card p-3">
                         <div class="d-flex align-items-center">
                             <span class="stamp stamp-md bg-secondary mr-3">
                                 <i class="fa fa-list"></i>
                             </span>
                             <div>
                                 <h5 class="mb-1"><b><small>LISTE DES PRODUCTIONS TERMINEES</small></b></h5>
                                 <small class="text-muted"></small>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="col-sm-6 col-lg-3 btn-clickp">
                     <div class="card p-3">
                         <div class="d-flex align-items-center">
                             <span class="stamp stamp-md bg-primary mr-3">
                                 <i class="fa fa-database"></i>
                             </span>
                             <div>
                                 <h5 class="mb-1"><b><small>PROGRESSION PO</small></b></h5>
                                 <small class="text-muted"></small>
                             </div>
                         </div>
                     </div>
                 </div>
                  <div class="col-sm-6 col-lg-3 btn-clickp">
                     <div class="card p-3">
                         <div class="d-flex align-items-center">
                             <span class="stamp stamp-md bg-success mr-3">
                                 <i class="fa fa-edit"></i>
                             </span>
                             <div>
                                 <h5 class="mb-1"><b><small>DETAIL DE LIVRAISON</small></b></h5>
                                 <small class="text-muted"></small>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </fieldset>
         <fieldset class="w-100 border p-2 mt-2">
             <div class="containt-data">
                
             </div>
         </fieldset>
     </div>
<script>
    $(document).ready(function(){
        $.post(base_url+'Planning/page',{page:"LISTE DES PRODUCTIONS TERMINEES"},function(data){
                $('.containt-data').empty().append(data);
            });
        $('.btn-clickp').on('click',function(e){
            e.preventDefault();
            var page = $(this).children().find('small').text();
            $.post(base_url+'Planning/page',{page:page},function(data){
                $('.containt-data').empty().append(data);
            });
               
        });

       

    });
</script>    
