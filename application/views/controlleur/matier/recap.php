
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>RECAP SORTIER DES MATIERES</b>
      	<b class="pull-right">
			<form action="" method="post">
				<label>Origin : </label>
				<select class="mr-5 origin" style="width: 150px;height: 27px;" name="origin">
					<option value="PLASMAD_MAGASIN">Plasmad</option>
					<option value="MADAKEM_MAGASIN">Madakem</option>
					</select>

						<label>DEBUT : </label>
						<input type="date" class="mr-3 dateCost" name="date">
						<label>FIN : </label>
						<input type="date" class="mr-3 dateCostFin" name="findate">
				<input type="text" class="mr-3 reference" name="reference"  placeholder="Réference matière">
					<button type="submit" class="btn btn-sm btn-primary AfficherMatier"><i class="fa fa-tv"></i>
							Afficher</button>
						<a href="<?= base_url("Controlleur/exportStockSortieRecap") ?>" class="btn btn-sm btn-success export"><i class="fa fa-download"></i>EXPORT</a>
						<a href="<?=base_url("Controlleur/printStockSortieRecap")?>" class="btn btn-warning btn-sm print"><i class="fa fa-print"></i>&nbsp; IMPRIMER</a>
			</form>

		</b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border mt-2 w-100 pt-3">


	<table class=" table-sm table-bordered table-hover table-strepted tableRecapMatier w-100">
		 <thead class="bg-dark text-white">
	         <tr>
			 	 <th>REFERENCE</th>
			 	 <th>QUANTITE</th>
				 <th>UNITE</th>
			 	 <th>N PO</th>
			 </tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>


</fieldset> 
</div>
</div>
</div>
<script>
	$(document).ready(function(){
		var Table =  $('.tableRecapMatier').DataTable({
			    processing: true,
			            ajax:"Controlleur/lisete_sortie_materiel",
			         language: {
			                 url :base_url+"assets/dataTableFr/french.json"
			            },
			       
			         "rowCallback": function (row, data) {
			               
			        },
			        initComplete : function(setting){
			         
			        },
			        "drawCallback": function( settings ) {
			        }
  			});

		$('.AfficherMatier').on('click',function(e){
			e.preventDefault();
			var origin  = $('.origin option:selected').val();
			var dateCost = $('.dateCost').val();
			var dateCostFin = $('.dateCostFin').val();
			var reference = $('.reference').val();

			$('.export').attr('href',base_url+"Controlleur/exportStockSortieRecap?origin="+origin+"&dateCost="+dateCost+"&dateCostFin="+dateCostFin+"&reference="+reference);
			$('.print').attr('href',base_url+"Controlleur/printStockSortieRecap?origin="+origin+"&dateCost="+dateCost+"&dateCostFin="+dateCostFin+"&reference="+reference);
			var links = base_url + "Controlleur/lisete_sortie_materiel?origin="+origin+"&dateCost="+dateCost+"&dateCostFin="+dateCostFin+"&reference="+reference;
            Table.ajax.url(links);
            Table.ajax.reload();
		});

		$( ".reference" ).autocomplete({
    source: base_url+"Controlleur/autocompleteSortie",
   
});
	});
</script>






