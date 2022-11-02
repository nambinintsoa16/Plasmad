<?php 
$this->load->model('Production_model');
$heure = explode("-",$data->EI_HEURE);
?>
<div class="container">
					<fieldset class="col-md-12 border card">
						<div class="row">
							<div class="form-group col-md-3">
								<label>Date</label>
								<input type="date" class="form-control form-control-sm" name="EI_DATE" value="<?=$data->EI_DATE?>">
							</div>
							<div class="form-group col-md-3">
								<label>ID</label>
								<input type="text" class="form-control form-control-sm poex" name="BC_ID"  value="<?=$data->EI_ID?>">
							</div>
							<div class="form-group col-md-3">
								<label>Metrage</label>
								<input type="text" class="form-control form-control-sm" name="EI_METRAGE" value="<?=$data->EI_METRAGE?>">
							</div>
							<div class="form-group col-md-3">
								<label>Poids(kg)</label>
								<input type="text" class="form-control form-control-sm" name="EI_POIDS" value="<?=$data->EI_POIDS?>">
							</div>
							<div class="form-group col-md-3">
								<label>DECHET</label>
								<input type="text" class="form-control form-control-sm" name="EI_DECHET" value="<?=$data->EI_DECHET?>">
							</div>
							<div class="form-group col-md-3">
								<label>DEBUT</label>
								<input type="time" class="form-control form-control-sm" name="EX_DEBUT"  value="<?=$this->production_model->se_to_time($heure[0])?>">
							</div>

							<div class="form-group col-md-3">
								<label>FIN </label>
								<input type="time" class="form-control form-control-sm" name="EX_FIN"  value="<?=$this->production_model->se_to_time($heure[1])?>">
							</div>
							<div class="form-group col-md-3">
								<label>Equipe</label>
								<input type="text" class="form-control form-control-sm op" name="EI_EQUIPE"  value="<?=$data->EI_EQUIPE?>">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 1</label>
								<input type="text" class="form-control form-control-sm op" name="EI_OPERATEUR1"  value="<?=$data->EI_OPERATEUR1?>">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 2</label>
								<input type="text" class="form-control form-control-sm op" name="EI_OPERATEUR2" value="<?=$data->EI_OPERATEUR2?>">
							</div>
							<div class="form-group col-md-3">
								<label>Quart</label>
								<select class="form-control form-control-sm" name="EI_QUART">
								<?php if($data->EI_QUART == "J" ):?>
										<option selected>J</option>
										<option>N</option>
										<?php else: ?>
											<option selected>N</option>
											<option>J</option>
									<?php endif;?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>N° MACHINE</label>
								<select class="form-control form-control-sm" name="EI_MACH">
									<?php foreach ($MACHINE as $key => $MACHINE) : ?>
									    <?php if($MACHINE->MA_DESIGNATION == $data->EI_MACH ):?>
										<option selected><?= $MACHINE->MA_DESIGNATION ?></option>
										<?php else: ?>
											<option ><?= $MACHINE->MA_DESIGNATION ?></option>
										<?php endif;?>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>Taill</label>
								<input type="text" class="form-control form-control-sm" name="EI_TAILLE" value="<?=$data->EI_TAILLE?>">
							</div>
							<div class="form-group col-md-3">
								<label>RESTE GAINE</label>
								<input type="text" class="form-control form-control-sm" name="EI_RESTE_GAINE"  value="<?=$data->EI_RESTE_GAINE?>">
							</div>
							<div class="form-group col-md-3">
								<label>N°RLX</label>
								<input type="text" class="form-control form-control-sm" name="EI_RLX"  value="<?=$data->EI_RLX?>">
							</div>

							<div class="form-group col-md-12">
								<hr />
								
				
							</div>
							<div class="form-group col-md-12">
								<label>Observetion</label>
								<textarea class="form-control" name="EI_OBS"><?=$data->EI_OBS?></textarea>
							</div>
						</div>
					</fieldset>
				</div>
				<script>
					$(document).ready(function() {
						$('.plusMatt').on('click',function(event){
							event.preventDefault();
							var reference = $('.reference').val().split(" | ");
							var quantite = $('.quantite').val();
                           $('.tbodyMatt').append('<tr><td>'+reference[0]+'</td><td>'+quantite+'</td><td>'+reference[1]+'</td><td><a href="#" class="btn btn-danger btn-sm deleteBt"><i class="fa fa-trash"></i></a></td></tr>');
                           deleteBt();
						});
						function deleteBt(){
						$('.deleteBt').on('click',function(event){
							event.preventDefault();
							$(this).parent().parent().remove();

						});
					}
					$('.reference').autocomplete({
                        source:base_url+"Production/autocompleteMatier",
						appendTo:"#modalProccess",
						
					});


					});
				</script>
