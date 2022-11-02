</div>
<div class="modal fade modalImage" id="modale-info" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="container p-2" style="background:#F7F3F3;">
						<div class="row">
							<div class="form-group m-auto col-md-5">
								<img src="<?=user($this->session->userdata('matricule'))?>" id="preview" class="img img-thumbnail" style="width: 150px; height: 150px;" /><br />
								<div class="fileUpload btn btn-primary mr-2">
									<span>Choisir images</span>
									<input id="image" type="file" class="upload" name="image" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success saveImage">Enregistrer</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>

	<script>
		const base_url = "<?= base_url() ?>";
	</script>


	<script src="<?= base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?= base_url() ?>assets/js/jquery-confirm.min.js"></script>


	<script src="<?= base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/chart.js/chart.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/chart-circle/circles.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/fullcalendar/main.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/fullcalendar/main.min.js"></script>
	<script src="<?= base_url() ?>assets/js/plugin/fullcalendar/locales-all.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/ckeditor/ckeditor.js"></script>
	<script src="<?= base_url() ?>assets/js/atlantis.min.js"></script>
	<script src="<?= base_url() ?>assets/js/setting-demo.js"></script>

	<script src="<?= base_url("assets/js/main/global.js") ?>"></script>
	<?php if (file_exists("assets/js/main/" . $type_user . ".js")) : ?>
		<script src=<?= base_url("assets/js/main/" . $type_user . ".js") ?>></script>
	<?php
	else :
	// if (!file_exists("assets/js/$type_user/". $uri[2] .".js")) {
	// write_file("assets/js/$type_user/". $uri[2] .".js", "");
	// }
	endif; ?>
	<?php
	if (isset($uri[2])) :

		if (file_exists("assets/js/main/" . $type_user . "/" . $uri[2] . ".js")) : ?>
			<script src="<?= base_url("assets/js/main/" . $type_user . "/" . $uri[2] . ".js") ?>"></script>
	<?php endif;
	endif; ?>
	<?php
	if (isset($uri[3])) :
		// if (!file_exists("assets/js/$type_user/". $uri[2] ."_". $uri[3] .".js")) {
		// 	write_file("assets/js/$type_user/". $uri[2] ."_". $uri[3] .".js", "");
		// }
	?>
		<script>
			<?php

			//include "assets/js/$type_user/" . $uri[2] . "_" . $uri[3] . ".js";
			?>

			setTimeout(function() {
				console.clear();
			}, 200);
		</script>
	<?php

	endif;
	?>


	</body>
	</body>

	</html>