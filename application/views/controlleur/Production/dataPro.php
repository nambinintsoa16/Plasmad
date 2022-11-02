 <div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>PROGRESSION</b> : PO N° <span class="po"><?=$PO?></span>
   </div>
<div class="card-body">
<div class="row">
	<p >  
<div class="form-control text-left col-md-12 w-100">
 <a href="#" class="btn btn-warning btn-sm liknk" id="extrusion"><i class="fa fa-plus"></i>&nbsp;EXTRUSION</a>
</div>  
</p>            
 <table class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableOperateurEX" style="font-size: 13px!important;"  id="EXTRUSION">
            <thead class="bg-dark text-white text-center text-xm">
                <tr>
                    <th>DATE</th>
                    <th>PO</th>
                    <th>METRE</th>
                    <th>POIDS (Kg)</th>
                    <th>DECHETS</th>
                    <th>POID NET</th>
                    <th>DURE</th>
                    <th>QUART</th>
                    <th>N°MACHINE</th>
                    <th>N°RLX</th>
                    <th>NB ROULAUX</th>
                    <th>TAILL</th>
                    <th>CHEF EQUIPE</th>
                    <th>OPERATEUR 1</th>
                    <th>OPERATEUR 2</th>
                    <th>OBSERVATION 1</th>
                </tr>
                </thead>
                <tbody class="tbody tbody-TableOperateurEX">
                </tbody>
           </table>

<p> 
<div class="form-control text-left col-md-12 w-100">
 <a href="#" class="btn btn-warning btn-sm liknk" id="exinpression"><i class="fa fa-plus"></i>&nbsp;INPRESSION</a>
</div>
</p>
<table class="text-xm table-bordered table-sm  table-responsive table-hover w-100 table-strepted TableOperateurINPRESS table-modif" >
            <thead class="bg-dark text-white text-center text-xm">
                <tr>
                    <th>DATE</th>
                    <th>PO</th>
                    <th>METRAGE</th>
                    <th>POIDS</th>
                    <th>DECHET</th>
                    <th>POID NET</th>
                    <th>DURE</th>
                    <th>EQUIPE</th>
                    <th>OPERATEUR 1</th>
                    <th>OPERATEUR 2</th>
                    <th>QTIME</th>
                    <th>N°MACHINE</th>
                    <th>TAILLE</th>
                    <th>RESTE GAINE</th>
                    <th>N°RLX</th>
                    <th>OBSERVATION</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
           </table> 

<p> 
<div class="form-control text-left col-md-12 w-100">
 <a href="#" class="btn btn-warning btn-sm liknk" id="excoupe"><i class="fa fa-plus"></i>&nbsp;COUPE</a>
 </div> 
</p>

 <table class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableDecoupeEX table-modif" >
            <thead class="bg-dark text-white text-center text-xm">
                <tr>
                    <th>DATE</th>
                    <th>PO</th>
                    <th>N°RLX</th>
                    <th>METRAGE</th>
                    <th>POID ENTREE</th>
                    <th>1ER CHOIX</th>
                    <th>POID SORTIE</th>
                    <th>2E CHOIX</th>
                    <th>DECHET</th>
                    <th>GAINE TIRE</th>
                    <th>EQUIPE</th>
                    <th>OPERATEUR 1</th>
                    <th>OPERATEUR 2</th>
                    <th>OPERATEUR 3</th>
                    <th>QC</th>
                    <th>TAILL</th>
                    <th>QUART</th>
                    <th>MACHINE</th>
                    <th>REST GAINE</th>
                    <th>OBSERVATION 1</th>
                    <th>OBSERVATION 2</th>
                    
                </tr>
                </thead>
                <tbody>
                </tbody>
           </table> 

</div>
</div>
<script>
$(document).ready(function(){
    var PO = $('.po').text();
    var TableDecoupeEX = $('.TableDecoupeEX').DataTable({
    processing: true,
    ajax:base_url+'Planning/exdecoupe?PO='+PO,
    language: {
           url :base_url+"assets/dataTableFr/french.json"
         },
  rowCallback: function (row, data) {
 
  },
   initComplete : function(setting){
       $('.tbody-TableOperateurEX td').on('click',function(event) {
      event.preventDefault(); 
      var $parent=$(this).parent().parent().attr('class').split(" ");
      //var type = $parent.text();
      var $type =  $parent[1];
      $.post(base_url+'Production/formulaire', {type: $type}, function(data, textStatus, xhr) {
         $('#exampleModalCenter .modal-body').empty().append(data);
         $('#exampleModalCenter').modal('show');
      });
       
       });   
     }
  });
    var TableOperateurINPRESS =$('.TableOperateurINPRESS').DataTable({
    processing: true,
    ajax:base_url+'Planning/extrusioninpression?PO='+PO,
    language: {
           url :base_url+"assets/dataTableFr/french.json"
         },
  rowCallback: function (row, data) {
 
  },
   initComplete : function(setting){
       $('.tbody-TableOperateurEX td').on('click',function(event) {
      event.preventDefault(); 
      var $parent=$(this).parent().parent().attr('class').split(" ");
      //var type = $parent.text();
      var $type =  $parent[1];
      $.post(base_url+'Production/formulaire', {type: $type}, function(data, textStatus, xhr) {
         $('#exampleModalCenter .modal-body').empty().append(data);

         $('#exampleModalCenter').modal('show');
      });
       
       });   
     }

  });
  
  tableEX =$('.TableOperateurEX').DataTable({
         processing: true,
        ajax:base_url+'Planning/tableEX?PO='+PO,
        language: {
               url :base_url+"assets/dataTableFr/french.json"
             },
      rowCallback: function (row, data) {
     
      },
       initComplete : function(setting){
           $('.tbody-TableOperateurEX td').on('click',function(event) {
          event.preventDefault(); 
          var $parent=$(this).parent().parent().attr('class').split(" ");
          //var type = $parent.text();
          var $type =  $parent[1];
          $.post(base_url+'Production/formulaire', {type: $type}, function(data, textStatus, xhr) {
             $('#exampleModalCenter .modal-body').empty().append(data);
             $('#exampleModalCenter').modal('show');
          });
           
           });   
         }
      });

});
</script>
