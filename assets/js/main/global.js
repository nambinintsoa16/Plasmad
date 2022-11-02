$(document).ready(function(){
	function alertCustum(title,containt,icon,color){
	swal(title, containt, {
			icon : icon,
			buttons: {        			
				confirm: {
					className : color
						 }
			        },
	});
}	
  $('.modifImage').on('click',function(e){
	  e.preventDefault();
	  $('.modalImage').modal().show();
	 /* $.post(base_url+'Administrateur/changePhoto',function(data){
         $('.main').empty().append(data);
	  });*/
  });

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
$('.saveImage').on('click',function(event){
event.preventDefault();
var fd = new FormData();
var files = $('.upload')[0].files[0];
fd.append('file',files);
			$.ajax({
			type:'POST',
			url: "Administrateur/changePhoto",
			data: fd,
			cache:false,
			contentType: false,
			processData: false,
			success: (data) => {
		       
				window.location.reload('/'); 
			},
			error: function(data){
									
			}
		});
    });


	
});