<fieldset class="col-md-12 border w-100 bg-white">
    <form class="form w-100 col-12" method="POST">
        <div class="row">
            <div class="form-group col-md-4 text-right">
                <input type="file" name="file" class="form-control file">
            </div>
            <div class="form-group col-md-2 text-right">
                <button type="submit" class="btn btn-success">
                    <i class="flaticon-inbox"></i>&nbsp;IMPORTER</button>
            </div>
            <div class="form-group col-md-6 text-right">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form_matier_modal">
                    <i class="flaticon-add"></i>&nbsp;
                    NOUVELLE MATIERE
                </button>

            </div>

        </div>
    </form>
</fieldset>
<fieldset class="col-md-12 border p-0 mt-2 w-100 pt-3 bg-white">
    <table class=" table-sm table-bordered table-hover table-strepted dataTable w-100 m-0">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>

                <th>Désignation</th>
                <th>En stock</th>
                <th>P.U en USD</th>
                <th>P.U en ariary</th>
                <th>Type</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</fieldset>

<div class="modal fade" id="form_matier_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?=$nav_color?> text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">Nouvelle matiere premiere</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="col-md-12">
                    <label>DESIGNATION</label>
                    <input type="text" class="form-control" id="designation_new">
                </div>
                <div class="col-md-12">
                    <label>TYPE</label>
                    <select class="form-control" id="type_matiere_new">
                        <option>Matiere</option>
                        <option>Encre</option>
                        <option>Solvant</option>
                    </select>
        
                </div>
                <div class="col-md-12">
                    <label>PRIX UNITAIRE USD</label>
                    <input type="number" class="form-control" id="prix_usd_new">
                </div>
                <div class="col-md-12">
                    <label>PRIX UNITAIRE ARIARY</label>
                    <input type="number" class="form-control" id="prix_ariary">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="save_matiere"><i class="fa fa-save"></i>&nbsp;ENREGISTRE</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;ANNULER</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-lg" id="form_modal_update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header bg-<?=$nav_color?> text-white">
                    <b> MODIFIER MATIERE </b>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="form">
                        <div class="row">
                            <div class="form-control col-md-12">
                                <label>DESIGNATION</label>
                                <input type="text" class="form-control" id="designation_update">
                                <input type="text" class="form-control collapse" id="refnum_update">
                            </div>
                            <div class="form-control col-md-12">
                                <label>PRIX UNITAIRE USD</label>
                                <input type="text" class="form-control" id="prix_usd_update">
                            </div>
                            <div class="form-control col-md-12">
                                <label>PRIX UNITAIRE ARIARY</label>
                                <input type="text" class="form-control" id="prix_ariary_update">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success" id="update_matiere"><i class="fa fa-edit"></i>&nbsp;MODIFIER</button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;ANNULER</button>
                </div>
                </form>
            </div>
        </div>