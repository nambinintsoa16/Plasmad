
<div class="card w-100">
     <div class="card-header bg-dark text-white">
         <b>RECONCIALIATION</b>
     </div>
     <div class="card-body">
     <fieldset class="w-100 border p-2">
             <div class="row">
                 <div class="col-sm-6 col-lg-3 btn-clickp">
                     <div class="card p-3">
                         <div class="d-flex align-items-center">
                             <span class="stamp stamp-md bg-secondary mr-3">
                                 <i class="fa fa-edit"></i>
                             </span>
                             <div>
                                 <h5 class="mb-1"><b><small>SUIVI PROGRESSION</small></b></h5>
                                 <small class="text-muted"></small>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="col-sm-6 col-lg-3 btn-clickp">
                     <div class="card p-3">
                         <div class="d-flex align-items-center">
                             <span class="stamp stamp-md bg-info mr-3">
                                 <i class="fa fa-database"></i>
                             </span>
                             <div>
                                 <h5 class="mb-1"><b><small>RECAP MACHINE</small></b></h5>
                                 <small class="text-muted"></small>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="col-sm-6 col-lg-3 btn-clickp">
                     <div class="card p-3">
                         <div class="d-flex align-items-center">
                             <span class="stamp stamp-md bg-success mr-3">
                                 <i class="fa fa-truck"></i>
                             </span>
                             <div>
                                 <h5 class="mb-1"><b><small>CALENDRIER DE LIVRAISON</small></b></h5>
                                 <small class="text-muted"></small>
                             </div>
                         </div>
                     </div>
                 </div>


                 <div class="col-sm-6 col-lg-3 btn-clickp">
                     <div class="card p-3">
                         <div class="d-flex align-items-center">
                             <span class="stamp stamp-md bg-primary mr-3">
                                 <i class="fa fa-list"></i>
                             </span>
                             <div>
                                 <h5 class="mb-1"><b><small>HISTORIQUE DE LIVRAISON</small></b></h5>
                                 <small class="text-muted"></small>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </fieldset>
         <fieldset class="w-100 border p-2 mt-2">
             <div class="containt-datas">
                
             </div>
         </fieldset>
     </div>
</div>     
<script>
$(document).ready(function(){
$('.btn-clickp').on('click',function(e){
    e.preventDefault();
    var $this = $(this);
    var page = $this.children().find('b').text();
    $.post(base_url+"Planning/page",{page:page},function(data){
           $('.containt-datas').empty().append(data);
    });
});
$.post(base_url+"Planning/page",{page:"SUIVI PROGRESSION"},function(data){
           $('.containt-datas').empty().append(data);
    });
});
</script>