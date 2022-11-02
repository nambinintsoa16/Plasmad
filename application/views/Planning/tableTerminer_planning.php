 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>TERMINEE</b>
   </div>
<div class="card-body">
<p class="mt-3 mb-3">
	<button class="btn btn-success text-left" style="width: 200px" type="button"  aria-expanded="false" aria-controls="NON_PLANNIFIER">
		<i class="fa fa-check"></i> TERMINER
	</button>
</p>
<div class="table-responsive">
<table class="w-100 table-bordered bordered-dark table-hover table-sm dataTableLite"  style="font-size: 13px!important;">
    <thead class="bg-dark text-white text-center text-sm">
        <tr >
        	<th>PO</th>	
			<th>DATE</th>
			<th>DATE DE LIVRAISON</th>
			<th>CLIENT</th>	
			<th>CODE CLIENT</th>
			<th>TYPE DE PRODUIT</th>
			<th>TYPE DE MATIER</th>
			<th>ECHANTILLON</th>	
			<th>IMPRESSION</th>	
			<th>DIMENSION</th>
			<th>REASSORT</th>
			<th>RABAT</th>
			<th>SOUFFLET</th>
			<th>PERFORATION</th>
			<th>QTY</th>
			<th>OBSERVATION</th>
	    </tr>
    </thead>
    <tbody class="bg-default text-dark">
       
    </tbody>
</table>
</div></div>
<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
<div class="card">
   <div class="card-header bg-dark text-white">
      <b>CREATION JOB CARD</b>
   </div>
   <div class="card-body">
    <div class="form">
		<form method="post" action="<?=base_url('Commerciale/sauveCommande')?>">	
<fieldset class="col-md-12 border">
    <div class="row">
			  
				<div class="form-group col-md-6">
				 <label for="BC_PE">PO N° : </label>
				 <input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
				</div>
				 <div class="form-group col-md-6">
				 <label for="JO_ID">JOB CARD N° : </label>
				 <input type="text" name="JO_ID"  disabled class="form-control form-control-sm JO_ID">
				</div>
			
				<div class="form-group col-md-6">
				<label for="BC_QUANTITEAPRODUIREENMETRE">QUANTITE A PRODUIRE EN METRE : </label>
				<input type="text" name="BC_QUANTITEAPRODUIREENMETRE" class="form-control form-control-sm BC_QUANTITEAPRODUIREENMETRE">
				</div>
				<div class="form-group col-md-6">
				<label for="BC_POISENKGSAVECMARGE">POIS EN KG AVEC MARGE : </label>
				<input type="text" name="BC_POISENKGSAVECMARGE" class="form-control form-control-sm BC_POISENKGSAVECMARGE">
				</div>
				<div class="form-group col-md-4">
				    <label for="date_prod">DATE DE PRODUCTION</label>
				    <input type="date" id="date_prod" name="date_prod" class="form-control form-control-sm date_prod">
				</div>
				<div class="form-group col-md-4">
				    <label for="DJ_MACHINE">PROCESSUS</label>
				    <select class="form-control BC_STATUT form-control-sm" name="BC_STATUT">
				    	<option></option>
				    	<option>INPRESSION</option> 
				    	<option>DECOUPE</option>
				    </select>
				</div>
				<div class="form-group col-md-4">
				    <label for="DJ_MACHINE">MACHINE</label>
				    <select class="form-control DJ_MACHINE form-control-sm" name="DJ_MACHINE">
				    	
				    </select>
				</div>
	</div>			
</fieldset>	
<fieldset class="col-md-12 border mt-2">
        <div class="row">  
			<div class="form-group col-md-4">
				<label for="BC_OBSERVATION">Matière première : </label>
			</div>	
			<div class="form-group col-md-4">
				<div class="form-group">
					<div class="input-group-append">
				<input type="text" class="form-control form-control-sm stock_sortie " placeholder="Entre désignation" >   </div>
				</div>
			</div>	
			<div class="form-group col-md-4">
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="number" class="form-control form-control-sm Quantite" placeholder="Quantite" aria-label="Entre désignation" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<a href="#" class="input-group-text btn btn-primary text-white form-control-sm add-table" id="basic-addon2"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
			   	
			</div>	
			<div class="form-group col-md-12">
				    <table class="w-100 table-bordered table-hover table-sm">
				    	<thead class="bg-dark text-white text-center">
				    		<tr>
				    			<th>N°</th>
				    			<th>Designation</th>
				    			<th>Quantite</th>
				    			<th></th>
				    		</tr>
				    	</thead>
				    	<tbody class="tbody-modaltable text-center">
				    		
				    	</tbody>
				    </table>
			</div>			
        </div>	 
</fieldset>
<fieldset class="col-md-12 border mt-2">
            <div class="row">  
				<div class="form-group col-md-12">
				    <label for="BC_OBSERVATION">Observation : </label>
					<textarea class="form-control BC_OBSERVATION"></textarea>
				</div>	
			 </div>
</fieldset>	

   </div>
   <div class="card-footer text-right"> 
         <button type="submit" class="btn btn-success UpdateCommande">ENREGISTRE</button>
         <button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
   </div>
</form>
  </div>  
</div>  
			</div>
	
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		Table = $(".dataTableLite").DataTable({
            processing: true,
            ajax:base_url+'Planning/Job_terminer',
            language: {
                       url :base_url+"assets/dataTableFr/french.json"
                     },
        rowCallback: function (row, data) {
      
        },
    initComplete : function(setting){
     
    },
        "drawCallback": function( settings ) {
          
               
        }
    });
	});
	</script>