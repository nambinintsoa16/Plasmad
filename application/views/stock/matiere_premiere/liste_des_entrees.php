<fieldset class="col-md-12 border w-100 bg-white">
        <p class="w-100 text-right mt-2">
            <input type="date" id="date_de_bedut">

            <input type="date" id="date_fin">

            <button type="submit" class="btn btn-success btn-sm" id="check_cherche">
                <i class="flaticon-imac"></i>&nbsp;AFFICHER</button>

            <a href="<?= base_url('comptabilite/export_entree_stock_matiere') ?>" id="btn-export" class="btn btn-primary collapse">
                <i class="fas fa-file-excel"></i>&nbsp;
                EXPORTE</a>

            <a href="" class="btn btn-danger collapse" data-toggle="modal" data-target="#form_matier_modal">
                <i class="flaticon-file"></i>&nbsp;
                IMPRIMER
            </a>

        </p>
</fieldset>
<fieldset class="col-md-12 border p-0 mt-2 w-100 pt-3 bg-white">
    <table class=" table-sm table-bordered table-hover table-strepted dataTable w-100 m-0 " id="dataTable_entree_matiere">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>

                <th>ID</th>
                <th>Date</th>
                <th>User</th>
                <th>Fournisseur</th>
                <th>Article</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</fieldset>