<?php

$dt = new DateTime();
$reponse  = $dt->format('t');
$rowspan = $reponse+1;
var_dump($reponse);


?>
<fieldset class="border p-2 bg-white mb-2">
<div class="col-md-12 p-2">
	<span>effective output</span>


		<div class="row">
			<table class="table-hover table-stripted table-bordered w-100">
				<thead class="bg-dark text-white">
					<th>DATE</th>
					
					<th>TDY hours</th>
					<th>Machine utilization </th>
					<th>Machine efficiency</th>
					<th>Total effective </th>
					<th>Equipment </th>
					<th>Losses-OEE % Loss </th>
					<th>TDY Scrap%</th>
					<th>Operateur Name</th>
				</thead>
				<tbody>
			    
					<?php for($i=1;$i<$reponse+1;$i++):?>
						<tr>
                             <td><?=$i?></td>
							
						</tr>
					<?php endfor;?>
				</tbody>

			</table>

		</div>
</div>
</div>
