$(document).ready(function(){
    var Table = $(".dataTableLite").DataTable({
        processing: true,
        ajax:base_url+'Administrateur/datamachine',
        language: {
                   url :base_url+"assets/dataTableFr/french.json"
                 },
        rowCallback: function (row, data) {
 
        },
       initComplete : function(setting){
  
 
       }
});
$('.saveuser').on('click',function(e){
    e.preventDefault();
    var MA_DESIGNATION = $('.MA_DESIGNATION').val();
    var MA_SPECIFIQUE = $('.MA_SPECIFIQUE option:selected').val();
    if($('.MA_DESIGNATION').val()==""){
        alertMessage("","Champ designation obligatoire","error","btn btn-danger");
    }else{
         $.post(base_url+'Administrateur/saveMachine',{MA_DESIGNATION:MA_DESIGNATION,MA_SPECIFIQUE:MA_SPECIFIQUE},function(){
             $('.MA_DESIGNATION').val("");
             alertMessage("","Machine enregistre","success","btn btn-success");
         });
   }
});

function alertMessage(title,message,icons,btn){
    swal(title,message, {
        icon : icons,
        buttons: {        			
            confirm: {
                className : btn
                     }
                },
        });

}

});