<fieldset class="border bg-white">
            <div class="row">
                <div class="form-group col-md-12 form-inline">
                    <label class="col-md-2 col-form-label">Mois : </label>
                    <div class="col-md-4 p-0">
                        <select name="anneé" id="moisliste" class="form-control form-control-sm">
                            <?php $p = 1;
                            foreach (get_moth_null_param() as $key => $listemois) : ?>
                                <option value="<?= $p ?>"><?= $listemois ?></option>
                            <?php $p++;
                            endforeach; ?>
                        </select>
                    </div>
                    <label class="col-md-2 col-form-label m-0">Année : </label>
                    <div class="col-md-4 p-0">
                        <select name="anneé" id="anneliste" class="form-control form-control-sm">
                            <?php foreach ($annee as $key => $annee) : ?>
                                <option><?= $annee ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <hr />
                </div>
        </fieldset>
        <fieldset class="border mt-3 p-3 bg-white">
            <div class="row">
                <div class="col-md-4">
                    <input type="date" placeholder="Date debut" class="form-control debut">
                </div>
                <div class="col-md-4">
                    <input type="date" placeholder="Date fin" class="form-control fin">
                </div>
                <div class="col-md-4">
                    <a href="#" class="btn  btn-primary col-md-12 pull-right w-100 recherche"><i class="fa fa-tv"></i></i>&nbsp;AFFICHER</a>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="50" id="TOUT" class="selectgroup-input" checked="">
                        <span class="selectgroup-button">AFFICHE TOUT</span>
                    </label>
                </div>
            </div>
        </div>
        <fieldset class="border p-0 pt-2 m-0 bg-white">
            <table class="w-100 table-bordered" id="table_liste_commande">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th>PO</th>
                        <th>Date de commande</th>
                        <th>Client,Référence</th>
                        <th>Dimension</th>
                        <th>Observation</th>
                        <th>Produit</th>
                        <th>Statut</th>
                        <th style="width: 50px!important;"></th>
                    </tr>

                </thead>
                <tbody>
                </tbody>
            </table>

        </fieldset>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-center" id="exampleModalLongTitle">
                    Annulation PE N° : <span class="npe"></span>
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" row="4" placeholder=" Veillez indiquer l'objet de l' annulation"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success valideAnnull">Valider</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

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
                                        <input type="text" name="BC_QUNTITE" class="form-control form-control-sm BC_QUNTITE">
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
                    <a href="" class="btn btn-info imprimerprecosting"><i class="fa fa-print"></i>&nbsp;Imprimer
                        precosting</a>
                    <a href="" class="btn btn-warning imprimer"><i class="fa fa-print"></i>&nbsp;Imprimer</a>
                    <button type="submit" class="btn btn-success UpdateCommande"><i class="fa fa-edit"></i>&nbsp;Modifier</button>
                    <button type="reset" class="btn btn-danger removeModal">Annuler</button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
</div>

<div class="modal fade" id="observationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?=$nav_color?>">
                <p class="modal-title text-center" id="exampleModalLongTitle">
                    Obeservation PE N° : <span class="npeObs"></span>
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body obse-content border-dark">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success valideAnnull">Valider</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
