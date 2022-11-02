<div class="col-md-12 text-right p-2">
	<fieldset class="border p-2 bg-white mb-2 text-right">
		<a href="<?= base_url("Planning\printExtrusion") ?>" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer</a>
		<a href="#" class="btn btn-primary printJobs"><i class="fa fa-print"></i> Imprimer JobCart</a>
	</fieldset>
</div>
<?php foreach ($machine as $key => $machine) : ?>
	<div class="col-md-12 p-2 bg-dark text-white">
		<span class="col-md-3"><?= $machine->MA_DESIGNATION ?> </span>
		<span class="pull-right" style="font-size:11px">
			<p class="text-right collapsed" data-toggle="collapse" data-target="#tab_<?= $machine->MA_ID ?>"> <i class="fa fa-plus " aria-expanded="false"></i></p>
		</span>
	</div>
	<div clas="row pt-2" style="padding:10px 2px;">
		<div class="col-md-12">
			<div class="d-flex justify-content-between">
				<p>


				</p>
			</div>
			<fieldset class="border p-2 bg-white mb-2 text-right">

				<button class="btn btn-success addProd"><i class="fa fa-plus"></i>&nbsp;Ajouter Production</button>
			</fieldset>
			<fieldset class="border p-2 bg-white">
				<div class="" id="tab_<?= $machine->MA_ID ?>" style="padding: 0px;">
					<?php
					$this->load->model('Production_model');
					$data = "";
					$param = "";
					$param = [
						"BC_MACHINE" => $machine->MA_DESIGNATION,
						"BC_PROCCESSUS" => "IMPRESSION_INJECTION",
						"BC_STATUT" => "PLANNIFIE"
					];
					$data = ["data" => $this->production_model->bondeCommandes($param), "Vitesse" => $machine->MA_VITESSE];
					$this->load->view('Planning\tableleEXtrusion', $data); ?>
				</div>
			</fieldset>
		</div>
	</div>
	</div>
	</div>
	</div>
<?php endforeach; ?>


<div class="modal fade editData" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="col-md-12 border">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="BC_PE">PO N° : </label>
							<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
						</div>
						<div class="form-group col-md-6">
							<label for="JO_ID">JOB CARD N° : </label>
							<input type="text" name="JO_ID" disabled class="form-control form-control-sm JO_ID">
						</div>

						<div class="form-group col-md-4">
							<label for="date_prod">DATE DE PRODUCTION</label>
							<input type="date" id="date_prod" name="date_prod" class="form-control form-control-sm date_prod">
						</div>
						<div class="form-group col-md-4">
							<label for="DJ_MACHINE">PROCESSUS</label>
							<select class="form-control BC_STATUT form-control-sm" name="BC_STATUT">
							<option value="HOOK">IMPRESSION</option>	
							<option value="HOOK">HOOK</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="DJ_MACHINE">MACHINE</label>
							<input type="text" class="form-control DJ_MACHINE form-control-sm DJ_MACHINE" name="DJ_MACHINE">


						</div>
					</div>
				</fieldset>
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success UpdateExtrusion">ENREGISTRE</button>
				<button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

		$('.editProcessus').on('click', function(event) {
			event.preventDefault();
			var BC_PE = $(this).parent().parent().children().eq(1).text().trim();
			var JO_ID = $(this).parent().parent().children().eq(2).text().trim();

			$('.BC_PE').val(BC_PE);
			$('.JO_ID').val(JO_ID);
			$(".editData").modal("show");
		});

		$('.addProd').on('click', function(e) {
			e.preventDefault();
			$('.editData').modal('show');
		})
		$(".dataTable").dataTable();
	});
</script>