       
  
<fieldset class="col-md-12 border p-3 ">
    
<table class="table table-bordered border-secondary table-striped table-hover DataTable">
            <thead class="bg-secondary text-white">
                <tr>
                     <th>date</th>
                     <th>PO</th>
                     <th>ME</th>
                     <th>SUITE</th>
                     <th>PDS NET</th> 
                     <th>RESTE 1</th>
                     <th>RESTE 2</th>
                     <th>QRT</th>	
                     <th>N° Mch	</th>
                     <th>OBS</th>
                </tr>     
            </thead> 
            <tbody>  
                <?php foreach ($donne as $key => $donne):?> 
                        <tr>
                            <td><?=$donne->VP_DATE?></td>
                            <td><?=$donne->VM_PO?></td>
                            <td><?=$donne->VM_ME?></td>
                            <td><?=$donne->VM_SUITE?></td>
                            <td><?=$donne->VM_PDSNET?></td> 
                            <td><?=$donne->VM_R1?></td>
                            <td><?=$donne->VM_R2?></td>
                            <td><?=$donne->VM_QRT?></td>	
                            <td><?=$donne->VM_NMCH?></td>
                            <td>OBS</td>
                        </tr>  
                <?php endforeach;?>      
            </tbody>
            <tfoot>
           
                  
            
            
            </tfoot>
        </table>
        </fieldset>  