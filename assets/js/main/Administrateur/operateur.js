$(document).ready(function(){
	 TalbleOperateur =$(".dataTableListe").DataTable({
    processing: true,
    ajax:base_url+'Administrateur/datalisteOperateur',
    language: {
          url :'https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
         },
  
  rowCallback: function (row, data) {

  }
});
$('.saveuser').on('click',function(event){
   event.preventDefault();
   var OP_NOM =$('.OP_NOM').val();
   var OP_PRENOM =$('.OP_PRENOM').val();
   var OP_MATRICULES = $('.OP_MATRICULES').val();
   var OP_FONCTION = $('.OP_FONCTION option:selected').val();
   var OP_MACHINE = $('.OP_MACHINE option:selected').val();
   $.post(base_url+'Administrateur/saveOperateur',{OP_MACHINE:OP_MACHINE,OP_FONCTION:OP_FONCTION,OP_MATRICULES:OP_MATRICULES,OP_NOM:OP_NOM,OP_PRENOM:OP_PRENOM},function(data){  
    if(data==true){
     $('.OP_NOM').val("");
    $('.OP_PRENOM').val("");
     $('.OP_MATRICULES').val("");
        swal("", "Operateur enregistre!", {
            icon : "success",
            buttons: {        			
                confirm: {
                    className : 'btn btn-success'
                         }
                    },
            });
    }else{
      swal("Erreur", "Operateur non enregistre!", {
        icon : "success",
        buttons: {        			
            confirm: {
                className : 'btn btn-danger'
                     }
                },
        });
    }
  },'json');
});


});