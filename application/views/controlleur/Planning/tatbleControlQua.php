       
  
<fieldset class="col-md-12 border p-3 ">
    
<table class="table table-bordered border-secondary table-striped table-hover DataTable">
            <thead class="bg-secondary text-white">
                <tr>
                     <th>Id</th>
                     <th>N°PO</th>
                     <th>OPERATEUR</th>  
                     <th>ENTRE</th>      
                     <th>TTS</th>  
                     <th>2eme Choix</th>              
                </tr>     
            </thead> 
            <tbody>  
                <?php foreach ($data as $key => $data):?> 
                        <tr>
                            <td><?=$data->C_ID?></td>
                            <td><?=$data->C_PO?></td>
                            <td><?=$data->C_QC?></td>
                            <td><?=$data->C_ENTRE?></td>
                            <td><?=$data->C_TTS?></td>
                            <td><?=$data->C_CHOIX?></td>
                        </tr>  
                <?php endforeach;?>      
            </tbody>
            <tfoot>
           
                  
            
            
            </tfoot>
        </table>
        </fieldset>  

        <script type="text/javascript">
            $(document).ready(function(){
                $('.DataTable').DataTable();
            });
        </script>