<p>
<div class="form-control text-left col-md-12 w-100">
 <a href="#" class="btn btn-primary btn-sm liknk"><i class="fa fa-plus"></i>&nbsp;INJECTION</a>
 </div>
</p>	

		    <table class="text-sm table-bordered table-sm table-hover w-100 table-strepted datatable table-modif">
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>REFERENCE</th>
					<th>QTT</th>
					<th>DECHET</th>
					<th>N°MACHINE</th>
					<th>DUREE</th>
					<th>QUART</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>MATIER EN KG</th>
					<th>MASTER BATCHE(kg)</th>
					<th>OBSERVATION I</th>
					<th>OBSERVATION II</th>
				</tr>
				</thead>
				<tbody>
					<?php 
					foreach($injection as $key => $injection):?>
                          <tr>
							  <td><?=$injection->IN_DATE?></td>
							  <td><?=$injection->BC_PO?></td>
							  <td><?=$injection->IN_REFERENCE?></td>
							  <td><?=$injection->IN_QTY?></td>
							  <td><?=$injection->IN_DECHETS?></td>
							  <td><?=$injection->IN_MACHINE?></td>
							  <td><?=$injection->IN_DURE?></td>
							  <td><?=$injection->QUART_TIME?></td>
							  <td><?=$injection->IN_OPERATEUR1?></td>
							  <td><?=$injection->IN_OPERATEUR2?></td>
							  <td><?=$injection->IN_MATIERES?></td>
							  <td><?=$injection->IN_MASTERBATCHE?></td>
							  <td><?=$injection->IN_OBSERVATION1?></td>
							  <td><?=$injection->IN_OBSERVATION2?></td>
					      </tr>	
					<?php endforeach?>
				</tbody>
		   </table>
<p>
<div class="form-control text-left col-md-12 w-100">
 <a href="#" class="btn btn-primary btn-sm liknk"><i class="fa fa-plus"></i>&nbsp;INPRESSION</a>
 </div>
</p>	


<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted datatable table-modif" >
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>REFERENCE</th>
					<th>N°MACHINE</th>
					<th>QTT</th>
					<th>DECHET</th>
					<th>DUREE</th>
					<th>QUART</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>OBSERVATION I</th>
					<th>OBSERVATION II</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					foreach($inpression as $key => $inpression):?>
                          <tr>
							  <td><?=$inpression->IN_DATE?></td>
							  <td><?=$inpression->BC_PO?></td>
							  <td><?=$inpression->IN_REFERENCE?></td>
							  <td><?=$inpression->IN_QTY?></td>
							  <td><?=$inpression->IN_DECHETS?></td>
							  <td><?=$inpression->IN_MACHINE?></td>
							  <td><?=$inpression->IN_DURE?></td>
							  <td><?=$inpression->QUART_TIME?></td>
							  <td><?=$inpression->IN_OPERATEUR1?></td>
							  <td><?=$inpression->IN_OPERATEUR2?></td>
							  <td><?=$inpression->IN_OBSERVATION1?></td>
							  <td><?=$inpression->IN_OBSERVATION2?></td>
							  
					      </tr>	
					<?php endforeach?>
				</tbody>
		   </table>		
<p>
<div class="form-control text-left col-md-12 w-100">
 <a href="#" class="btn btn-primary btn-sm liknk"><i class="fa fa-plus"></i>&nbsp;HOOK</a>
 </div>
</p>	

<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted datatable table-modif" >
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>REFERENCE</th>
					<th>N°MACHINE</th>
					<th>QTT</th>
					<th>DECHET</th>
					<th>DUREE</th>
					<th>QUART</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>OBSERVATION I</th>
					<th>OBSERVATION II</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					foreach($hook as $key => $hook):?>
                          <tr>
							  <td><?=$hook->IN_DATE?></td>
							  <td><?=$hook->BC_PO?></td>
							  <td><?=$hook->IN_REFERENCE?></td>
							  <td><?=$hook->IN_MACHINE?></td>
							  <td><?=$hook->IN_QTY?></td>
							  <td><?=$hook->IN_DECHETS?></td>
							  <td><?=$hook->IN_DURE?></td>
							  <td><?=$hook->QUART_TIME?></td>
							  <td><?=$hook->IN_OPERATEUR1?></td>
							  <td><?=$hook->IN_OPERATEUR2?></td>
							  <td><?=$hook->IN_OBSERVATION1?></td>
							  <td><?=$hook->IN_OBSERVATION2?></td>
							
					      </tr>	
					<?php endforeach?>
				</tbody>
		   </table>	
           </div>
</div> 