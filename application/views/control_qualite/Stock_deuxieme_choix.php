<table class="table-strepted table-hover table-bordered table-sm w-100 tableQC">
    <thead class="bg-<?=$nav_color?> text-white">
        <tr>
            <th>ID</th>
            <th>PO</th>
            <th>DIMENSION</th>
            <th>TAIL</th>
            <th>QUANTITE</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="dataPoResult">
    </tbody>
</table>

<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header bg-<?=$nav_color?> text-white">
                    <b> BON DE COMMANDE</b>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form>
                            <fieldset class="col-md-12 border">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="date">Date : </label>
                                        <input type="text" name="date" disabled class="form-control form-control-sm date" value=<?= date('d-m-Y') ?>>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_PE">PE N° : </label>
                                        <input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
                                        <select class="form-control form-control-sm BC_TYPEPRODUIT">
                                            <option>CINTRES</option>
                                            <option>SACHETS</option>
                                            <option>GAINES</option>
                                            <option>PUCE DE TAILLES</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="BC_CLIENT">CLIENT, Référence : </label>
                                        <input type="text" name="BC_CLIENT" class="form-control form-control-sm BC_CLIENT ">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="BC_CODE">CODE : </label>
                                        <input type="text" name="BC_CODE" class="form-control form-control-sm BC_CODE">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="BC_DATELIVRE">Date de livraison : </label>
                                        <input type="date" name="BC_DATELIVRE" class="form-control form-control-sm BC_DATELIVRE">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="BC_LIEULIVRE">Lieu de livraison : </label>
                                        <input type="text" name="BC_LIEULIVRE" class="form-control form-control-sm BC_LIEULIVRE">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-md-12 border mt-2">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="BC_REASSORT">Reassort : </label>
                                        <input type="text" name="BC_REASSORT" class="form-control form-control-sm BC_REASSORT ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_ECHANTILLON">Echantillon : </label>
                                        <input type="text" name="BC_ECHANTILLON" class="form-control form-control-sm BC_ECHANTILLON">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_DIMENSION">Dimension : </label>

                                        <input type="text" name="BC_DIMENSION" class="form-control form-control-sm BC_DIMENSION">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_RABAT">Rabat : </label>
                                        <input type="text" name="BC_RABAT" class="form-control form-control-sm BC_RABAT">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_SOUFFLET">Soufflet : </label>
                                        <input type="text" name="BC_SOUFFLET" class="form-control form-control-sm BC_SOUFFLET">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_PERFORATION">Perforation : </label>
                                        <input type="text" name="BC_PERFORATION" class="form-control form-control-sm BC_PERFORATION">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPE">Type : </label>
                                        <select class="form-control BC_TYPE form-control-sm">
                                            <?php foreach ($type as $key => $type) : ?>
                                                <option><?= $type->TF_DESIGNATION ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_IMPRESSION">Impression : </label>
                                        <input type="text" name="BC_IMPRESSION" class="form-control form-control-sm BC_IMPRESSION">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_CYLINDRE">Cylindre : </label>
                                        <input type="text" name="BC_CYLINDRE" class="form-control form-control-sm BC_CYLINDRE">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-md-12 border mt-2">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPEMATIER">Matière : </label>
                                        <select class="form-control BC_TYPEMATIER form-control-sm">
                                            <?php foreach ($type_de_matier as $key => $type_de_matier) : ?>
                                                <option><?= $type_de_matier->TM_DESIGNATION ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_QUNTITE">Quantité : </label>
                                        <input type="number" name="BC_QUNTITE" class="form-control form-control-sm BC_QUNTITE">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_PRIX">Prix : </label>
                                        <input type="text" name="BC_PRIX" class="form-control form-control-sm BC_PRIX">
                                    </div>
                                </div>
                    </div>
                    </fieldset>
                    <fieldset class="col-md-12 border mt-2">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="BC_OBSERVATION">Observation : </label>
                                <textarea class="form-control BC_OBSERVATION"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="card-footer text-right">
                  <button type="reset" class="btn btn-danger">Annuler</button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>