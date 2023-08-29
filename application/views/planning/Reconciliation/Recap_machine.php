<fieldset class="border p-2 bg-white mb-2">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">DATE DE PRODUCTION</label>
                <input type="date" class="form-control form-control-sm" id="date">
            </div>
            <div class="form-group col-md-4">
                <label>MACHINE</label>
                <select name="" class="form-control form-control-sm" id="machine">
                    <?php foreach($machine as $machine):?>
						<option value="<?=$machine->MA_SPECIFIQUE?>"><?=$machine->MA_DESIGNATION?></option>
					<?php endforeach;?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <a href="#" class="btn btn-success btn-sm mt-4" id="affincher"><i class="fa fa-tv"></i> AFFICHER</a>
            </div>
        </div>
    </fieldset>
    <fieldset class="border p-2 bg-white mb-2">   
        <span id="result_containt"></span>
    </fieldset> 