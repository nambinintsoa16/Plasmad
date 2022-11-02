<div class="row">
						<div class="col-sm-6 col-lg-3 btn-click-link linkx">
								<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-secondary mr-3">
										<i class="fa fa-list"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><small>HISTORIQUE MATIER PREMIER</small></b></h5>
										<small class="text-muted"></small>
									</div>
								</div>
							</div>
						</div>	
						<div class="col-sm-6 col-lg-3 btn-click-link linkx">
							<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-secondary mr-3">
										<i class="fa fa-edit"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><small>HISTORIQUE PRODUIT FINI PREMIER</small></b></h5>
										<small class="text-muted"></small>
									</div>
								</div>
							</div>
						</div>	
				
</div>			
<span class="main-matier">
	
</span>
<script>
$(document).ready(function(){

$.post(base_url+"Magasiner/page",{page:"HISTORIQUE MATIER PREMIER"},function(data){
	$('.main-matier').empty().append(data);
           $('.link').text(" / HISTORIQUE MATIER PREMIER");
});
   $('.linkx').on('click',function(e){
      e.preventDefault();
    
      var page = $(this).children().find('b').text();

     $.post(base_url+"Magasiner/page",{page:page},function(data){
           $('.main-matier').empty().append(data);
           $('.link').text(" / "+page);
           if(page=="HISTORIQUE MATIER PREMIER"){
              
           }else if(page=="HISTORIQUE PRODUIT FINI PREMIER"){
			   
		   }   
      });
   
  });


});
</script>