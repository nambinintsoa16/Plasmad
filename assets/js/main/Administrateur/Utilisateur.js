$(document).ready(function(){
    Table = $(".dataTableLite").DataTable({
        processing: true,
        ajax:base_url+'Utilisateur/dataListe',
        language: {
              url :'https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
             },
       "columnDefs":[
                 {
                   "targets":[0, 3, 4],
                   "orderable":false,
                 },
               ],
      rowCallback: function (row, data) {

      }

  });

 TalbleOperateur =$(".dataTableListe").DataTable({
    processing: true,
    ajax:base_url+'Utilisateur/datalisteOperateur',
    language: {
          url :'https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
         },
   "columnDefs":[
             {
               "targets":[0, 3, 4],
               "orderable":false,
             },
           ],
  rowCallback: function (row, data) {

  }

});

  $('tbody .delete_post').on('click',function(e){
    e.preventDefault();
    var id=$('.id').val();
    $.post(base_url+'Utilisateur/updateStatut',{id:id},function(data){  
    if(data.message==='true'){
        swal("", "Utilisateur désactivé!", {
            icon : "success",
            buttons: {        			
                confirm: {
                    className : 'btn btn-success'
                         }
                    },
            });
    } 
  },'json');
});
  



$('.saveuser').on('click',function(e){
    e.preventDefault();
    var UT_CODE=$('.UT_CODE').val(); 
    var UT_NOM=$('.UT_NOM').val();
    var UT_PRENOM=$('.UT_PRENOM').val();
    var UT_MOT_DE_PASS=$('.UT_MOT_DE_PASS').val();
    var UT_PROFIL=$('.UT_PROFIL option:selected').val();
    var UT_MOT_DE_PASS_C=$('.UT_MOT_DE_PASS_C').val();

if(UT_CODE==''){
    alertMessage("Ooops!","Matricule obligatoire",'warning',"btn btn-warning");
}else if(UT_NOM==''){
    alertMessage("Ooops!","Nom obligatoire","warning","btn btn-warning");
}else if(UT_PRENOM==''){
    alertMessage("Ooops!","Le Prénom obligatoire","warning","btn btn-warning");
}else if(UT_MOT_DE_PASS==''){
    alertMessage("Ooops!","Mot de pass vide","warning","btn btn-warning");
}else if(UT_MOT_DE_PASS_C==''){   
    alertMessage("Ooops!","Mot de pass de conrimation vide","warning","btn btn-warning");
}else if(UT_MOT_DE_PASS_C != UT_MOT_DE_PASS){
    alertMessage("Ooops!","Les deux mot de pass son different","warning","btn btn-warning");
}else{

    $.post(base_url+'Utilisateur/saveutilisateur',{UT_CODE:UT_CODE, UT_NOM:UT_NOM, UT_PRENOM:UT_PRENOM, UT_MOT_DE_PASS:UT_MOT_DE_PASS, UT_PROFIL:UT_PROFIL},function(data){
        if(data.message==='true'){
            swal("", "Utilisateur enregistre", {
                icon : "success",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-success'
                             }
                        },
                });
                $('.UT_CODE').val(""); 
                $('.UT_NOM').val("");
                $('.UT_PRENOM').val("");
                $('.UT_MOT_DE_PASS').val("");
                $('.UT_MOT_DE_PASS_C').val("");  
        }
    },'json');
}

});




  $('.modifierUtilisateur').on('click',function(e){
           e.preventDefault();
           var pass = $('.pass').val();
           var profils = $('.type').val();
           var id=$('.id').val();
    if(pass==''){
        swal("Oops!", "Le nouveau mot de passe est obligatoire", {
			icon : "warning",
			buttons: {        			
				confirm: {
					className : 'btn btn-warning'
						 }
					},
			});
    }else{

       
    $.post(base_url+'Utilisateur/updateUser',{pass,pass,profils:profils,id:id},function(data){
        if(data.message==='true'){
            swal("", "Le mot de passe à étè modifier!", {
                icon : "success",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-success'
                             }
                        },
                });
                $('.pass').val("");      
        }
    },'json');
} 
          
});
    
			
		$('.table-click').on('click',function(e){
			e.preventDefault();
			var damande = $(this).attr('id');
			window.location.replace(base_url+'Administrateur/Detail_fiche/'+damande);
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