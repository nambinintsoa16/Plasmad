
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LISTE DES ENTREES MATIERE PREMIERE</b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<table class=" table-sm table-bordered table-hover table-strepted tableEntreMat w-100">
	<thead class="bg-dark text-white">
		<tr>
        <tr>
            <th>Id</th>				
            <th>Date</th>
			      <th>Magasinier </th>
            <th>Fournisseur</th>							
		       	<th>Article </th>
            <th>Quantité</th>
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
  $('.tableEntreMat').DataTable({
    processing: true,
            ajax:"magasiner/lisete_entre_materiel",
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
