
<div class="row">
	<div class="col-md-12">
		<label class="numreoPo">N°PO : <?=$po?></label>
	</div>
	<div class="col-md-4 form-group">
		<input  class="form-control form-control-sm date" type="date" placeholder="Date">
	</div>
	<div class="col-md-4 form-group">
		<input  class="form-control form-control-sm designation" placeholder="Désignation">
	</div>
	<div class="col-md-4 form-group">
		<input class="form-control form-control-sm quantite" placeholder="Quantité">
	</div>
	<div class="col-md-3 form-group">
		<a href="" class="btn-sm btn btn-success ajouter"><i class="fa fa-plus"></i> Ajouter</a>
	</div>
<div class="col-md-12">	
<table class="table-hover table-strepted table-bordered w-100">
	<thead class="bg-dark">
		<tr>
			<th>DATE</th>
			<th>DESIGNATION</th>
			<th>QUANTITE</th>
			<th>PRIX</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="tbodyMatt">
<?php foreach ($data as $key => $data):?>
	<tr>
		 <td><?=$data->MI_DATE?></td>
		 <td><?=$data->MI_DESIGNATION?></td>
		 <td><?=$data->MI_QUANTITE?></td>
		 <td><?=$data->MI_PRIX?></td>
		 <td class="text-center"><a href="" id="<?=$data->MI_ID?>" class="btn btn-danger btn-sm supprmatt"><i class="fa fa-trash"></i></a></td>
	</tr>
<?php endforeach;?>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.designation').autocomplete({
        source:base_url+"Production/autocompleteMatier",	
        appendTo:"#modalProccess"
		});
		$('.designation').autocomplete({
        	source:base_url+"Production/autocompleteMatier",	
       
		});

		$('.supprmatt').on('click',function(event){
			event.preventDefault();
			var id = $(this).attr('id');
			$.post(base_url+'Production/deleteMatierEmpress',{id:id},function(){

			});
		});

	$('.ajouter').on('click',function(event){
		event.preventDefault();
		var reference = $('.designation').val().split(" | ");
		var quantite = $('.quantite').val();
		var date = $('.date').val();
		var po = $('.numreoPo').text();

		$.post(base_url+'Production/saveEncre',{reference:reference[0],quantite:quantite,prix:reference[1],date:date,po:po},function(){
			 $('.tbodyMatt').append('<tr><td>'+date+'</td><td>'+reference[0]+'</td><td>'+quantite+'</td><td>'+reference[1]+'</td><td><a href="#" class="btn btn-danger btn-sm deleteBt"><i class="fa fa-trash"></i></a></td></tr>');
              deleteBt();
		});
        
		});
		function deleteBt(){
			$('.deleteBt').on('click',function(event){
			event.preventDefault();
			$(this).parent().parent().remove();

			});
		}

	});
</script>