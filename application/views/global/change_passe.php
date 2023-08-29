
<div class="form-group form-floating-label text-left">
    <input type="password" class="form-control input-border-bottom" id="old_pass" required>
    <label for="old_pass" class="placeholder">Ancien mot de passe</label>
</div>
<div class="form-group form-floating-label text-left">
    <input  type="password" class="form-control input-border-bottom" id="new_pass" required>
    <label for="new_pass" class="placeholder">Nouveau mot de passe</label>
</div>
<div class="form-group form-floating-label text-left">
    <input  type="password" class="form-control input-border-bottom" id="conf_pass" required>
    <label for="conf_pass" class="placeholder confirm_lable">Confimer mot de passe</label>
</div>
<script>
  $(document).ready(function(){
    
      $("#conf_pass").on("keyup",function(event){
        event.preventDefault();
           let new_pass = $("#new_pass").val();
           let confirm = $(this).val();
           if(new_pass !=confirm){
            if($(".confirm_lable").hasClass('text-success')){
                $(".confirm_lable").removeClass("text-success")
              }
              if(!$(".confirm_lable").hasClass('text-danger')){
                $(".confirm_lable").addClass("text-danger")   
              }
           }else{
            if($(".confirm_lable").hasClass('text-danger')){
                $(".confirm_lable").removeClass("text-danger")
                  
              }
            if(!$(".confirm_lable").hasClass('text-success')){
                $(".confirm_lable").addClass("text-success")
              }
           }
      });

  });
</script>