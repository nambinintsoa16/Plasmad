<fieldset class="col-md-12 border bg-white">
			<form method="post" action="<?= base_url("Commercial/export_date_livraison") ?>" class="w-100">
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
		<fieldset class="col-md-12 border mt-2 bg-white">
			<div class="row">
				<div class="form-group col-md-4">
					<b>LIVRAISON DU <span class="dateConte"><?= date('d / m / Y') ?></span></b>
				</div>
				<div class="form-group col-md-12 conttable">
				</div>
			</div>
		</fieldset>
	</div>