 <div class="card w-100">
     <div class="card-header bg-info text-white">
         <b>PROGRESSION</b> : PO N° <span class="po"><?= $refnum ?></span>
     </div>
     <div class="card-body">
         <div class="row">
             <p>
             <div class="form-control text-left col-md-12 w-100">
                 <a href="#" class="btn btn-warning btn-sm liknk" id="extrusion"><i class="fa fa-plus"></i>&nbsp;EXTRUSION</a>
             </div>
             </p>
             <table class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableOperateurEX" style="font-size: 13px!important;" id="EXTRUSION">
                 <thead class="bg-info text-white text-center text-xm">
                     <tr>
                         <th>DATE</th>
                         <th>PO</th>
                         <th>METRE</th>
                         <th>POIDS(Kg)</th>
                         <th>DECHETS</th>
                         <th>POIDS_NET</th>
                         <th>DUREE</th>
                         <th>QUART</th>
                         <th>N°MACHINE</th>
                         <th>N°RLX</th>
                         <th>NB_ROULAUX</th>
                         <th>TAILLE</th>
                         <th>CHEF_EQUIPE</th>
                         <th>OPERATEUR_1</th>
                         <th>OPERATEUR_2</th>
                         <th>OBSERVATION_1</th>
                     </tr>
                 </thead>
                 <tbody class="tbody tbody-TableOperateurEX">
                 </tbody>
                 <tfoot class="bg-warning text-white">
                     <tr>
                         <th>SOMME</th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th> </th>
                         <th> </th>
                         <th> </th>
                         <th> </th>

                     </tr>
                 </tfoot>
             </table>

             <p>
             <div class="form-control text-left col-md-12 w-100">
                 <a href="#" class="btn btn-warning btn-sm liknk" id="exinpression"><i class="fa fa-plus"></i>&nbsp;INPRESSION</a>
             </div>
             </p>
             <table class="text-xm table-bordered table-sm  table-responsive table-hover w-100 table-strepted TableOperateurINPRESS table-modif">
                 <thead class="bg-info text-white text-center text-xm">
                     <tr>
                         <th>DATE</th>
                         <th>PO</th>
                         <th>METRAGE</th>
                         <th>POIDS</th>
                         <th>DECHET</th>
                         <th>POIDS_NET</th>
                         <th>DUREE</th>
                         <th>EQUIPE</th>
                         <th>OPERATEUR_1</th>
                         <th>OPERATEUR_2</th>
                         <th>QTIME</th>
                         <th>N°MACHINE</th>
                         <th>TAILLE</th>
                         <th>RESTE_GAINE</th>
                         <th>N°RLX</th>
                         <th>OBSERVATION</th>
                     </tr>
                 </thead>
                 <tbody>
                 </tbody>
                 <tfoot class="bg-warning text-white">
                     <tr>
                         <th>SOMME</th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>

                         c
             </table>

             <p>
             <div class="form-control text-left col-md-12 w-100">
                 <a href="#" class="btn btn-warning btn-sm liknk" id="excoupe"><i class="fa fa-plus"></i>&nbsp;COUPE</a>
             </div>
             </p>

             <table class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableDecoupeEX table-modif">
                 <thead class="bg-info text-white text-center text-xm">
                     <tr>
                         <th>DATE</th>
                         <th>PO</th>
                         <th>N°RLX</th>
                         <th>METRAGE</th>
                         <th>POIDS_ENTREE</th>
                         <th>1ER_CHOIX</th>
                         <th>POIDS_SORTIE</th>
                         <th>2E_CHOIX</th>
                         <th>DECHET</th>
                         <th>GAINE_TIRE</th>
                         <th>EQUIPE</th>
                         <th>OPERATEUR_1</th>
                         <th>OPERATEUR_2</th>
                         <th>OPERATEUR_3</th>
                         <th>QC</th>
                         <th>TAILLE</th>
                         <th>QUART</th>
                         <th>MACHINE</th>
                         <th>REST_GAINE</th>
                         <th>OBSERVATION_1</th>
                         <th>OBSERVATION_2</th>

                     </tr>
                 </thead>
                 <tbody>
                 </tbody>
                 <tfoot class="bg-warning text-white">
                     <tr>
                         <th>SOMME</th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th> </th>
                         <th> </th>
                         <th> </th>
                         <th> </th>
                         <th></th>
                         <th> </th>
                         <th></th>
                         <th></th>
                         <th> </th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th> </th>
                         <th> </th>
                         <th> </th>
                     </tr>
                 </tfoot>

             </table>

         </div>
     </div>
     <script>
         $(document).ready(function() {
             var PO = $('.po').text();
             var TableDecoupeEX = $('.TableDecoupeEX').DataTable({
                 processing: true,
                 ajax: base_url + 'Planning/Sachet_coupe_data?PO=' + PO,
                 language: {
                     url: base_url + "assets/dataTableFr/french.json"
                 },
                 rowCallback: function(row, data) {

                 },
                 initComplete: function(setting) {
                     $('.tbody-TableOperateurEX td').on('click', function(event) {
                         event.preventDefault();
                         var $parent = $(this).parent().parent().attr('class').split(" ");
                         //var type = $parent.text();
                         var $type = $parent[1];
                         $.post(base_url + 'Production/formulaire', {
                             type: $type
                         }, function(data, textStatus, xhr) {
                             $('#exampleModalCenter .modal-body').empty().append(data);
                             $('#exampleModalCenter').modal('show');
                         });

                     });
                 },
                 "footerCallback": function(row, data, start, end, display) {
                     var api = this.api();

                     // Remove the formatting to get integer data for summation
                     var intVal = function(i) {
                         return typeof i === 'string' ?
                             i.replace(/[\$,]/g, '') * 1 :
                             typeof i === 'number' ?
                             i : 0;
                     };
                     var timestrToSec = function(timestr) {
                         var parts = timestr.split(":");
                         return (parts[0] * 3600) +
                             (parts[1] * 60) +
                             (+parts[2]);
                     }

                     function pad(num) {
                         if (num < 10) {
                             return "0" + num;
                         } else {
                             return "" + num;
                         }
                     }

                     var formatTime = function(seconds) {
                         return [pad(Math.floor(seconds / 3600)),
                             pad(Math.floor(seconds / 60) % 60),
                             pad(seconds % 60),
                         ].join(":");
                     }

                     total = api
                         .column(3)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);

                     dechet = api
                         .column(4)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);

                     poid = api
                         .column(5)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);


                     pageTotal = api
                         .column(2, {
                             page: 'current'
                         })
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);
                     time = api
                         .column(6, {
                             page: 'current'
                         })
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);

                         }, 0);

                     $(api.column(2).footer()).html(
                         pageTotal
                     );
                     $(api.column(3).footer()).html(
                         total
                     );
                     $(api.column(4).footer()).html(
                         dechet
                     );
                     $(api.column(5).footer()).html(
                         poid
                     );
                     $(api.column(6).footer()).html(
                         time
                     );
                 }
             });
             var TableOperateurINPRESS = $('.TableOperateurINPRESS').DataTable({
                 processing: true,
                 ajax: base_url + 'Planning/Sachet_impression_data?PO=' + PO,
                 language: {
                     url: base_url + "assets/dataTableFr/french.json"
                 },
                 rowCallback: function(row, data) {

                 },
                 initComplete: function(setting) {
                     $('.tbody-TableOperateurEX td').on('click', function(event) {
                         event.preventDefault();
                         var $parent = $(this).parent().parent().attr('class').split(" ");
                         //var type = $parent.text();
                         var $type = $parent[1];
                         $.post(base_url + 'Production/formulaire', {
                             type: $type
                         }, function(data, textStatus, xhr) {
                             $('#exampleModalCenter .modal-body').empty().append(data);

                             $('#exampleModalCenter').modal('show');
                         });

                     });
                 },
                 "footerCallback": function(row, data, start, end, display) {
                     var api = this.api();

                     // Remove the formatting to get integer data for summation
                     var intVal = function(i) {
                         return typeof i === 'string' ?
                             i.replace(/[\$,]/g, '') * 1 :
                             typeof i === 'number' ?
                             i : 0;
                     };
                     var timestrToSec = function(timestr) {
                         var parts = timestr.split(":");
                         return (parts[0] * 3600) +
                             (parts[1] * 60) +
                             (+parts[2]);
                     }


                     function pad(num) {
                         if (num < 10) {
                             return "0" + num;
                         } else {
                             return "" + num;
                         }
                     }

                     var formatTime = function(seconds) {
                         return [pad(Math.floor(seconds / 3600)),
                             pad(Math.floor(seconds / 60) % 60),
                             pad(seconds % 60),
                         ].join(":");
                     }

                     total = api
                         .column(3)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);

                     dechet = api
                         .column(4)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);

                     poid = api
                         .column(5)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);


                     pageTotal = api
                         .column(2, {
                             page: 'current'
                         })
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);
                     time = api
                         .column(6, {
                             page: 'current'
                         })
                         .data()
                         .reduce(function(a, b) {
                             //return   formatTime(intVal(timestrToSec(b))+intVal(timestrToSec(a)));

                             return intVal(a) + intVal(timestrToSec(b));

                         }, 0);

                     $(api.column(2).footer()).html(
                         pageTotal
                     );
                     $(api.column(3).footer()).html(
                         total
                     );
                     $(api.column(4).footer()).html(
                         dechet
                     );
                     $(api.column(5).footer()).html(
                         poid
                     );
                     $(api.column(6).footer()).html(
                         formatTime(time)
                     );
                 }

             });

             tableEX = $('.TableOperateurEX').DataTable({
                 processing: true,
                 ajax: base_url + 'Planning/Sachet_extrusion_data?PO=' + PO,
                 language: {
                     url: base_url + "assets/dataTableFr/french.json"
                 },
                 rowCallback: function(row, data) {

                 },
                 initComplete: function(setting) {
                     $('.tbody-TableOperateurEX td').on('click', function(event) {
                         event.preventDefault();
                         var $parent = $(this).parent().parent().attr('class').split(" ");
                         //var type = $parent.text();
                         var $type = $parent[1];
                         $.post(base_url + 'Production/formulaire', {
                             type: $type
                         }, function(data, textStatus, xhr) {
                             $('#exampleModalCenter .modal-body').empty().append(data);
                             $('#exampleModalCenter').modal('show');
                         });

                     });
                 },


                 "footerCallback": function(row, data, start, end, display) {
                     var api = this.api();

                     // Remove the formatting to get integer data for summation
                     var intVal = function(i) {
                         return typeof i === 'string' ?
                             i.replace(/[\$,]/g, '') * 1 :
                             typeof i === 'number' ?
                             i : 0;
                     };
                     var timestrToSec = function(timestr) {
                         var parts = timestr.split(":");
                         return (parts[0] * 3600) +
                             (parts[1] * 60) +
                             (+parts[2]);
                     }

                     function pad(num) {
                         if (num < 10) {
                             return "0" + num;
                         } else {
                             return "" + num;
                         }
                     }

                     var formatTime = function(seconds) {
                         return [pad(Math.floor(seconds / 3600)),
                             pad(Math.floor(seconds / 60) % 60),
                             pad(seconds % 60),
                         ].join(":");
                     }

                     total = api
                         .column(3)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);

                     dechet = api
                         .column(4)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);

                     poid = api
                         .column(5)
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);


                     pageTotal = api
                         .column(2, {
                             page: 'current'
                         })
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(b);
                         }, 0);
                     time = api
                         .column(6, {
                             page: 'current'
                         })
                         .data()
                         .reduce(function(a, b) {
                             return intVal(a) + intVal(timestrToSec(b));

                         }, 0);

                     $(api.column(2).footer()).html(
                         pageTotal
                     );
                     $(api.column(3).footer()).html(
                         total
                     );
                     $(api.column(4).footer()).html(
                         dechet
                     );
                     $(api.column(5).footer()).html(
                         poid
                     );
                     $(api.column(6).footer()).html(
                         formatTime(time)
                     );
                 }
             });
         });
     </script>