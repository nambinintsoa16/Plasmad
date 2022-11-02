
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LISTE DES MATIERES PREMIERES</b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border w-100">
	<form class="form w-100 col-12" method="POST">
<div class="row">
		<div class="form-group col-md-5 text-right">
			<input type="file" name="file" class="form-control file">
		</div>
		<div class="form-group col-md-2 text-right">
			<button type="submit" class="btn btn-success">
				<i class="flaticon-inbox"></i>&nbsp;IMPORTER</button>
		</div>
		<div class="form-group col-md-2 text-right">
			<a href="<?=base_url('Magasiner/exportStock')?>" class="btn btn-primary exportdata">
			<i class="fas fa-file-excel"></i>&nbsp;
			EXPORT STOCK</a>
		</div>
		<div class="form-group col-md-2 text-right">
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
<i class="flaticon-add"></i>&nbsp;
NOUVELLE MATIERE
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">Nouveau matiere premier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-left">
				 <div class="form-control col-md-12">
					        <label>DESIGNATION</label>
							<input type="text" class="form-control designationMat">
					   </div>
					   <div class="form-control col-md-12">
					        <label>PRIX UNITAIRE USD</label>
							<input type="text" class="form-control prixUSDX">
					   </div>
					   <div class="form-control col-md-12">
					        <label>PRIX UNITAIRE ARIARY</label>
							<input type="text" class="form-control prixAriaryX">
					   </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success saveMatier"><i class="fa fa-save"></i>&nbsp;ENREGISTRE</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;ANNULER</button>
			</div>
		</div>
	</div>
</div>
		</div>
</div>		
   </form>	
</fieldset> 
<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<table class=" table-sm table-bordered table-hover table-strepted dataTable w-100">
	<thead class="bg-dark text-white">
		<tr>
		
			<th>Désignation</th>
			<th>En stock</th>
			<th>Prix Unitaire en USD</th>
			<th>Prix Unitaire en ariary</th>
			<th class="text-center"></th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
	
</table>
</fieldset> 
</div>
</div>
</div>
<div class="modal fade bd-example-modal-lg modifimatier" id="infoCOmmandes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header bg-dark text-white">
					<b> MODIFIER MATIER </b>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="card-body">
					<div class="form">
					  <div class="row">
					   <div class="form-control col-md-12">
					        <label>DESIGNATION</label>
							<input type="text" class="form-control designation">
					   </div>
					   <div class="form-control col-md-12">
					        <label>PRIX UNITAIRE USD</label>
							<input type="text" class="form-control prixUSD">
					   </div>
					   <div class="form-control col-md-12">
					        <label>PRIX UNITAIRE ARIARY</label>
							<input type="text" class="form-control prixAriary">
					   </div>
					  </div>
					</div>	
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-success validerModif"><i class="fa fa-edit"></i>&nbsp;MODIFIER</button>
						<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;ANNULER</button>
					</div>
					</form>
				</div>
			</div>
<script>

</script>			