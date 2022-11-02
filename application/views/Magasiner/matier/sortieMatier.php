
 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>LISTE DES SORTIES MATIERE PREMIERE</b>
        <b class="pull-right">
      <form method="post" action="<?=base_url("Magasiner/exportSortierMarierPremier")?>">
        <input type="date"  class="dateChoix" name="date">
        <button type="submit" class="btn btn-primary btn-sm printSortie"><i class="fa fa-download"></i>&nbsp; EXPORTE</button>
      </form>
     </b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<table class=" table-sm table-bordered table-hover table-strepted tableSortie w-100">
	<thead class="bg-dark text-white">
        <tr>
            <th>ID</th>						
            <th>DATE</th>
		      	<th>MAGASINER </th>
            <th>RECEPTIONNAIRE</th>							
	      		<th>ARTICLE </th>
            <th>QUANTITE</th>
            <th>SAC</th>
	    	</tr>
	</thead>
	<tbody>
		
	</tbody>
	
</table>
</fieldset> 
</div>
</div>
</div>




<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header bg-dark text-white">
					<b> LISTE DES MATIER</b>
				</div>
				<div class="card-body">
					<div class="form p-0">
						<form class=" m-0 w-100">
              <fieldset class="col-md-12 border p-0 w-100 text-rigth">
                  <a href="#" class="btn btn-primary print"><i class="fa fa-print"></i> Imprimer</a>
               </fieldset>
							<fieldset class="col-md-12 border p-0 w-100">
							  <table class="table-sm table-bordered table-hover table-strepted tableSortieDate w-100">
                 <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>           
                            <th>DATE</th>
                            <th>MAGASINER </th>
                            <th>RECEPTIONNAIRE</th>             
                            <th>ARTICLE </th>
                            <th>QUANTITE</th>
                            <th>SAC</th>
                            <th></th>
                        </tr>
                  </thead>
                  <tbody class="body-table">
                    

                  </tbody>
                </table >
				      </fieldset>
				</div>

			</div>
		</div>
	</div>
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

  var Table = $('.tableSortieDate').DataTable();

  $('.printSortie').on('click',function(e){
    e.preventDefault();
     var dateChoix = $('.dateChoix').val();
     
     var  links = base_url +"magasiner/lisete_sortie_materiel_date?date="+dateChoix;
     Table.ajax.url(links);
     Table.ajax.reload();
      $('#infoCOmmande').modal('show');

  });
  $('.print').on('click',function(e){
     e.preventDefault();
      var dateChoix = $('.dateChoix').val();
     var link ="";
     var i = 0;
     $('.body-table > tr').each(function(){
      var $this = $(this).children();
      
       if ( $this.eq(7).find('input').is(':checked') == true ){
            if(i==0){
               link+=$this.eq(0).text();
            }else{
               link+="+"+$this.eq(0).text();
            }
            i++;
       }
     });

       location.replace(base_url+"magasiner/exportSortierPram?date="+dateChoix+"&Po="+link);
  });
});
</script>
