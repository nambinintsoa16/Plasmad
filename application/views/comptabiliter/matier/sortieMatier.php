
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LISTE DES SORTIES MATIERE PREMIERE</b>
      <b class="pull-right">
        <input type="date"  class="debut" name="date">
				<input type="date"  class="fin" name="date">
				<a href="#" class="btn btn-success btn-sm afficher"><i class="fa fa-tv"></i>&nbsp; AFFICHER</a>
        <a href="<?=base_url("magasiner/exportStockSortie?debut=&fin=")?>" class="btn btn-primary btn-sm exportSortie"><i class="fa fa-download"></i>&nbsp; EXPORTE</a>
				<a href="<?=base_url("magasiner/printStockSortie?debut=&fin=")?>" class="btn btn-warning btn-sm printSortie"><i class="fa fa-print"></i>&nbsp; IMPRIMER</a>
     </b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<table class=" table-sm table-bordered table-hover table-strepted tableSortie w-100">
	<thead class="bg-dark text-white">
		<tr>
        <tr>
            <th>ID</th>						
            <th>DATE</th>
		      	<th>MAGASINER </th>
            <th>RECEPTIONNAIRE</th>							
	      		<th>ARTICLE </th>
            <th>QUANTITE</th>
          
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
  Table= $('.tableSortie').DataTable({
    processing: true,
            ajax:"magasiner/lisete_sortie_materiel",
         language: {
                 url :base_url+"assets/dataTableFr/french.json"
            },
        "columnDefs":[
                 {
                  "targets":[4],
                  "orderable":false,
                          
                }
                 ],
         "rowCallback": function (row, data) {
               
        },
        initComplete : function(setting){
         
        },
        "drawCallback": function( settings ) {
        }
  });

  $('.afficher').on('click',function(e){
      e.preventDefault()
			let debut = $('.debut').val()
			let fin = $('.fin').val()
			$('.exportSortie').attr('href',base_url+"magasiner/exportStockSortie?debut="+debut+"&fin="+fin)
			$('.printSortie').attr('href',base_url+"magasiner/printStockSortie?debut="+debut+"&fin="+fin)

		  var  links = base_url +"magasiner/lisete_sortie_materiel_date?debut="+debut+"&fin="+fin;
      Table.ajax.url(links);
      Table.ajax.reload();

	})
});
</script>
