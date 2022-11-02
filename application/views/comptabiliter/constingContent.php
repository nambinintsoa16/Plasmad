<div class="card">
	<div class="card-header bg-dark text-white">
		
		<b class="pull-right w-100">
			<form action="" method="post">
				<label>Origin : </label>
				<select class="mr-5 origin" style="width: 150px;height: 27px;" name="origin">
					<option>Plasmad</option>
					<option>Madakem</option>
					</select>
					<label>Type : </label>
					<select class="mr-5 type" style="width: 70px;height: 27px;" name="type">
						<option>PE</option>
						<option>PP</option>
						</select>

						<label>N°PO : </label>
						<input type="text" class="mr-3 numpo" name="po" placeholder="N°PO">
						<label>DEBUT : </label>
						<input type="date" class="mr-3 dateCost" name="date">
						<label>FIN : </label>
						<input type="date" class="mr-3 dateCostFin" name="findate">
						<button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
							Afficher</button>
						<a href="<?= base_url("Comptabilite/exportCostingExecel") ?>" class="btn btn-sm btn-success export">
						<i class="fas fa-file-excel"></i>&nbsp;EXPORT
					</a>
			</form>

		</b>
	</div>

	<div class="card-body">

	</div>
</div>
<div class="modal fade" id="modaleInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title" id="exampleModalLongTitle">DETAIL PRODUCTION</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body dataProd">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">FERMER</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		chargement();
		$.post(base_url + "Comptabilite/page", {
			page: "COSTING DATA"
		}, function(data) {
			$('.card-body').empty().append(data);
			closeDialog();
		});
		$('.AfficherCost').on('click', function(e) {
			e.preventDefault();
			var date = $('.dateCost').val();
			var po = $('.numpo').val();
			var type = $('.type option:selected').val();
			var fin = $('.dateCostFin').val();
			var origin =  $('.origin').val();
			$('.export').attr('href', base_url + "Comptabilite/exportCostingExecel?date=" + date + "&po=" +
				po + "&fin=" + fin + "&type=" + type+"&oriin="+origin);
			chargement();
			$.post(base_url + "Comptabilite/page", {
				date: date,
				po: po,
				type: type,
				fin: fin,
				origin:origin,
				page: "COSTING DATA"
			}, function(data) {
				$('.card-body').empty().append(data);
				$('.detailProgre').on('click', function(e) {
					e.preventDefault();
					var po = $(this).attr('id');
					$.post(base_url + 'Comptabilite/detailProduction', {
						po: po
					}, function($data) {
						$('.dataProd').empty().append($data);
						$('#modaleInfo').modal('show');
					});
				});
				closeDialog();
			});
		});
		$('.detailProgre').on('click', function(e) {
			e.preventDefault();
			var po = $(this).attr('id');
			$.post(base_url + 'Comptabilite/detailProduction', {
				po: po
			}, function($data) {
				$('.dataProd').empty().append($data);
				$('#modaleInfo').modal('show');
			});
		});
		$('.numpo').autocomplete({
			source: base_url + "Magasiner/autocompletPo",
		});

		function chargement() {
			var htmls =
				'<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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