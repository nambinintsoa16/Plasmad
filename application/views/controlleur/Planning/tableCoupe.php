<div class="table-responsive row">  				
			<table class="w-100 table-bordered table-responsive-lg table-hover table-sm dataTable" style="font-size: 13px;">
   				 <thead class="bg-dark text-white">
       				 <tr>
						<th>DATE</th>	
						<th>PO</th>	
						<th style="width: 80px;">JOB  CARD</th>
						<th>CLIENT</th>	
						<th style="width: 80px!important;">CODE CLIENT</th>
						<th>TYPE</th>
						<th>MAT </th>
						<th>DIMENSION</th>
						<th>IMPRESSION</th>	
						<th>ECHANTILLON</th>	
						<th>METRAGE</th>
						<th>DIMENSION PROD</th>	
						<th>POIDS</th> 
						<th>POIDS EN PROD</th> 
						<th>TERMINER</th> 
						<th>RESTE</th> 
						<th>QUANTITE</th>	
						<th>PIECE</th>
						<th>EXT</th>
						<th>KGS/H</th>
						<th>REEL</th>	
						<th>DATE DEBUT</th>
						<th>DEBUT</th>
						<th>DATE FIN</th>
						<th>FIN</th>
						<th>DUREE</th>
						<th>RESTE TEMPS</th>
						<th>OBS</th>
			
					
        			</tr>
    </thead>
    <tbody>
<?php
$this->load->model('Planning_model'); 
     foreach($data as $data):
      $rep = "";
      $av= "";
      $av=$data->JO_SORTIE-$data->JO_AV;
	  //$av = $data->JO_AV;
?>
       	<tr <?php if($data->JO_ETAT=='on'){echo "style='background:yellow;'";}?>>
       		 <td><?=$data->JO_DATEDEDEBU?></td>
       		 <td><?=$data->BC_PE?></td>
			 <td><?=$data->JO_ID?></td>
       		 <td><?=$data->BC_CLIENT?></td>
			 <td><?=$data->BC_CODE?></td>
       		 <td><?=$data->BC_TYPE?></td>
			 <td><?=$data->BC_TYPEMATIER?></td>
       		 <td><?=$data->BC_DIMENSION?></td>
       		 <td><?=$data->BC_IMPRESSION?></td>
			 <td><?=$data->BC_ECHANTILLON?></td>
       		 <td><?=$data->BC_QUANTITEAPRODUIREENMETRE?></td>
			 <td><?=$data->BC_DIMENSIONPROD?></td>
       		 <td><?=$data->BC_POISENKGSAVECMARGE?></td>
			 <td><?=$data->JO_SORTIE?></td>
			 <td><?=$data->JO_AV?></td>
			 <td><?=$av?></td>
			 <td><?=$data->BC_QUNTITE?></td>
			 * <td><?=$data->JO_PIECE?></td>
       		 <td><?=$data->BC_PE?></td>
       		 <td><?=$Vitesse?></td>
			 <td><?=$data->BC_PE?></td>
			 <td> <?=$data->JO_DATEDEDEBU?> </td>
			 <td><?=$data->JO_DEB ?></td>
			 <td><?=$data->JO_DATEFIN ?></td>
			 <td><?=$data->JO_FIN ?></td>
			 <td><?=$data->JO_DURE ?></td>
			
			 <td>	
			 	<?php
			 		 $dureTemp =$av/$Vitesse;
				   	  $hdt = 00;
				   	  while ( $dureTemp>0.99) {
				   	  	$hdt++;
				   	  	 $dureTemp = $dureTemp-1;
				   	  } 
				   	 if($hdt<10){
				   	 	$hdt = "0".$hdt;
				   	 }
			          $tempds = number_format(($dureTemp*60),0);
			         if($tempds<10){
			            $tempds = "0".$tempds;
			         }
						echo date($hdt.":".$tempds.":00"); 
			 	 ?>
			 </td>
			   <td><?=$data->JO_OBS?></td>
			  
       	</tr>	
    <?php endforeach;?>  
    </tbody>
</table>
</div>	
<div class="modal fade bd-example-modal-lg" id="jobMachine" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
	<div class="form-group col-md-4">
				 <label for="BC_PE">PO N° : </label>
				 <input type="text" name="BC_PE" class="form-control form-control-sm BC_PEE" value="">
				</div>
				 <div class="form-group col-md-4">
				 <label for="JO_ID">JOB CARD N° : </label>
				 <input type="text" name="JO_ID"  disabled class="form-control form-control-sm JO_IDE">
				</div>
				<div class="form-group col-md-4">
				 <label for="">DATE  DE FIN  : </label>
				 <input type="date" name=""   class="form-control form-control-sm dateFInE">
				</div>
				<div class="form-group col-md-4">
				 <label for="">DEBUT : </label>
				 <input type="time" name=""   class="form-control form-control-sm hdebE">
				</div>
				<div class="form-group col-md-2">
				 <label for="">DUREE : </label>
				 <input type="text" name=""   class="form-control form-control-sm heureE">
				</div>
				
				<div class="form-group col-md-2">
				 <label for="">HEURE FIN : </label>
				 <input type="time" name=""   class="form-control form-control-sm heurefinE">
				</div>
			
				
			
				<div class="form-group col-md-4">
				    <label for="BC_STATUTE">PROCESSUS</label>
				    <select class="form-control BC_STATUTE form-control-sm" name="BC_STATUTE">
				    	<option></option>
						<option value="IMPRESSION_INJECTION">IMPRESSION INJECTION</option>
						<option value="HOOK">HOOK</option>
						<option value="EXTRUSION">EXTRUSION</option> 
				    	<option value="IMPRESSION_EXTRUSION">IMPRESSION</option> 
				    	<option value="COUPE_EXTRUSION">COUPE</option>
				    </select>
				</div>
				<div class="form-group col-md-4">
				<label for="BC_POISENKGSAVECMARGE">QUANTITE A PRODUIRE: </label>
				<input type="text" name="BC_POISENKGSAVECMARGE" class="form-control form-control-sm ENPRODUCTIONE">
				</div>

				<div class="form-group col-md-4">
				    <label for="DJ_MACHINE">MACHINE</label>
						<select  class="form-control form-control-sm DJ_MACHINEE" name="DJ_MACHINEE"> 
						</select>
				</div>
				<div class="form-group col-md-4">
				    <label for="date_prod">DATE DE PRODUCTION</label>
				    <input type="date" id="date_prodEE" name="date_prodEE" class="form-control form-control-sm date_prodEE">
				</div>
	</div>			
</fieldset>	

<fieldset class="col-md-12 border mt-2">
            <div class="row">  
				<div class="form-group col-md-12">
				    <label for="BC_OBSERVATION">Observation : </label>
					<textarea class="form-control BC_OBSERVATIONE"></textarea>
				</div>	
			 </div>
</fieldset>	

   </div>
   <div class="card-footer text-right"> 
         <button type="submit" class="btn btn-success UpdateCommandeE">ENREGISTRE</button>
         <button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
   </div>
</form>
  </div>  
</div>  
		


<script type="text/javascript">
	$(document).ready(function() {

		$('.change_machine').on('click',function(event){
		  event.preventDefault();
		  var BC_PE = $(this).parent().parent().children().eq(1).text().trim();
          var JO_ID = $(this).parent().parent().children().eq(2).text().trim();
		  var RESTE = $(this).parent().parent().children().eq(11).text().trim();
		  var DEBUT = $(this).parent().parent().children().eq(18).text().trim();
		  var FIN = $(this).parent().parent().children().eq(19).text().trim();
		  var DURE = $(this).parent().parent().children().eq(20).text().trim();
		  $.post(base_url+'planning/lastIdJob',function(data){
					$('.DEBUTE').val(DEBUT);
					$('.DUREE').val(DURE);
					$('.BC_PEE').val(BC_PE);
					$('.JO_IDE').val(data);
					$('.reste').val(RESTE);
					$('.modalmachine').modal('show');
		  })
		  
		});


		


});
</script>
