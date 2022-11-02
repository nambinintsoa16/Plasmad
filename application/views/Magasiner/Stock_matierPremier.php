
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
			<button type="submit" class="btn btn-danger"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp;IMPORTER</button>
		</div>
		<div class="form-group col-md-2 text-right">
			
			<a href="<?=base_url('Magasiner/exportStock')?>" class="btn btn-success exportdata"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXPORT STOCK</a>
		</div>
</div>		
   </form>	
</fieldset> 
<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<table class=" table-sm table-bordered table-hover table-strepted dataTable w-100">
	<thead class="bg-dark text-white">
		<tr>
			<th>Référence</th>
			<th>Désignation</th>
			<th>Prix Unitaire</th>
			<th>En stock</th>
			
		</tr>
	</thead>
	<tbody>
		
	</tbody>
	
</table>
</fieldset> 
</div>
</div>
</div>
