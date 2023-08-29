<fieldset class="col-md-12 border w-100 bg-white p-2">

    <p class="text-right">
        <input type="date" class="dateChoix date_de_bedut" name="date" id="date">
        <input type="date" class="date_de_fin">
        <button type="submit" class="btn btn-success showSortie btn-sm"><i class="fa fa-tv"></i>&nbsp; Afficher</button>
        <button type="submit" class="btn btn-primary printSortie btn-sm"><i class="fa fa-print"></i>&nbsp; IMPRIMER</button>
    </p>
</fieldset>

<fieldset class="col-md-12 border p-0 m-0 mt-2 w-100 pt-3 bg-white">
    <table class=" table-sm table-bordered table-hover table-strepted w-100" id="data_sortie">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>MAGASINIER </th>
                <th>RECEPTIONNAIRE</th>
                <th>ARTICLE </th>
                <th>QUANTITE</th>
                <th>SAC</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</fieldset>

<div class="modal fade bd-example-modal-lg" id="modal_print" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <fieldset class="col-md-12 border w-100 pt-2">
                    <table class="table-sm table-bordered table-hover table-strepted w-100" id="dataTable_print">
                        <thead class="bg-<?= $nav_color ?> text-white">
                            <tr>
                                <th>ID</th>
                                <th>DATE</th>
                                <th>MAGASINIER </th>
                                <th>RECEPTIONNAIRE</th>
                                <th>ARTICLE </th>
                                <th>QUANTITE</th>
                                <th>SAC</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="body-table">
                        </tbody>
                    </table>
                </fieldset>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success print"><i class="fa fa-print"></i> Imprimer</a>
            </div>
        </div>
    </div>
</div>