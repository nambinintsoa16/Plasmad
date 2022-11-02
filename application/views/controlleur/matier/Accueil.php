<div class="card-header bg-dark text-white w-100">
      <b>SUIVI MATIERE</b>
   </div>
<div class="row">
						<div class="col-sm-6 col-lg-3 btn-click-link">
								<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-success mr-3">
										<i class="fa fa-coins"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><small>STOCK MATIERE PREMIERE</small></b></h5>
										<small class="text-muted"></small>
									</div>
								</div>
							</div>
						</div>	
				

						<div class="col-sm-6 col-lg-3 btn-click-link">
							<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-secondary mr-3">
										<i class="fas fa-list"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><small>LISTE DES ENTREES MATIERE PREMIERE</small></b></h5>
										<small class="text-muted"></small>
									</div>
								</div>
							</div>
						</div>

					

						<div class="col-sm-6 col-lg-3 btn-click-link">
							<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-info mr-3">
										<i class="fas fa-list-ul"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><small>LISTE DES SORTIES MATIERE PREMIERE</small></b></h5>
										<small class="text-muted"></small>
									</div>
								</div>
							</div>
						</div>	



                        <div class="col-sm-6 col-lg-3 btn-click-link">
                            <div class="card p-3">
                                <div class="d-flex align-items-center">
                                    <span class="stamp stamp-md bg-success mr-3">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div>
                                        <h5 class="mb-1"><b><small>VALIDER SORTIE MATIER</small></b></h5>
                                        <small class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>  


              <div class="col-sm-6 col-lg-3 btn-click-link">
              <div class="card p-3">
                <div class="d-flex align-items-center">
                  <span class="stamp stamp-md bg-info mr-3">
                    <i class="fas fa-list-ul"></i>
                  </span>
                  <div>
                    <h5 class="mb-1"><b><small>RECAP MATIERE PREMIERE</small></b></h5>
                    <small class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>  
            
						
</div>			
<span class="main-matier">
	
</span>
<script type="text/javascript">
	$(document).ready(function(){
		 $.post(base_url+"Controlleur/page",{page:"STOCK MATIERE PREMIERE"},function(data){
      $('.main-matier').empty().append(data);
      actionMatierPremier();
   });


  $('.btn-click-link').on('click',function(e){
         e.preventDefault();
         var page = $(this).children().find('b').text();
         chargement();
         $.post(base_url+"Controlleur/page",{page:page},function(data){
              $('.main-matier').empty().append(data);
              $('.link').text("MATIERE PREMIERE / "+page);
              if(page=="SORTIE MATIERE PREMIERE"){
                   sortieMPremier();
              }else if(page=="STOCK MATIERE PREMIERE"){
                  actionMatierPremier();
              }else if(page=="ENTREE MATIERE PREMIERE"){
                  actinApprove();
              }
              closeDialog();
         });
      
     });

  function actionMatierPremier(){
   var table = $('.dataTable').dataTable({
            processing: true,
                 ajax:"magasiner/liseteMPremierData",
                 language: {
                      url :base_url+"assets/dataTableFr/french.json"
                    },
               "rowCallback": function (row, data) {
               
               },
               initComplete : function(setting){
         
              },
               "drawCallback": function( settings ) {
               
               }
             });
    $('form').on('submit',function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('.file')[0].files[0];
        fd.append('file',files);
        chargement();
         $.ajax({
           
            url: base_url +'magasiner/update_matierPremier',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                  closeDialog();
                 swal("Erreur ", "Veuillez réessayer!", {
                            icon : "error",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-danger'
                                }
                            },
                        });      
                }else{
                  //table.ajax.reload();
                  closeDialog();
                    
                }
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



}

function chargement(){
  var htmls='<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
  $.dialog({
    "title": "",
    "content": htmls,
    "show": true,
    "modal": true,
    "close": false,
    "closeOnMaskClick": false,
    "closeOnEscape": false,
    "dynamic": false,
    "height": 150,
    "fixedDimensions": true
  });   
    
    
  }
  
  function closeDialog(){
   $('.jconfirm').remove();
  }
          
	});
</script>