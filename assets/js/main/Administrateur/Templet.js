$(document).ready(function(){

    $('.FOR_DESIGNATION').autocomplete({
           source:base_url+"Administrateur/autocompleteFormule"
    });
	  $('form').on('submit',function(event){
            event.preventDefault();
             var $this=$(this); 
             var formData = new FormData(this);
            /* $.post(base_url+'Administrateur/caltculPrix',{param:formData},function(data){
                 console.log(data);
             });*/
                var link = $('.form').attr('action');
                $.ajax({
                    type:'POST',
                    url:base_url+link,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                    this.reset();
                      $('.content-table').empty().append(data);
                    },
                    error: function(data){
                        swal("Erreur ", "Veuillez réessayer!", {
                            icon : "error",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-danger'
                                }
                            },
                        });                        
                    }
                });
     
       });      
Table = $('.tablePrixAppliquer').DataTable({
            processing: true,
            ajax: base_url+"Administrateur/dataListePrix",
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
           
            "rowCallback": function(row, data) {
                dataAction();
            },
            initComplete: function(setting) {
                dataAction();
            },
            "drawCallback": function(settings) {
                dataAction();
            }
        });
function dataAction(){
  $('.editStatut').on('click',function(e){
    e.preventDefault()
    let id =$(this).attr('id');
    $.post(base_url+"Administrateur/editStatutPrixApp",{id},function(){
        Table.ajax.reload();
    });

  })
}
});