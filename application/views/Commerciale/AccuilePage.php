<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Calendrier de livraison</a></li>
	</ol>
</nav>
<div class="card">
	<div class="card-header bg-dark text-white">
		<b>CALENDRIER DE LIVRAISON</b>
	</div>
	<div class="card-body">
		<fieldset class="col-md-12 border">

			<form method="post" action="<?= base_url("Commerciale/exportLivraison") ?>" class="w-100">
				<div class="row">
					<div class="form-group col-md-4">
						<label for="date">DATE DE LIVRAISON : </label>
						<input type="date" name="date" class="form-control form-control-sm BC_DATE">
					</div>
					<div class="form-group col-md-6 mt-3" style="margin-top: 12px;">
						<button type="submit" class="btn btn-success afficher btn-sm mt-2">AFFICHER</button>
						<button type="submit" id="<?= date('Y-m-d') ?>" class="btn btn-primary export btn-sm mt-2"><i class="fa fa-download"></i>&nbsp;EXPORTER</button>
					</div>
				</div>
			</form>
		</fieldset>
		<fieldset class="col-md-12 border mt-2">
			<div class="row">
				<div class="form-group col-md-4">
					<b>LIVRAISON DU <span class="dateConte"><?= date('d / m / Y') ?></span></b>
				</div>
				<div class="form-group col-md-12 conttable">
				</div>
			</div>
		</fieldset>
	</div>
	<div class="card-footer text-right">
	</div>
</div>
</div>
<script>
	$('document').ready(function() {
		$.post(base_url + 'Commerciale/livraison', {
			date: ''
		}, function(data) {
			$('.conttable').empty().append(data);
		});
		$('.afficher').on('click', function(e) {
			e.preventDefault();
			var date = $('.BC_DATE').val();
			$('.dateConte').text(date);
			$('.export').attr('id', date);
			$.post(base_url + 'Commerciale/livraison', {
				date: date
			}, function(data) {
				$('.conttable').empty().append(data);
			});

		});
		/*   $('.export').on('click', function(e) {
			e.preventDefault();
			var date = $(this).attr('id');
			$.post(base_url+"Commerciale/exportLivraison",{date:date},function(data){

			});
		});*/

	});
</script>