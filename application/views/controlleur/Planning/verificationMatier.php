
 <div class="card">
   <div class="card-header bg-dark text-white">
      <b> VERIFICATION MATIER</b>
   </div>
<div class="card-body">
<fieldset class="col-md-12 border">   
        <div class="row text-right">
                <div class="form-group">
                    <input type="text"  class="form-control form-control-sm poex" placeholder="Entre PO">  
                </div>  
                <div class="form-group">
                   <a href="#" class="btn btn-success btn-sm  afficherPO" style="margin-top: -3px;"><i class="fa fa-plus"></i></a>
               </div>    
        </div>        
</fieldset>  
<span class="isertTAble"> 
</span>    
   </div>
  </div>  
</div>  
<script>
  $(document).ready(function(){

     $('.inputPO').on('change',function(){
    var param= $('.inputPO').val().trim();
    $.post(base_url+"Production/recherchePE",{param:param},function(data){
      if(data.result==""){
        alertMessage("Erreur","PO Introvable","error","btn btn-danger");
      }  
    },'json');
  });
  $('.poex').autocomplete({
    source : base_url + "Production/autocompletPo",
    select : function(ui,iteme){
    }
  });
  $('.afficherPO').on('click',function(event){
    event.preventDefault();
    var param= $('.poex').val().trim();
    if(param==""){
      alertMessage("Erreur","PO Introvable","error","btn btn-danger");
    }else{
      chargement();
      $.post(base_url+"Planning/recherchePOVerifier",{param:param},function(data){
        if(data==" "){
          closeDialog(); 
          alertMessage("Erreur","PO Introvable","error","btn btn-danger");
          $('.isertTAble').empty().append();
        }else{
          $('.po').val(param);
          $('.isertTAble').empty().append(data);
          $('.DataTable').DataTable();
          closeDialog(); 
        } 
      });
    }


  });


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







