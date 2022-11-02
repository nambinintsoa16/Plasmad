 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>VALIDE SORTIE MATIERE PREMIERE</b>
   </div>
<div class="card-body">
	<div class="row ">  

		<fieldset class="col-md-12 border mt-2 w-100 pt-3">
<table class=" table-sm table-bordered table-hover table-strepted tableValiderSortie w-100">
	<thead class="bg-dark text-white">
        <tr>				
            <th>DATE</th>
		    <th>MAGASINER </th>
            <th>RECEPTIONNAIRE</th>							
	      	<th>MACHINE </th>
            <th>ARTICLE</th>
            <th>STATUT</th>
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


<div class="modal fade" id="modaleEditSortie" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row m-0">
            <div class="form-group col-md-12 text-right">
                <a href="#" class="btn btn-primary add"><i class="fa fa-plus"></i>Ajouter nouveau matier</a>
            </div>
            <div class="form-group col-md-12">
        <table class="table table-hover table-strepted datatableModif w-100">
            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>ARTICLE</th>
                    <th>QUANTITE</th>
                    <th>PRIX</th>
                    <th></th>
                  
                </tr>
            </thead>
          </table>
          </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
    
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ajouterProduit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">AJOUTER NOUVEAU MATIER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row m-0">
            <div class="form-group col-md-12">
              <label>N°PO</label>
              <input type="text" class="form-control po" disabled>
          </div>
         <div class="form-group col-md-12">
                  <label>Matier</label>
                  <input type="text" class="form-control matier">
          </div>
          <div class="form-group col-md-12">
              <label>Quantité</label>
              <input type="number" class="form-control quanatite">
          </div>
          <div class="form-group col-md-12">
              <label>Prix</label>
              <input type="number" class="form-control prix" disabled>
          </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
     <button type="button" class="btn btn-success addMat" >Valider</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		 Table = $('.tableValiderSortie').DataTable({
    		processing: true,
            ajax:"controlleur/liste_matierattentvalide",
            language: {
                 url :base_url+"assets/dataTableFr/french.json"
            },
           drawCallback: function( settings ) {
          validerSortie();
         }
  });
 TableModif = $('.datatableModif').DataTable({
    processing: true,
          
            language: {
                 url :base_url+"assets/dataTableFr/french.json"
            },
           drawCallback: function( settings ) {
             validerModif();
          }

 })
  function validerSortie(){
     $('.valider').on('click',function(e){
        e.preventDefault();
        let po= $(this).attr('href');
        $.post(base_url+"controlleur/validerSortieMatier",{po},function(){
            Table.ajax.reload();
        });

     });

     $('.edit').on('click',function(e){
        e.preventDefault();
         let po= $(this).attr('href');
         $('.po').val(po);
        TableModif.ajax.url(base_url+"controlleur/listeInfoValide?po="+po);
        TableModif.ajax.reload();
        $('#modaleEditSortie').modal("show");
     });


  }
  $(".addMat").on('click',function(e){
    e.preventDefault();
    let des = $('.matier').val();
    let quantite = $('.quanatite').val();
    let po =$('.po').val();
    let prix =$('.prix').val();
    $.post(base_url+"controlleur/insertInfoMatierProduit",{po,quantite,prix,des},function(){
         Table.ajax.reload();
            $('input').val("");        
    });

  });
   $(".matier" ).autocomplete({
    appendTo:"#ajouterProduit",
    source: base_url+"Planning/autocompleteSortie",
    select:function(item,label){
        item.preventDefault();
       let rep = label.item.label.split("|");
       $('.matier').val(rep[0]);
       $('.prix').val(rep[1].trim());
    }
    
});

        $('.add').on('click',function(e){
          e.preventDefault();
         $('#modaleEditSortie').modal("hide");
         $('#ajouterProduit').modal("show");
     });
function validerModif(){

    $('.supprimer').on('click',function(e){
        e.preventDefault();
        let id = $(this).attr('href');
        $.post(base_url+"controlleur/deleteSortieTransac",{id},function(){
             TableModif.ajax.reload();
             Table.ajax.reload();
        });

        });
      

}
	});
</script>