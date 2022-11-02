 <?php $this->load->model('Planning_model')?>
 <div class="card w-100">
 	<div class="card-header bg-dark text-white">
 		<b>RECONCIALIATION</b>
 	</div>
 	<div class="card-body">
 		<div class="row p-0 m-0">
 			<fieldset class="col-md-12 p-0 m-0 w-100 text-right">
 				<div class="row p-0 m-0">
 					<div class="col-md-2">
 						<input type="date" class="form-control form-control-sm">
 					</div>
 					<div class="col-md-2">
 						<input type="text" class="form-control form-control-sm" placeholder="N°PO">
 					</div>
 					<div class="col-md-2 ">
 						<button class="btn btn-success btn-sm">VALIDER</button>
 					</div>
 				</div>
 			</fieldset>
 			<div class="col-md-12 p-0 m-0">
 				<table class="w-100 table-bordered table-responsive-lg table-hover table-sm dataTable" style="font-size: 13px;">
 					<thead class="bg-dark text-white text-center">
 						<tr>
 							<th colspan="13">EXTRUSION</th>
 						</tr>
 						<tr>
 							<th>Date</th>
 							<th>Machine</th>
 							<th colspan="2">Poids</th>
 							<th colspan="2">Dechet</th>
 							<th colspan="2">Dure</th>
 							<th>Chef d'equipe</th>
 							<th colspan="4"></th>
 						</tr>
 						<tr>
 							<th></th>
 							<th></th>
 							<th>Entre</th>
 							<th>Acum</th>
 							<th>TDX</th>
 							<th>ACCUM</th>
 							<th>TDX</th>
 							<th>ACCUM</th>
 							<th></th>
 							<th></th>
 							<th colspan="3"></th>
 						</tr>
 					</thead>
 					<tbody>
 						<?php if ($extrusion) : $sommeTotal = 0; $sommeTotalH = 0; foreach ($extrusion as $key => $extrusion) : ?>
 								<tr>
 									<td><?= $extrusion->EX_DATE ?></td>
 									<td><?= $extrusion->EX_N_MACH ?></td>
 									<td><?= $extrusion->EX_PDS_SOMME ?></td>
 									<td><?= $sommeTotal += $extrusion->EX_PDS_NET?></td>
 									<td><?= $extrusion->EX_DECHETS ?></td>
 									<td></td>
 									<td><?= $extrusion->EX_DUREE ?></td>
 									<td><?php 
$sommeTotalH += $this->planning_model->time_to_sec($extrusion->EX_DUREE);
echo $this->planning_model->se_to_time($sommeTotalH);
 									?></td>
 									<td><?=  $extrusion->EX_EQUIP ?></td>
 									<td></td>
 								</tr>
 							<?php endforeach;
							else : ?>
 							<tr>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td></td>
 								<td></td>

 							</tr>
 						<?php endif; ?>


 					</tbody>
 				</table>
 			</div>
 		</div>







 		<div class="col-md-12 p-0 m-0">
 			<table class="w-100 table-bordered table-responsive-lg table-hover table-sm dataTable" style="font-size: 13px;">
 				<thead class="bg-dark text-white text-center">
 					<tr>
 						<th colspan="13">IMPRESSION</th>
 					</tr>
 					<tr>

 						<th>Date</th>
 						<th>Machine</th>
 						<th colspan="2">Poids</th>
 						<th colspan="2">Dechet</th>
 						<th colspan="2">Dure</th>
 						<th>Chef d'equipe</th>
 						<th colspan="4"></th>
 					</tr>

 					<tr>
 						<th></th>
 						<th></th>
 						<th>Entre</th>
 						<th>Acum</th>
 						<th>TDX</th>
 						<th>ACCUM</th>
 						<th>TDX</th>
 						<th>ACCUM</th>
 						<th></th>
 						<th></th>
 						<th></th>
 					</tr>

 				</thead>
 				<tbody>

 					<?php if ($impression) : foreach ($impression as $key => $impression) : ?>

 							<td><?= $impression->EI_DATE ?></td>
 							<td><?= $impression->EI_MACH ?></td>
 							<td><?= $impression->EI_PDS_SOMME ?></td>
 							<td><?= $impression->EI_POIDS_NET ?></td>
 							<td><?= $impression->EI_DECHET ?></td>
 							<td></td>
 							<td><?= $impression->EI_DUREE ?></td>
 							<td></td>
 							<td><?= $impression->EI_EQUIPE ?></td>
 							<td></td>

 						<?php endforeach;
						else : ?>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td></td>


 					<?php endif; ?>

 				</tbody>
 			</table>
 		</div>
 	</div>




 	<div class="col-md-12 table-responsive">
 		<table class="w-100 table-bordered table-responsive-lg table-hover table-sm dataTable" style="font-size: 13px;">
 			<thead class="bg-dark text-white text-center">
 				<tr>
 					<th colspan="13">COUPE</th>
 				</tr>

 				<tr>

 					<th>Date</th>
 					<th>Machine</th>
 					<th colspan="2">Poids</th>
 					<th colspan="2">Dechet</th>
 					<th colspan="2">Dure</th>
 					<th>Chef d'equipe</th>
 					<th colspan="4"></th>




 				</tr>
 				<tr>

 					<th></th>
 					<th></th>
 					<th>Entre</th>
 					<th>Acum</th>
 					<th>TDX</th>
 					<th>ACCUM</th>
 					<th>TDX</th>
 					<th>ACCUM</th>
 					<th></th>
 					<th></th>
 				</tr>
 			</thead>
 			<tbody>

 				<?php if ($coupe) :  foreach ($coupe as $key => $coupe) : ?>
 						<td></td>
 						<td><?= $coupe->ED_DATE ?></td>
 						<td><?= $coupe->ED_MACHINE ?></td>
 						<td><?= $coupe->ED_PIOD_ENTRE_SOMME ?></td>
 						<td><?= $coupe->ED_PIOD_ENTRE_SOMME ?></td>
 						<td><?= $coupe->ED_DECHE_INPRESSION + $coupe->ED_DECHE_EXTRUSION + $coupe->ED_DECHE_COUPE ?></td>
 						<td></td>
 						<td><?= $coupe->ED_DURE ?></td>
 						<td></td>
 						<td><?= $coupe->ED_EQUIPE ?></td>

 						</tr>
 					<?php endforeach;
					else : ?>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					</tr>
 				<?php endif; ?>
 			</tbody>
 		</table>
 	</div>
 </div>







 </div>
 <script>
 	$(document).ready(function() {

 	});
 </script>