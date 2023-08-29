<fieldset class="col-md-12 border">
    <div class="row">

        <div class="form-group col-md-4">
            <label>Type de calcule : </label>
            <input type="text" class="form-control form-control-sm width" value="<?= $data->PB_TYPECALCULE ?>">
        </div>
        <div class="form-group col-md-3">
            <label>width : </label>
            <input type="numeric" class="form-control form-control-sm width" value="<?= $data->PB_WIDTH ?>">
        </div>
        <div class="form-group col-md-3">
            <label>length : </label>
            <input type="numeric" class="form-control form-control-sm length" value="<?= $data->PB_LENGTH ?>">
        </div>
        <div class="form-group col-md-2">
            <label>thickness : </label>
            <input type="numeric" class="form-control form-control-sm thickness" value="<?= $data->PB_THICKNESS ?>">
        </div>
        <div class="form-group col-md-3">
            <label>Flap : </label>
            <input type="numeric" class="form-control form-control-sm Flap" value="<?= $data->PB_FLAP ?>">
        </div>
        <div class="form-group col-md-3">
            <label>Bottom Gusset : </label>
            <input type="numeric" class="form-control form-control-sm Gusset" value="<?= $data->PB_GUSSET ?>">
        </div>
        <div class="form-group col-md-3">
            <label>Printing area : </label>
            <input type="text" class="form-control form-control-sm Printing_area" value="<?= $data->PB_PRINTING_AREA ?>">
        </div>
        <div class="form-group col-md-3">
            <label>Order qty-pcs : </label>
            <input type="numeric" class="form-control form-control-sm Order" value="<?= $data->PB_ORDER ?>">
        </div>
        <div class="form-group col-md-3">
            <label>Marge commerciale: </label>
            <input type="text" class="form-control form-control-sm margex" value="<?= $data->PB_MARGE?>">
        </div>

        <div class="form-group col-md-3">
            <label>Marge matier: </label>
            <input type="text" class="form-control form-control-sm margex" value="<?= $data->PB_MARGES ?>">
        </div>
        <div class="form-group col-md-3">
            <label>Prix matier: </label>
            <input type="text" class="form-control form-control-sm Prix_matier" value="<?= $data->PB_PRIX_MATIER ?>">
        </div>
        <div class="form-group col-md-3">
            <label>Vitesse machine: </label>
            <input type="text" class="form-control form-control-sm VitesseMachine" value="<?= $data->PB_VITESSEMACHINE ?>">
        </div>
    </div>
</fieldset>
<hr />

</div>