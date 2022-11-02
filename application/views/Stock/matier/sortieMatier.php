
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LISTE DES SORTIES MATIERE PREMIERE</b>
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
  $('.tableSortie').DataTable({
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
});
</script>
