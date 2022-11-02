<div class="container">
		<div class="row">	
	<fieldset class="col-md-12 border">
		<div class="row">
				
					<div class="form-group col-md-4">
						<label for="BC_PE">PO N° : </label>
						<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
					</div>
					<div class="form-group col-md-4">
						<label for="JO_ID">JOB CARD N° : </label>
						<input type="text" name="JO_ID"  disabled class="form-control form-control-sm JO_ID">
					</div>
					<div class="form-group col-md-4">
						<label for="J_N">J/N</label>
						<select id="J_N" class="form-control form-control-sm J_N">
							<option>Jour</option>
							<option>Nuit</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="DC_PRO">Proccessus</label>
						<select id="DC_PRO" class="form-control form-control-sm DC_PRO">
							<option>EXTRUSION</option>
							<option>INJECTION</option>
							<option>DECOUPE</option>
							<option>INPRESSION</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="Date">Date</label>
						<input id="Date" type="date" class="form-control form-control-sm Date">
					</div>
		
		</div>			
	</fieldset>	
	<fieldset class="col-md-12 border mt-2">
			<div class="row">  
				<div class="form-group col-md-4">
					<label for="BC_OBSERVATION">Opèrateur : </label>
				</div>	
				<div class="form-group col-md-4">
                    <div class="form-group">
						<div class="input-group mb-3">
							<input type="text" class="form-control form-control-sm chefEquipe" placeholder="Chef d'equipe" aria-label="Entre chef d'equipe" aria-describedby="basic-addon2">
					    </div>
				   </div>	
				</div>
				<div class="form-group col-md-4">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="text" class="form-control form-control-sm Operateur" placeholder="Opèrateur" aria-label="Entre Opèrateur" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<a href="#" class="input-group-text btn btn-primary text-white form-control-sm add-table" id="basic-addon2"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
					
				</div>	
				<div class="form-group col-md-12">
						<table class="w-100 table-bordered table-hover table-sm table-ficher">
							<thead class="bg-dark text-white text-center">
								<tr>
									<th>PO</th>
									<th>Job card</th>
									<th>Equipe</th>
									<th>J/N</th>
									<th>Nom et Prénom</th>
									<th></th>
								</tr>
							</thead>
							<tbody class="tbody tbody-equipe text-center">
								
							</tbody>
						</table>

				</div>			
			</div>	 
	</fieldset>
	<fieldset class="col-md-12 border mt-2">
				<div class="row">  
					<div class="form-group col-md-12">
						<label for="BC_OBSERVATION">Observation : </label>
						<textarea class="form-control BC_OBSERVATION"></textarea>
					</div>	
				</div>
	</fieldset>	
	<fieldset class="col-md-12 border mt-2">
		<div class="text-right m-3"> 
			<button type="submit" class="btn btn-success creetfiches_btn">Enregistre</button>
			<button type="reset" class="btn btn-danger">Annuler</button>
	</div>
	</fieldset>	
	</div>	
	</div>	