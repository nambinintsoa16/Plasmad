 <div class="card w-100">
     <div class="card-header bg-dark text-white">
         <b>RECONCILIATION</b>
         <b class="pull-right">
             <form action="" method="post">
                 <label>DATE DEBUT : </label>
                 <input type="date" class="mr-3 debut" name="findate">
                 <label>DATE FIN: </label>
                 <input type="date" class="mr-3 fin" name="findate">
                 <button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
                     Afficher</button>
             </form>
         </b>
     </div>
     <div class="card-body">

         <div class="table-responsive dataC">


         </div>
     </div>
     <script>
         $(document).ready(function() {
             var debut = $('.debut').val();
             var fin = $('.fin').val();
             $.post(base_url + "Planning/dataCOst", {

                 fin: fin,
                 debut: debut
             }, function(data) {
                 $('.dataC').empty().append(data);

             });

             $('.AfficherCost').on('click', function(e) {
                 e.preventDefault();
                 var debut = $('.debut').val();
                 var fin = $('.fin').val();
                 $.post(base_url + "Planning/dataCOst", {

                     fin: fin,
                     debut: debut
                 }, function(data) {
                     $('.dataC').empty().append(data);

                 });

             });
         });
     </script>