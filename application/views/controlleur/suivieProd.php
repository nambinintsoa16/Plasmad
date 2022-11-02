<div class="card w-100">
	<div class="card-header bg-dark text-white">
		<b class="pull-right">
			<form action="" method="post">
				<label>N°PO : </label>
				<input type="text" class="mr-3 numpo" name="po" placeholder="N°PO">
				<label>DEBUT : </label>
				<input type="date" class="mr-3 date" name="date">
				<label>FIN : </label>
				<input type="date" class="mr-3 dateFin" name="findate">
				<button type="submit" class="btn btn-sm btn-primary Afficher"><i class="fa fa-tv"></i>
					Afficher</button>
				<a href="<?=base_url("Comptabilite/exportCostingExecel")?>"
					class="btn btn-sm btn-success export">EXPORT</a>
			</form>

		</b>
	</div>
	<div class="card-body">
		<h3><b>DAILY PRODUCTION FOLLOW UP 1 RECONCILIATION REPORT</b></h3>
		<span class="content-reponse">

		</span>
	</div>
</div>
<script>
	$(document).ready(function() {
		chargement();
		$.post(base_url + "Controlleur/page", {
			page: "dataRepotFollow"
		}, function(data) {
			$('.content-reponse').empty().append(data);
			closeDialog();
		});
		$('.Afficher').on('click', function(e) {
			e.preventDefault();
			chargement();
			$.post(base_url + "Controlleur/page", {
				page: "dataRepotFollow"
			}, function(data) {
				closeDialog();
				$('.content-reponse').empty().append(data);
			});
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
