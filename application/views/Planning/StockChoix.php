
        <table class=" table-strepted table-hover table-bordered table-sm w-100 tableQC">
            <thead class="bg-dark text-white">
                <tr>
                    <th>PO</th>
                    <th>POIDS</th>
                    <th>QUANTITE</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="dataPoResult">
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="card">

                <div class="card-header bg-dark text-white">

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

                    <a href="" class="btn btn-info imprimerprecosting"><i class="fa fa-print"></i>&nbsp;Imprimer
                        precosting</a>
                    <a href="" class="btn btn-info imprimer"><i class="fa fa-print"></i>&nbsp;Imprimer</a>
                    <button type="reset" class="btn btn-danger removeModal">Annuler</button>
                </div>
                </form>
            </div>
        </div>

    </div>

</div>
<script>
    $(document).ready(function() {
        var tables = $('.tableQC').dataTable({
            processing: true,
            ajax: base_url + "Controle_Qualite/StockChoix",
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "rowCallback": function(row, data) {
                deleteQc();
            },
            initComplete: function(setting) {
                deleteQc();
            },
            "drawCallback": function(settings) {
                deleteQc();
            }
        });
        $('.updateQC').on('click', function(e) {
            e.preventDefault();
            var date = $('.date').val();
            var po = $('.po').val();
            var qc = $('.qc').val();
            var links = base_url + "Controle_Qualite/liseteControl?C_DATE=" + date + "&C_PO=" + po + "&QC=" + qc;
            tables.ajax.url(links);
            tables.ajax.reload();

        });

        function deleteQc() {
            $(".delete").on('click', function(e) {
                e.preventDefault();
                var $this = $(this).parent().parent();
                chargement();
                var parametre = $(this).attr('href');
                $.post(base_url + "Production/deleteQC", {
                    parametre: parametre
                }, function(data) {
                    alertMessage("Suppression QC", "QC supprimer avec succè", "success", "btn btn-success");
                    $this.remove();
                    closeDialog();
                });

            });


            $('.view').on('click', function(e) {
                e.preventDefault();
                var pe = $(this).attr('href').trim();
                $.post(base_url + "Commerciale/detailPES", {
                    pe: pe
                }, function(data) {
                    $(".BC_PE").val(data.BC_PE);
                    $(".date").val(data.BC_DATE);
                    $(".BC_CLIENT").val(data.BC_CLIENT);
                    $(".BC_CODE").val(data.BC_CODE);
                    $(".BC_DATELIVRE").val(data.BC_DATELIVRE);
                    $(".BC_REASSORT").val(data.BC_REASSORT);
                    $(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);
                    $(".BC_DIMENSION").val(data.BC_DIMENSION);
                    $(".BC_RABAT").val(data.BC_RABAT);
                    $(".BC_SOUFFLET").val(data.BC_SOUFFLET);
                    $(".BC_PERFORATION").val(data.BC_PERFORATION);
                    $(".BC_TYPE option:selected").val(data.BC_TYPE);
                    $(".BC_IMPRESSION").val(data.BC_IMPRESSION);
                    $(".BC_QUNTITE").val(data.BC_QUNTITE);
                    $(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
                    $(".BC_PRIX").val(data.BC_PRIX);
                    $(".BC_OBSERVATION").val(data.BC_OBSERVATION);
                    $(".BC_LIEULIVRE").val(data.BC_LIEULIVRE);
                    $('.imprimerprecosting').attr('href', base_url + 'Commerciale/printcosting?po=' + data.BC_PE);
                    $('.imprimer').attr('href', base_url + 'Commerciale/printFacture?po=' + data.BC_PE);
                    $("#infoCOmmande").modal("show");
                }, "json");

            });
        }

        function chargement() {
            var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
            $.dialog({
                "title": "",
                "content": htmls,
                "show": true,
                "modal": true,
                "close": false,
                "closeOnMaskClick": false,
                "closeOnEscape": false,
                "dynamic": false,
                "height": 150,
                "fixedDimensions": true
            });


        }

        function closeDialog() {
            $('.jconfirm').remove();
        }

        function alertMessage(title, message, icons, btn) {
            swal(title, message, {
                icon: icons,
                buttons: {
                    confirm: {
                        className: btn
                    }
                },
            });

        }

    });
</script>