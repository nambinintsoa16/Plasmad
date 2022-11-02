<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>CONTROLLE QUALITE</b>
   </div>
<div class="card-body p-0">
<div class="row m-auto">
<div class="col-sm-4 col-lg-2 btn-click-qc">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-secondary mr-3">
					<i class="fa fa-edit"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>QC</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3 col-lg-3 btn-click-qc">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-success mr-3">
					<i class="fa fa-info"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>DETAIL QC</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3 col-lg-3 btn-click-qc">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-info mr-3">
					<i class="fa fa-book"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>SORTIE DEUXIEME CHOIX</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3 col-lg-3 btn-click-qc">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-danger mr-3">
					<i class="fa fa-list"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>LISTE DES SORTIES</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3 col-lg-3 btn-click-qc">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-warning mr-3">
					<i class="fa fa-database"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>ENTRE DEUXIEME CHOIX PRODUCTION</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3 col-lg-3 btn-click-qc">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-success mr-3">
					<i class="fa fa-coins"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>STOCK DEUXIEME CHOIX</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
	
</div>
<span class="main-control" >
</span>
<script>
	$(()=>{
		chargement();
		$.post(base_url + "Controle_Qualite/page", { page: "DETAIL QC" }, function(data) {
           $('.main-control').empty().append(data);
		   closeDialog();
       });
	   $('.btn-click-qc').on('click', function(e) {
        e.preventDefault();
        var page = $(this).children().find('b').text();
        	chargement();
			$.post(base_url + "Controle_Qualite/page", { page: page }, function(data) {
				$('.main-control').empty().append(data);
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
