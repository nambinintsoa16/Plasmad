$(document).ready(function(){
	$('.btn-success').on('click',function(e){
		e.preventDefault();
		alertCustum('Ooops!','text','success','btn btn-success');
		
	});
	
});
function alertCustum(title,containt,icon,color){
	swal(title, containt, {
			icon : icon,
			buttons: {        			
				confirm: {
					className : color
						 }
			        },
	});
	
});	