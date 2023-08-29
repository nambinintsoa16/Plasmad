				<div class="container">
					<fieldset class="col-md-12 border card">
						<div class="row">
							<div class="form-group col-md-3">
								<label>Date</label>
								<input type="date" class="form-control form-control-sm" name="EI_DATE">
							</div>
							<div class="form-group col-md-3">
								<label>PO</label>
								<input type="text" class="form-control form-control-sm poex" name="BC_ID">
							</div>
							<div class="form-group col-md-3">
								<label>Metrage</label>
								<input type="text" class="form-control form-control-sm" name="EI_METRAGE">
							</div>
							<div class="form-group col-md-3">
								<label>Poids(kg)</label>
								<input type="text" class="form-control form-control-sm" name="EI_POIDS">
							</div>
							<div class="form-group col-md-3">
								<label>DECHET</label>
								<input type="text" class="form-control form-control-sm" name="EI_DECHET">
							</div>
							<div class="form-group col-md-3">
								<label>DEBUT</label>
								<input type="time" class="form-control form-control-sm" name="EX_DEBUT">
							</div>

							<div class="form-group col-md-3">
								<label>FIN </label>
								<input type="time" class="form-control form-control-sm" name="EX_FIN">
							</div>
							<div class="form-group col-md-3">
								<label>Equipe</label>
								<input type="text" class="form-control form-control-sm op" name="EI_EQUIPE">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 1</label>
								<input type="text" class="form-control form-control-sm op" name="EI_OPERATEUR1">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 2</label>
								<input type="text" class="form-control form-control-sm op" name="EI_OPERATEUR2">
							</div>
							<div class="form-group col-md-3">
								<label>Quart</label>
								<select class="form-control form-control-sm" name="EI_QUART">
									<option>J</option>
									<option>N</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>N° MACHINE</label>
								<select class="form-control form-control-sm" name="EI_MACH">
									<?php foreach ($MACHINE as $key => $MACHINE) : ?>
										<option><?= $MACHINE->MA_DESIGNATION ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>Taill</label>
								<input type="text" class="form-control form-control-sm" name="EI_TAILLE">
							</div>
							<div class="form-group col-md-3">
								<label>RESTE GAINE</label>
								<input type="text" class="form-control form-control-sm" name="EI_RESTE_GAINE">
							</div>
							<div class="form-group col-md-3">
								<label>N°RLX</label>
								<input type="text" class="form-control form-control-sm" name="EI_RLX">
							</div>

							<div class="form-group col-md-12">
								<hr />
								<div class="row ">
									<div class="form-group col-md-6">
										<input type="text" class="form-control form-control-sm reference" placeholder="Réference">
									</div>
									<div class="form-group col-md-4">
										<input type="text" class="form-control form-control-sm quantite" placeholder="Quantité">
									</div>
									<div class="form-group col-md-2">
										<a href="" class="btn btn-primary btn-sm plusMatt"> <i class="fa fa-plus"></i></a>
									</div>
									<div class="form-group col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th>REFERENCE</th>
													<th>QUANTITE</th>
													<th>PU</th>
													<th></th>
												</tr>
											</thead>
											<tbody class="tbodyMatt">

											</tbody>
										</table>
									</div>
								</div>
								<hr />
							</div>
							<div class="form-group col-md-12">
								<label>Observetion</label>
								<textarea class="form-control " name="EI_OBS"></textarea>
							</div>
						</div>
					</fieldset>
				</div>
