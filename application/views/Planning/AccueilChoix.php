<div class="card">
	<div class="card-header bg-dark text-white">
		<b>STOCK DEUXIEME CHOIX</b>
	</div>
	<div class="card-body">
		<fieldset class="border p-2">
			<div class="row">

	<div class="col-sm-6 col-lg-3 btn-choix">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-warning mr-3">
					<i class="fa fa-database"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>ENTRE DEUXIEME CHOIX PRODUCTION</small></b></h5>
					<small class="text-muted"></small>

				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-lg-3 btn-choix">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-danger mr-3">
					<i class="fa fa-database"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>DETAIL QC</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>
    <div class="col-sm-6 col-lg-3 btn-choix">
		<div class="card p-3">
			<div class="d-flex align-items-center">
				<span class="stamp stamp-md bg-primary mr-3">
					<i class="fa fa-list"></i>
				</span>
				<div>
					<h5 class="mb-1"><b><small>STOCKS DEUXIEME CHOIX</small></b></h5>
					<small class="text-muted"></small>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="main-choix" rol="main">

</div>
<script>
$(document).ready(function() {
$.post(base_url+"Planning/page",{page:"ENTRE DEUXIEME CHOIX PRODUCTION"},function(data){
      $('.main-choix').empty().append(data);
   });
$('.btn-choix').on('click',function(e){
    e.preventDefault();
    var $this = $(this);
    var page = $this.children().find('b').text();
    $.post(base_url+"Planning/page",{page:page},function(data){
           $('.main-choix').empty().append(data);
    });
});
});
</script>	