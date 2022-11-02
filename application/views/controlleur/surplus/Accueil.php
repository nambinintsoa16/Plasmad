<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>STOCKS SURPLUS</b>
   </div>
<div class="card-body p-0">
<div class="row m-auto">
	<div class="col-sm-4 col-lg-3 btn-click-plus">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-success mr-3">
					<i class="flaticon-database"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>STOCK PRODUIT FINI</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-4 col-lg-3 btn-click-plus">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-primary mr-3">
					<i class="flaticon-back"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>LISTE DES SORTIES</small></b></h5>
					<small class="text-muted"></small>

				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-4 col-lg-3 btn-click-plus">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-warning mr-3">
					<i class="flaticon-next"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>LISTE DES ENTRES</small></b></h5>
					<small class="text-muted"></small>

				</div>
			</div>
		</div>
	</div>


		<div class="col-sm-4 col-lg-3 btn-click-plus">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-info mr-3">
					<i class="flaticon-next"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>LISTE DES RETOURS</small></b></h5>
					<small class="text-muted"></small>

				</div>
			</div>
		</div>
	</div>
	
</div>
<div class="main-surplus" rol="main">
</div>
<script type="text/javascript">
	$(()=>{
         
         $.post(base_url+'Stock/page',{page:"STOCK PRODUIT FINI"},function(data){
         	 $('.main-surplus').empty().append(data)
         })
        $('.btn-click-plus').on('click',function(e){
        	e.preventDefault()
        	let page = $(this).children().find('b').text()
        	$.post(base_url+'Stock/page',{page},function(data){
        		  $('.main-surplus').empty().append(data)
        	})

        })  

	})
</script>
