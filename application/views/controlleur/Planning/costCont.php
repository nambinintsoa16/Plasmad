 <div class="card w-100">
     <div class="card-header bg-dark text-white">
         <b>RECONCIALIATION</b>
     </div>
     <div class="card-body">

         <div class="table-responsive">
             <table class="w-100 table-bordered bordered-dark table-hover table-sm dataTableData" style="font-size: 13px!important;">
                 <thead class="bg-dark text-white text-center text-sm">
                     <tr>
                         <th>DATE</th>
                         <th>PO</th>
                         <th>N° Job cart</th>
                         <th>TYPE</th>
                         <th>MACHINE</th>
                         <th>PROCCESSUS</th>
                         <th>TYPE DE BAG</th>
                         <th>MATIER</th>
                         <th>DIMENSION</th>
                         <th>PERFORATION</th>
                         <th>QUANTITE</th>
                         <th>REASSORT</th>
                         <th>RABAT</th>
                         <th>PERFORATION</th>
                         <th>CYLINDRE</th>
                         <th>OBSERVATION</th>
                     </tr>
                 </thead>
                 <tbody class="bg-default text-dark tbody">

                 </tbody>
             </table>
         </div>
     </div>
     <script>
         $(document).ready(function() {
             $('.dataTableData').DataTable({
                 processing: true,
                 ajax: base_url + 'Planning/bonReconsialisation',
                 language: {
                     url: base_url + "assets/dataTableFr/french.json"
                 },
                 rowCallback: function(row, data) {
                    action();
                 },
                 initComplete: function(setting) {
                    action();
                 }

             });

             function action() {
                 $('.tbody > tr').on('click', function() {
                     var  Po = $(this).children().first().next().text();
                     $.post(base_url+'Planning/detailPo',{PO:Po},function(data){
                        $('.cont-const').empty().append(data);
                     });
        
                 });
             }

         });
     </script>