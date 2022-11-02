<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LISTE DES SORTIES  PRODUITS FINIS</b>
      <b class="pull-right text-white"><a href="<?=base_url("Magasiner/exportsortieProduitFini")?>" class="text-white"><i class="fa fa-download"></i>&nbsp;EXPORTE</a></b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<table class=" table-sm table-bordered table-hover table-strepted tableProduitSortie w-100">
	<thead class="bg-dark text-white">
		<tr>
            <th>ID</th>						
            <th>DATE</th>
            <th>PO</th>		
			   <th>MAGASINER </th>
            <th>BL </th>
            <th>DIMENSION</th>							
            <th>QTT</th>
            <th>TAILLE</th>
			   <th>OBSERVATIION</th>
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
  $('.tableProduitSortie').DataTable({
    processing: true,
            ajax:"magasiner/lisete_sortie_fini",
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
});
</script>
