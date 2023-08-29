<fieldset class="col-md-12 border mt-2 w-100 pt-3 bg-white">
    <table class=" table-sm table-bordered table-hover table-strepted dataTable w-100 ">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>
                <th>DATE</th>
                <th>N°PO</th>
                <th>CLIENT</th>
                <th>DIM</th>
                <th>TAILLE</th>
                <th>EN STOCK</th>
                <th>PRIX</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</fieldset>
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
                                        <input type="text" name="date" disabled class="form-control form-control-sm date">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_PE">PE N° : </label>
                                        <input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
                                        <input type="text" name="BC_CLIENT" disabled class="form-control form-control-sm BC_TYPEPRODUIT ">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="BC_CLIENT">CLIENT, Référence : </label>
                                        <input type="text" name="BC_CLIENT" disabled class="form-control form-control-sm BC_CLIENT ">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="BC_CODE">CODE : </label>
                                        <input type="text" name="BC_CODE" disabled class="form-control form-control-sm BC_CODE">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="BC_DATELIVRE">Date de livraison : </label>
                                        <input type="date" name="BC_DATELIVRE" disabled class="form-control form-control-sm BC_DATELIVRE">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-md-12 border mt-2">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="BC_REASSORT">Reassort : </label>
                                        <input type="text" name="BC_REASSORT" disabled class="form-control form-control-sm BC_REASSORT ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_ECHANTILLON">Echantillon : </label>
                                        <input type="text" name="BC_ECHANTILLON" disabled class="form-control form-control-sm BC_ECHANTILLON">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_DIMENSION">Dimension : </label>
                                        <input type="text" name="BC_DIMENSION" disabled class="form-control form-control-sm BC_DIMENSION">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_RABAT">Rabat : </label>
                                        <input type="text" name="BC_RABAT" disabled class="form-control form-control-sm BC_RABAT">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_SOUFFLET">Soufflet : </label>
                                        <input type="text" name="BC_SOUFFLET" disabled class="form-control form-control-sm BC_SOUFFLET">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_PERFORATION">Perforation : </label>
                                        <input type="text" name="BC_PERFORATION" disabled class="form-control form-control-sm BC_PERFORATION">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPE">Type : </label>
                                        <input type="text" name="BC_TYPE" disabled class="form-control form-control-sm BC_TYPE">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_IMPRESSION">Impression : </label>
                                        <input type="text" name="BC_IMPRESSION" disabled class="form-control form-control-sm BC_IMPRESSION">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_CYLINDRE">Cylindre : </label>
                                        <input type="text" name="BC_CYLINDRE" disabled class="form-control form-control-sm BC_CYLINDRE">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-md-12 border mt-2">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPEMATIER">Matiér : </label>
                                        <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_TYPEMATIER">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPEMATIER">QUANTITE A PRODUIRE EN METRE : </label>
                                        <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_QUANTITEAPRODUIREENMETRE">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_TYPEMATIER">POIDS EN KG : </label>
                                        <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_POISENKGSAVECMARGE">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_QUNTITE">Quantité : </label>
                                        <input type="text" name="BC_QUNTITE" disabled class="form-control form-control-sm BC_QUNTITE">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BC_PRIX">Prix : </label>
                                        <input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_PRIX">
                                    </div>
                                </div>
                    </div>
                    </fieldset>
                    <fieldset class="col-md-12 border mt-2">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="BC_OBSERVATION">Observation : </label>
                                <textarea disabled class="form-control BC_OBSERVATION"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
