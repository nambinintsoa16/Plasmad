
<fieldset class="border p-0 bg-white mb-2">
    <div class="row p-2">
        <div class="form-group col-md-4">
            <label for="">Entrée PO : </label>
            <input type="text" class="form-control form-control-sm" id="refnum_commande" placeholder="N° PO">
        </div>
        <div class="form-group col-md-4 mt-1">
            <a href="#" class="btn btn-success btn-sm mt-4" id="show_data"><i class="fa fa-tv"></i> AFFICHER</a>
        </div>
    </div>
</fieldset>

<div class="col-md-12 p-0">
    <fieldset class="border p-2 bg-white m-0">
        <div class="row">
            <div class="col-md-3 form-group">
                <input class="form-control form-control-sm" id="date" type="date" placeholder="Date">
            </div>
            <div class="col-md-3 form-group">
                <input class="form-control form-control-sm" id="designation" placeholder="Désignation">
            </div>
            <div class="col-md-3 form-group">
                <input class="form-control form-control-sm" id="quantite" placeholder="Quantité">
            </div>
            <div class="col-md-3 form-group">
                <a href="" class="btn-sm btn btn-success" id="save_matiere"><i class="icon icon-plus"></i> Ajouter</a>
            </div>
    </fieldset>
</div>
<div class="col-md-12 p-0 mt-1">
    <fieldset class="border p-0 bg-white m-0 pt-3">
        <table class="table-hover table-strepted table-bordered w-100 m-0" id="dataTable">
            <thead class="bg-<?= $nav_color ?> text-white">
                <tr>
                    <th>DATE</th>
                    <th>DESIGNATION</th>
                    <th>QUANTITE</th>
                    <th>PRIX</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-body">
            </tbody>
        </table>
    </fieldset>
</div>