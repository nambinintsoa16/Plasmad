<fieldset class="border p-4 bg-white">
    <div class="row">
        <div class="col-md-12 text-right collapse">
            <a href="#" class="btn btn-primary" id="btn-new-fonction"><i class="icon icon-plus"></i> Ajouter nouvelle fonction</a>
        </div>
    </div>
</fieldset>
<fieldset class="border p-4 bg-white mt-2">
    <div class="row">
        <div class="form-group col-md-4">
            <Label>Nom : </Label>
            <input type="text" id="nom" class="form-control form-control-sm">
        </div>
        <div class="form-group col-md-4">
            <label for="">Prénom : </label>
            <input type="text" id="prenom" class="form-control form-control-sm">
        </div>

        <div class="form-group col-md-4">
            <label for="">Matricule : </label>
            <input type="text" id="matricule" class="form-control form-control-sm">
        </div>
        <div class="form-group col-md-4">
            <label for="">Fonction : </label>
            <select name="" id="fonction" class="form-control" id="fonction">
                <option hidden>Sélectionner fonction</option>
                <?php foreach ($fonction as $fonction) : ?>
                    <option value="<?= $fonction->foct_refnum ?>"><?= $fonction->foct_designation ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="">société : </label>
            <select name="" id="societe" class="form-control" id="societe">
                <option hidden>Sélectionner société</option>
                <option>PLASMAD</option>
                <option>MADAKEM</option>
            </select>
        </div>
        <div class="form-group col-md-12 text-right">
            <a href="#" class="btn btn-success" id="save_user">Enregistré</a>
        </div>
    </div>
</fieldset>