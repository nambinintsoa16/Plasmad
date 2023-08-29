<fieldset class="col-md-12 border w-100 bg-white">
        <div class="row">
            <div class="form-group col-md-3">
                <input type="date" id="date_de_bedut" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <input type="date" id="date_fin" class="form-control">
            </div>
            <div class="form-group col-md-2 ">
                <button type="submit" class="btn btn-success" id="check_cherche">
                    <i class="flaticon-imac"></i>&nbsp;AFFICHER</button>
            </div>

            <div class="form-group col-md-2 collapse">
                <a href="<?= base_url('comptabilite/export_entree_stock_matiere') ?>" id="btn-export" class="btn btn-primary">
                    <i class="fas fa-file-excel"></i>&nbsp;
                    EXPORTE</a>
            </div>
            <div class="form-group col-md-2 collapse">
                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#form_matier_modal">
                    <i class="flaticon-file"></i>&nbsp;
                    IMPRIMER
                </a>

            </div>

        </div>
</fieldset>
<fieldset class="col-md-12 border p-0 mt-2 w-100 pt-3 bg-white">
    <table class=" table-sm table-bordered table-hover table-strepted dataTable w-100 m-0" id="dataTable_entree_matiere">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>

                <th>ID</th>
                <th>Date</th>
                <th>User</th>
                <th>Réceptionnaire</th>
                <th>Article</th>
                <th>Quantité</th>
                <th></th>

            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</fieldset>

