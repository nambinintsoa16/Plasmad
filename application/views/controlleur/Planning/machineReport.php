<div class="col-md-12 p-2">
    <fieldset class="border p-2 bg-white mb-2">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">DATE DE PRODUCTION</label>
                <input type="date" class="form-control form-control-sm date">
            </div>
            <div class="form-group col-md-4">
                <label>MACHINE</label>
                <select name="" id="" class="form-control form-control-sm machine">
                    <?php foreach($machine as $machine):?>
						<option><?=$machine->MA_DESIGNATION?></option>
					<?php endforeach;?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <a href="#" class="btn btn-success btn-sm mt-4 affincher"><i class="fa fa-tv"></i> AFFICHER</a>
            </div>
        </div>
    </fieldset>
</div>
<div class="dataMachineRecap">




</div>
<script>
$(document).ready(function(){
$('.affincher').on('click',function(e){
    e.preventDefault();
    var machine = $('.machine option:selected').val();
    var date = $('.date').val();

    $.post(base_url+"Planning/page",{page:"recapMachine",machine:machine,date:date},function(data){
		$('.dataMachineRecap').empty().append(data);
	});
});

});

</script>
