<div class="card w-100">
	<div class="card-header bg-dark text-white">
		<b>SUIVI MACHINE</b>
		<b class="pull-right">
			<form action="" method="post">
				<label for="">DATE DEBUT</label>
				<input type="date" name="date" class="date">
				<label for="">DATE FIN</label>
				<input type="date" name="datedebut" class="datedebut">  
				  <a href="<?=base_url("magasiner/exportStockSortie?debut=&fin=")?>" class="btn btn-primary btn-sm exportSortie"><i class="fa fa-download"></i>&nbsp; EXPORTE</a>
				<a href="<?=base_url("magasiner/printStockSortie?debut=&fin=")?>" class="btn btn-warning btn-sm printSortie"><i class="fa fa-print"></i>&nbsp; IMPRIMER</a>
			</form>
           
		</b> 	 	
	</div>
	<div class="card-body">

<div class="row m-auto">
	<div class="col-sm-4 col-lg-2 btn-clickx">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-secondary mr-3">
					<i class="fa fa-edit"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>EXTRUSION</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-4 col-lg-2 btn-clickx">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-success mr-3">
					<i class="fa fa-money"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>IMPRESSION</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
		<div class="col-sm-4 col-lg-2 btn-clickx">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-success mr-3">
					<i class="fa fa-money"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>COUPE</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mainContent" rol="main">
</div>

	</div>
</div>

<script>
	$(document).ready(function(){
		 chargement();
		$.get(base_url+"Controlleur/pageMachine",{type:"EXTRUSION",date:""},function(data){
				$('.mainContent').empty().append(data);
				closeDialog();
          	});
          $('.btn-clickx').on('click',function(e){
          	e.preventDefault();
          	chargement();
          	var type = $(this).find('b').text();
          	var date = $('.date').val();
			var datedebut = $('.datedebut').val();
			$('.exportSortie').attr('href',base_url+"Controlleur/exportDataMachine?type="+type+"&debut="+datedebut+"&fin="+date);
			$('.printSortie').attr('href',base_url+"Controlleur/printDataMachine?type="+type+"&debut="+datedebut+"&fin="+date);
          	$.get(base_url+"Controlleur/pageMachine",{type:type,fin:datedebut,date:date},function(data){
				$('.mainContent').empty().append(data);
				closeDialog();
          	});
          });


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
			});


		}

		function closeDialog() {
			$('.jconfirm').remove();
		}
	});
</script>