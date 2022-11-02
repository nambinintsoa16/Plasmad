
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
	<tbody>
		
	</tbody>
	
</table>
</fieldset> 
</div>
</div>
</div>

<script>
$(document).ready(function(){
   Table =  $('.tableSortie').DataTable({
    processing: true,
            ajax:"controlleur/lisete_sortie_materiels",
         language: {
                 url :base_url+"assets/dataTableFr/french.json"
            },
            "drawCallback": function( settings ) {
          deleteSortie();
        }
  });

 tables =  $('.tableSortieDate').DataTable({
             processing: true,
            ajax: base_url +"magasiner/lisete_sortie_materiel_date",
            language: {
                 url :base_url+"assets/dataTableFr/french.json"
            },
            "drawCallback": function( settings ) {
          deleteSortie();
        }
  });
	$('.afficher').on('click',function(e){
      e.preventDefault()
			let debut = $('.debut').val()
			let fin = $('.fin').val()
			$('.exportSortie').attr('href',base_url+"magasiner/exportStockSortie?debut="+debut+"&fin="+fin)
			$('.printSortie').attr('href',base_url+"magasiner/printStockSortie?debut="+debut+"&fin="+fin)

		  var  links = base_url +"controlleur/lisete_sortie_materiels?debut="+debut+"&fin="+fin;
      Table.ajax.url(links);
      Table.ajax.reload();

	})
	
  /*$('.printSortie').on('click',function(e){
    e.preventDefault();
     var dateChoix = $('.dateChoix').val();
     
     var  links = base_url +"magasiner/lisete_sortie_materiel_date?date="+dateChoix;
    // tables.ajax.url(links);
     //tables.ajax.reload();
     //$('#infoCOmmande').modal('show');

  });*/
  function deleteSortie(){
     $('.delete').on('click',function(e){
       e.preventDefault();
        let id = $(this).attr('href');
        let type = "sortie";
        let idstock =  $(this).attr('id');
        chargement();
        $.post(base_url+'controlleur/deleteTransactionSortie',{id,type,idstock},function(data){
          closeDialog();
          Table.ajax.url("controlleur/lisete_sortie_materiels");
          Table.ajax.reload();
        });
     });
  }


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

  function chargement() {
        var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
        $.dialog({
            "title": "",
            "content": htmls,
            "show": true,
            "modal": true,
            "close": false,
            "closeOnMaskClick": false,
            "closeOnEscape": false,
            "dynamic": false,
            "height": 150,
            "fixedDimensions": true
        });


    }

    function closeDialog() {
        $('.jconfirm').remove();
    }
});
</script>
