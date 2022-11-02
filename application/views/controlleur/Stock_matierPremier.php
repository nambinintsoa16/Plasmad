
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LISTE DES MATIERES PREMIERES</b>
	  <b class="pull-right">
		<a href="<?=base_url("controlleur/exportStockMatier")?>" class="btn btn-primary btn-sm exportSortie"><i class="fa fa-download"></i>&nbsp; EXPORTE</a>
		<a href="<?=base_url("controlleur/printStockMatier")?>" class="btn btn-warning btn-sm printSortie"><i class="fa fa-print"></i>&nbsp; IMPRIMER</a>
	   </b>
	</div>
<div class="card-body">
<fieldset class="col-md-12 border w-100">
	<form class="form w-100 col-12" method="POST">
<div class="row">
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
