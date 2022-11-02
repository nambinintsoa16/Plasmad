<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>RECYCLE</b>
   </div>
<div class="card-body p-0">
<div class="row m-auto">
	<div class="col-sm-4 col-lg-3 btn-click-recycle">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-success mr-3">
					<i class="fa fa-database"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>STOCK RECYCLE</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-lg-3 btn-click-recycle">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-primary mr-3">
					<i class="flaticon-next"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>ENTRE MACHINE</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-lg-3 btn-click-recycle">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-warning mr-3">
					<i class="flaticon-back"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>SORTIE MACHINE</small></b></h5>
					<small class="text-muted"></small>

				</div>
			</div>
		</div>
	</div>
	
</div>
<span class="main-surplus" >
</span>
<script>
	$(()=>{
		chargement();
		$.post(base_url + "controlleur/page", { page: "STOCK RECYCLE" }, function(data) {
           $('.main-surplus').empty().append(data);
		   closeDialog();
       });
	   $('.btn-click-recycle').on('click', function(e) {
        e.preventDefault();
        var page = $(this).children().find('b').text();
        	chargement();
			$.post(base_url + "controlleur/page", { page: page }, function(data) {
				$('.main-surplus').empty().append(data);
				closeDialog();
			})
	    })
		function chargement() {
			var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
			})


		}

		function closeDialog() {
			$('.jconfirm').remove()
		}
	});
</script>
