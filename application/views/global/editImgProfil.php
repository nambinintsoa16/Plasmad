<style>
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}

.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.imageAcc{
    height:500px!important;
    background: url('/assets/img/logo.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    
}
.image-pub{
    object-fit: contain;
    width:800px;
    height:215px;
}
</style>
<div class="container p-2 mt-3" style="background:#F7F3F3;">
<div class="card p-2 ">
    <div class="row">
      <form class="form w-100" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group col-md-12 p-auto  text-center">
		  	<img src="<?=base_url('asset/images/img/profile2.jpg')?>" id="preview" class="img img-thumbnail" style="width: 150px; height: 150px;" /><br/>
			<div class="fileUpload btn btn-primary mr-2">
   				<span>Choisir images</span>
    			<input id="image" type="file" class="image upload"  name="image"/>
			</div> 
        </div>
         <div class="form-group col-md-12 ">
            <label>Lien Facebook</label>
            <input type="text" class="form-control lienFb" name="lienFb" placeholder="Saisir son lien">
        </div>
        <div class="form-group col-md-12 ">
            <label>Compte Facebook</label>
            <input type="text" class="form-control compteFb" name="compteFb" placeholder="Saisir un compte facebook">
        </div>
          <div class="form-group col-md-12 ">
            <div class="row">
               <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success mr-2">ENREGISTRER</button><button type="reset" class="btn btn-danger">ANNULER</button>
               </div>
            </div>
          </div>
        </div>
    </div>
    </form>
</div>

<script>
$(document).ready(function(){

   $('#image').on('change', (e) => {
            let that = e.currentTarget
            if (that.files && that.files[0]) {
                $(that).next('.custom-file-label').html(that.files[0].name)
                let reader = new FileReader()
                reader.onload = (e) => {
                    $('#preview').attr('src', e.target.result)
                }
                reader.readAsDataURL(that.files[0])
            }
        });
 $('form').on('submit',function(event){
     event.preventDefault();
    var $this=$(this); 
           var url=$this.attr('action');
           var attrId=$this.attr('id');
            var formData = new FormData(this);
                    $.ajax({
                    type:'POST',
                    url: "/Participant/Save",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                    this.reset();
                             
                    },
                    error: function(data){
                                            
                    }
                });
        });
});
</script>
   
