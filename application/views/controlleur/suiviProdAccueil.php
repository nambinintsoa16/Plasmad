<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>SUIVI PRODUCTION</b>
   </div>
<div class="card-body">
<div class="row">
    <div class="col-sm-6 col-lg-3 btn-click-links">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-success mr-3">
                    <i class="fa fa-coins"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><small>DONNE DE PRODUCTION</small></b></h5>
                    <small class="text-muted"></small>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-lg-4 btn-click-links">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-secondary mr-3">
                    <i class="fas fa-list"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><small>DAILY PRODUCTION FOLLOW UP</small></b></h5>
                    <small class="text-muted"></small>
                </div>
            </div>
        </div>
    </div>

	<div class="col-sm-6 col-lg-3 btn-click-links">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-secondary mr-3">
                    <i class="fas fa-list"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><small>STATUT PO</small></b></h5>
                    <small class="text-muted"></small>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-lg-3 btn-click-links">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-secondary mr-3">
                    <i class="fas fa-list"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><small>ENCRES ET SOLVANTS</small></b></h5>
                    <small class="text-muted"></small>
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="height: 6px;">
<span class="mainProdact p-0 w-100 m-0">

</span></div>
</div>
<script>
$(document).ready(function(){
    $.post(base_url+'controlleur/page',{page:"DONNE DE PRODUCTION"},function(data){
           $('.mainProdact').empty().append(data);
    });
    $('.btn-click-links').on('click',function(e){
        e.preventDefault();
        var page = $(this).find('b').text();
        $.post(base_url+'controlleur/page',{page:page},function(data){
           $('.mainProdact').empty().append(data);
    });

    });
});
</script>
