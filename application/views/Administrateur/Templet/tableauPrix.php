<table class="table table-bordered  dataTableLite table-sm">
					<thead class="bg-dark text-white">
						<tr>
							<th>Raw Material</th>	<th>Std Ratio</th>	<th>Rate</th>	<th> Cost/kg </th>
						</tr>	
					</thead>
					<tbody>	
						<tr>		
							<td>HDPE/LDPE</td>	<td><?=$HDPE_LDPE?></td>	<td><?=$HDPE_LDPERATE?></td>	<td><?=$HDPE_LDPE*$HDPE_LDPERATE?></td>
						</tr>		
						<tr>		
							<td>LLDPE-</td>	<td><?=$LLDPE?></td><td><?=$LLDPERATE?></td>	<td><?=$LLDPE*$LLDPERATE?></td>
						</tr>		
						<tr>		
							<td>Borstar</td><td><?=$Borstar?></td><td><?=$BorstarRATE?></td><td><?=$Borstar*$BorstarRATE?></td>
						</tr>		
						<tr>		
							<td>Elastomers/Vistamaxx</td><td><?=$Elastomers_Vistamaxx?></td><td><?=$Elastomers_Vistamax?></td><td><?=$Elastomers_Vistamax*$Elastomers_Vistamaxx?></td>
						</tr>		
						<tr>
							<td>Recycled</td><td><?=$Recycled?></td><td><?=$RecycledRate?></td><td><?=$Recycled*$RecycledRate?></td>
						</tr>		
						<tr>			
							<td>CaCo3</td>	<td><?=$CaCo3?></td><td><?=$CaCo3Rate?></td>	<td><?=$CaCo3*$CaCo3Rate?></td>
						</tr>		
						<tr>		
							<td>Master batch</td><td><?=$Elastomers_VistamaxRateStd?></td><td><?=$Elastomers_VistamaxRate?></td>	<td><?=$Elastomers_VistamaxRateStd*$Elastomers_VistamaxRate?></td>
						</tr>
						<tr>		
                            <?php 
                            $total1=$HDPE_LDPE+$LLDPE+$Borstar+$Elastomers_Vistamaxx+$Recycled+$CaCo3+$Elastomers_VistamaxRateStd;
                            $total2=$HDPE_LDPERATE+$LLDPERATE+$BorstarRATE+$Elastomers_Vistamax+$RecycledRate+$CaCo3Rate+$Elastomers_VistamaxRate;
                            $total3 = ($HDPE_LDPE*$HDPE_LDPERATE)+($LLDPE*$LLDPERATE)+($Borstar*$BorstarRATE)+($Elastomers_Vistamax*$Elastomers_Vistamaxx)+($Recycled*$RecycledRate)+($CaCo3*$CaCo3Rate)+($Elastomers_VistamaxRateStd*$Elastomers_VistamaxRate);
                           ?>
							<td>Total</td>	<td><?=$total1?></td>	<td><?=$total2?></td>		<td><?=$total3?></td>
						</tr>
					</tbody>
				</table>