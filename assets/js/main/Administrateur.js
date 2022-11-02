$(document).ready(function(){
    /*Table = $(".dataTableInstance").DataTable({
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
      rowCallback: function (row, data) {}
          
  });*/

	
             
			
		$('.table-click').on('click',function(e){
			e.preventDefault();
			var damande = $(this).attr('id');
			window.location.replace(base_url+'Administrateur/Detail_fiche/'+damande);
		});
			
});