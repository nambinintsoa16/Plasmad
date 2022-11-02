$(document).ready(function() {
	 chargement();
 $.post(base_url+"Production/page",{page:"PLANNING DU JOUR"},function(data){
			 $('.main').empty().append(data);
      planning_du_jour(); 
	  stopload();
 });
	$('.btn-click').on('click',function(e){
		e.preventDefault();
		var page = $(this).children().find('b').text();
		$('.linkChange').text(page);
		chargement();
		$.post(base_url+"Production/page",{page:page},function(data){
			 $('.main').empty().append(data);
			 if(page=="CREE FICHE" ){
				stopload(); 
			    fiche();
			 }else if(page=="PLANNING DU JOUR"){
				planning_du_jour(); 
				stopload();
			}else if(page=="PROCESSUS EN COURS"){
				proccessus();
				stopload();	
			}else if(page=="TERMINER"){
				terminer();	
				stopload();	
			}else if(page=="VERIFICATION MATIERES"){
				verification();	
				stopload();		
			}else if(page=="QC"){
				control();	
				stopload();		
					
			}else if(page=="STOCKS MATIERES PREMIERES"){
			 actionMatierPremier();	
			 stopload();			
			}else{
				//produitFini();
			     stopload();	
			 }
		});
		  
	});
function actionMatierPremier(){
  
    


}

function stopload(){
	 $('.jconfirm').remove();
}
function terminer(){
	var TableProduction = $(".TableProduction").DataTable({
		processing: true,
		ajax:base_url+'Production/TableTerminer',
		language: {
				   url :base_url+"assets/dataTableFr/french.json"
				 },
	rowCallback: function (row, data) {
 
	},
	 initComplete : function(setting){
		$('.TableProduction td').on('click',function(event) {
			event.preventDefault();
			var pe =  $(this).parent().children().eq(1).text();
	$.post(base_url+"Production/detailPE",{pe:pe},function(data){
			$(".BC_PE").val(data.BC_PE);
			$(".date").val(data.BC_DATE);
			$(".BC_CLIENT").val(data.BC_CLIENT);
			$('.JO_ID').val(data.JO_ID);
			$(".BC_CODE").val(data.BC_CODE);
			$(".BC_DATELIVRE").val(data.BC_DATELIVRE);
			$(".BC_REASSORT").val(data.BC_REASSORT);
			$(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);	 
			$(".BC_DIMENSION").val(data.BC_DIMENSION);
			$(".BC_RABAT").val(data.BC_RABAT);
			$(".BC_SOUFFLET").val(data.BC_SOUFFLET);
			$(".BC_PERFORATION").val(data.BC_PERFORATION);
			$(".BC_TYPE option:selected").val(data.BC_TYPE);
			$(".BC_IMPRESSION").val(data.BC_IMPRESSION);
			$(".BC_QUNTITE").val(data.BC_QUNTITE);
			$(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
			$(".BC_PRIX").val(data.BC_PRIX);
			$(".BC_OBSERVATION").val(data.BC_OBSERVATION);			
			   $('#modaleInfo').modal('show');
},"json");				

		 
		   });
 
	}
 });
}
function planning_du_jour(){
	var TableProduction = $(".TableProduction").DataTable({
			processing: true,
			ajax:base_url+'Production/TableProduction',
			language: {
			       	url :base_url+"assets/dataTableFr/french.json"
					 },
		rowCallback: function (row, data) {
     
		},
         initComplete : function(setting){
            $('.TableProduction td').on('click',function(event) {
            	event.preventDefault();
            	var pe =  $(this).parent().children().eq(1).text();
		$.post(base_url+"Production/detailPE",{pe:pe},function(data){
				$(".BC_PE").val(data.BC_PE);
				$(".date").val(data.BC_DATE);
				$(".BC_CLIENT").val(data.BC_CLIENT);
				$('.JO_ID').val(data.JO_ID);
				$(".BC_CODE").val(data.BC_CODE);
				$(".BC_DATELIVRE").val(data.BC_DATELIVRE);
				$(".BC_REASSORT").val(data.BC_REASSORT);
				$(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);	 
				$(".BC_DIMENSION").val(data.BC_DIMENSION);
				$(".BC_RABAT").val(data.BC_RABAT);
				$(".BC_SOUFFLET").val(data.BC_SOUFFLET);
				$(".BC_PERFORATION").val(data.BC_PERFORATION);
				$(".BC_TYPE option:selected").val(data.BC_TYPE);
				$(".BC_IMPRESSION").val(data.BC_IMPRESSION);
				$(".BC_QUNTITE").val(data.BC_QUNTITE);
				$(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
				$(".BC_PRIX").val(data.BC_PRIX);
				$(".BC_OBSERVATION").val(data.BC_OBSERVATION);			
   				$('#modaleInfo').modal('show');
	},"json");				
	
		     
	           });
     
        }
	 });
	}
tableEX =$('.TableOperateurEX').DataTable({
 	        processing: true,
			ajax:base_url+'Production/tableEX',
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

 var tableIN =$('.TableOperateurIN').DataTable({
 	        processing: true,
			ajax:base_url+'Production/tableIN',
			language: {
			       	url :base_url+"assets/dataTableFr/french.json"
					 },
		rowCallback: function (row, data) {
     
		},
         initComplete : function(setting){
            $('.TableProduction td').on('click',function(event) {
            	event.preventDefault();
            	var pe =  $(this).parent().children().eq(1).text();
		$.post(base_url+"Production/detailPE",{pe:pe},function(data){
				$(".BC_PE").val(data.BC_PE);
				$(".date").val(data.BC_DATE);
				$(".BC_CLIENT").val(data.BC_CLIENT);
				$('.JO_ID').val(data.JO_ID);
				$(".BC_CODE").val(data.BC_CODE);
				$(".BC_DATELIVRE").val(data.BC_DATELIVRE);
				$(".BC_REASSORT").val(data.BC_REASSORT);
				$(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);	 
				$(".BC_DIMENSION").val(data.BC_DIMENSION);
				$(".BC_RABAT").val(data.BC_RABAT);
				$(".BC_SOUFFLET").val(data.BC_SOUFFLET);
				$(".BC_PERFORATION").val(data.BC_PERFORATION);
				$(".BC_TYPE option:selected").val(data.BC_TYPE);
				$(".BC_IMPRESSION").val(data.BC_IMPRESSION);
				$(".BC_QUNTITE").val(data.BC_QUNTITE);
				$(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
				$(".BC_PRIX").val(data.BC_PRIX);
				$(".BC_OBSERVATION").val(data.BC_OBSERVATION);
								
    $('#modaleInfo').modal('show');
	},"json");				
	
		     
	           });
        }
          });

$('.removeModal').on('click',function(e){
	e.preventDefault();
	 $('#modaleInfo').modal('hide');
});
function fiche(){
$('.creetfiche').on('click',function(e){
	e.preventDefault();
         $('.nav-link').removeClass('active');
         $('.creetfiches').addClass('active');
         $('.tab-pane').removeClass('active');
         $('#fiche').addClass('active');
         $('#modaleInfo').modal('hide');
});

    $( ".Operateur" ).autocomplete({
            source: base_url+"Production/autocompleteOperateur"
	});

    $( ".chefEquipe" ).autocomplete({
            source: base_url+"Production/autocompleteOperateur"
	});

	$('.add-table').on('click',function(e){
		e.preventDefault();
	   var cont = $('.Operateur').val().split('|');
	   var equipe = $('.chefEquipe').val().split('|');
	   $('.tbody-equipe').append('<tr><td>'+$('.BC_PE').val()+'</td>'+
	   '<td>'+$('.JO_ID').val()+'</td>'+
	   '<td>'+equipe[1]+'</td>'+
	   '<td>'+$('.J_N option:selected').val()+'</td>'+
	   '<td>'+cont[1]+'</td>'+
	   '</td><td><a href="#" class="text-danger delTab"><i class="fa fa-trash"></i></a></td></tr>')
	   $('.Operateur').val("");
	   del();
   });

 $('.creetfiches_btn').on('click',function(e){
	 e.preventDefault();
	 var i = $('.table-ficher tr').length;
      $('.chefEquipe').val("");
	 $('.tbody-equipe tr').each(function(){
		var PO =  $(this).children().eq(0).text();
		var JBO = $(this).children().eq(1).text();
		var EQ =  $(this).children().eq(2).text();
		var QR =  $(this).children().eq(3).text();
		var OP =  $(this).children().eq(4).text();
		var DC_PRO = $('.DC_PRO option:selected').val();
		var Dt = $('.Date').val();
         i = i-1;
		$.post(base_url+'Production/creeFiche',{PO:PO,JBO:JBO,EQ:EQ,QR:QR,OP:OP,Dt:Dt,DC_PRO:DC_PRO},function(data) {
		   if(i==1){	
				if(data.message ==true){
               		 alertMessage('','Fiche créée','success','btn btn-success');
               		  $('.tbody-equipe').empty();

				}else{
					alertMessage('','Fiche non créée, veuillez réessayer!','error','btn btn-danger');
				}
		   }	
		},'json');
		
		  
	 });
	

 });
} 

function dataTableExtrusion(){
	
}

function proccessus(){
$.post(base_url+"Production/dataPross",{page:"EXTRUSION"},function(data){
	$('.data-cont').empty().append(data);
	dataTableExtrusion();
});	

$('.linksTabs').on('click',function(event){
	event.preventDefault();
	var page = $(this).text().trim();
	$.post(base_url+"Production/dataPross",{page:page},function(data){
		$('.data-cont').empty().append(data);
		if(page=="EXTRUSION"){
			dataTableExtrusion();
		}else{
		  $('.datatable').DataTable();
		  injectiondata();
		}
	
	});	
	

});
}
function produitFini(){
	$(".tableProduitFini").dataTable({
	   processing: true,
	   ajax:base_url+"Magasiner/dataProduitFini",
	   language: {
			  url :base_url+"assets/dataTableFr/french.json"
			},
	  "columnDefs":[
				{
				  "targets":[6],
				  "orderable":false,
				  
				}
			  ],
	 "rowCallback": function (row, data) {
   
	 },
	 initComplete : function(setting){
	  
	  },
	 "drawCallback": function( settings ) {
	 
	 }
	  });
 }   
function control(){
	
 }
function injectiondata(){
   $('.liknk').on('click',function(event){
		event.preventDefault();
		$('#ModalTitles').text($(this).text());
		var param= "injection";
		var link = $(this).text().trim();
		$.post(base_url+'Production/formulaires', {param: param}, function(data, textStatus, xhr) {
		  if(data!=1){
			  $('.form').attr('action',link);
			  $('.form').attr('id',link);
			  $('.body-content').empty().append(data);
			  $('.mm').autocomplete({
			   source : base_url + "Production/autocompletMa",
			   appendTo:"#modalProccess"
		      });
			   $('.poex').autocomplete({
			   source : base_url + "Production/autocompletPo",
			   appendTo:"#modalProccess"
		   });
           $('.op').autocomplete({
			   source : base_url + "Production/autocompleteOperateurs",
			   appendTo:"#modalProccess"
		   });
		   

		   $('#modalProccess').modal('show');
		   }
		});
   });
}
$('form').on('submit',function(event){
	event.preventDefault();
	var formData = new FormData(this);
	var $this=$(this); 
    var url=$this.attr('action');
    var attrId=$this.attr('id');
     $.ajax({
                    type:'POST',
                    url: base_url+"Production/save"+url,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                    this.reset();
                     if(url=="saveparticipant"){
                        $('#preview').attr('src',"assets/img/profile2.jpg"); 
                        var nb=$('.nb-participant').text();
                        $('.nb-participant').text(parseInt(nb)+1);
                        if(attrId=="saveparticipant"){
                            ckeckAtt(data);
                        }else{
                            $this.removeAttr('id');
                            $this.removeAttr('action');
                            swal("", "Participant enregistré avec succès", {
                                icon : "success",
                                buttons: {
                                    confirm: {
                                        className : 'btn btn-success'
                                    }
                                },
                            });
                        }
                        
                     }else if(url=='existpart'){

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
 function formLoad(){
 	$('.tbody tr').on('click',function(){
		$('#table-modif').modal('show');
 	}); 
 }

 
function del(){  
  $('.delTab').on('click',function(e){
	  e.preventDefault();
	  $(this).parent().parent().remove();

  });
}  
	
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
function saveverififier(){
    $('.VM_ME').on('change',function(){
		var VM_ME = $(this).val();
		var VM_SUITE =$('.VM_SUITE').val();
		var VM_PDSNET = $('.VM_PDSNET').val();
		$('.VM_R1').val(VM_ME-(VM_SUITE+VM_PDSNET));
		$('.VM_R2').val((VM_ME-(VM_SUITE+VM_PDSNET))*-1);

	});


	$('.formVer').on('submit',function(event){
		event.preventDefault();
		var formData = new FormData(this);
		 $.ajax({
						type:'POST',
						url: base_url+"Production/saveverification",
						data: formData,
						cache:false,
						contentType: false,
						processData: false,
						success: (data) => {
						this.reset();
						   swal("", "Participant enregistré avec succès", {
								 icon : "success",
								buttons: {
								confirm: {
								   className : 'btn btn-success'
										}
									},
								});
						
					 
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

function verification(){
	$('.inputPO').on('change',function(){
		var param= $('.inputPO').val().trim();
		$.post(base_url+"Production/recherchePE",{param:param},function(data){
			if(data.result==""){
				alertMessage("Erreur","PO Introvable","error","btn btn-danger");
			}else{
			    $('.equipe').empty().append(data.result);	
			}    
		},'json');
	});
	$('.poex').autocomplete({
		source : base_url + "Production/autocompletPo",
		select : function(ui,iteme){
			var param= iteme.item.value.trim();
			$.post(base_url+"Production/recherchePE",{param:param},function(data){
				if(data.result==""){
					alertMessage("Erreur","PO Introvable","error","btn btn-danger");
				}else{
					$('.equipe').empty().append(data.result);	
				}    
			},'json');
		}
	});
	$('.afficherPO').on('click',function(event){
		event.preventDefault();
		var param= $('.poex').val().trim();
		var goupe = $('.equipe option:selected').val();
		var datePro = $('.datePro').val();
		if(param==""){
			alertMessage("Erreur","PO Introvable","error","btn btn-danger");
		}else if(goupe=="equipe"){	
			alertMessage("Erreur","PO Introvable","error","btn btn-danger");
		}else{
			chargement();
			$.post(base_url+"Production/recherchePOVerifier",{param:param,goupe:goupe,datePro:datePro},function(data){
				if(data==" "){
					stopload(); 
					alertMessage("Erreur","PO Introvable","error","btn btn-danger");
					$('.isertTAble').empty().append();
				}else{
					$('.po').val(param);
					$('.isertTAble').empty().append(data);
					saveverififier();
					stopload(); 
				}	
			});
		}
	

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
	
});