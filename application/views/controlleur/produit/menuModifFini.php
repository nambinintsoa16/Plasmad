<span class="main" rol="main">
</span>
<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>MODIFIER PRODUITS FINIS</b>
   </div>
<div class="card-body p-0">

    <div class="row">
        <div class="col-md-4 m-4">
            <input type="text" class="form-control form-control-sm npo" placeholder="N°PO">
        </div>
        <div class="col-md-4 m-4">
            <button class="btn btn-success btn-sm afficherResult"><i class="fa fa-tv"></i>&nbsp;Afficher</button>
        </div>
        <div class="col-md-12 ">
            <table class="table table-hover dataTableTransi">
                <thead class="bg-dark text-white">
                    <tr>
                      <th>ID</th>
                      <th>DATE</th>
                      <th>TAILLE</th>
                      <th>QUANTITE</th>
                      <th>TYPE</th>
                      <th>ORIGINE</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody class="body_content"></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>


<script>
$(document).ready(function(){
    $('.npo').autocomplete({
            source : base_url + "Production/autocompletPo",
        });
  $('.afficherResult').on('click',function(e){
      e.preventDefault();
      var param = $('.npo').val(); 
      $.post(base_url+"Magasiner/transaction",{param:param},function($datas){
          $('.body_content').empty().append($datas);
          deleteTrans();  
       });
    
  });

  function   deleteTrans(){
        $('.supprimerEntre').on('click',function(e){
            e.preventDefault();
            var id = $(this).attr('href');
            var type =  $(this).attr('id');
            $.post(base_url+'Magasiner/deleteTransaction',{id:id,type:type},function(){
                 
            });

        });
  }
});
</script>