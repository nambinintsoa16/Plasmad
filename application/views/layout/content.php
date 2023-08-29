
<div class="main-panel">
   <div class="content main">
        <?php breadcrumb($uri) ?>
        <?=$content ?? ""?>           
    </div>
</div>
<div class="modal fade" id="modal_modif_Image" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content ">
			<div class="modal-header bg-<?=$nav_color?>">
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
								<img src="<?=user_img_link($this->session->userdata('matricule'))?>" id="preview" class="img img-thumbnail" style="width: 150px; height: 150px;" /><br />
								<div class="fileUpload btn btn-primary mr-2">
									<span>Choisir images</span>
									<input id="image" type="file" class="upload" name="image" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="save_image_users">Enregistrer</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>	