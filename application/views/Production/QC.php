<div class="card">
    <div class="card-header bg-dark text-white">
        <b> CONTROL QUALITE</b>
    </div>
    <div class="card-body">
        <form>
            <fieldset class="col-md-12 border">
                <div class="row">
                    <div class="form-group">
                        <label>PO</label>
                        <input type="text" class="form-control form-control-sm npo" name="PO">
                    </div>

                    <div class="form-group">
                        <label>NOM QC </label>
                        <input type="text" class="form-control form-control-sm QC" name="QC">
                    </div>

                    <div class="form-group">
                        <label>POIDS</label>
                        <input type="text" class="form-control form-control-sm C_POID" name="C_POID">
                    </div>

                    <div class="form-group">
                        <label>QTT ENTREE</label>
                        <input type="text" class="form-control form-control-sm QTT_ENTRE" name="QTT_ENTRE">
                    </div>

                    <div class="form-group">
                        <label>2eme choix </label>
                        <input type="text" class="form-control form-control-sm QTT_STIE" name="QTT_STIE">
                    </div>
                    <div class="form-group">
                        <label>QTy Stie</label>
                        <input type="text" class="form-control form-control-sm CHOIX_DEUX" name="CHOIX_DEUX">
                    </div>
                    <div class="form-group col-md-12 text-right">
                        <button class="btn btn-success">Valider</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <fieldset class="col-md-12 border mt-2 pt-2">
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="date" class="form-control form-control-sm rechDate">
                </div>
                <div class="form-group col-md-4">
                    <button class="btn btn-primary btn-sm dateAffiche"><i class="fa fa-tv"></i>&nbsp;Affichier</button>
                </div>
            </div>
            <table class=" table-strepted table-hover table-bordered table-sm w-100">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>DATE</th>
                        <th>NOM QC</th>
                        <th>PO</th>
                        <th>POIDS</th>
                        <th>QTT ENTREE</th>
                        <th>QTy Stie</th>
                        <th>2eme choix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="dataPoResult">
                </tbody>
            </table>
        </fieldset>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.QC').autocomplete({
                source: base_url + "Production/autocompleteQC",
            });
            $('.npo').autocomplete({
                source: base_url + "Production/autocompletPo",
                select: function(ui, iteme) {
                    var param = iteme.item.value.trim();
                    $.post(base_url + "Production/control", {
                        PO: param
                    }, function(data) {
                        $('.dataPoResult').empty().append(data);
						deleteQc();
                    }, 'json');
                   
                }
            });
            $('.dateAffiche').on('click',function(e){
                e.preventDefault();
               var date = $('.rechDate').val();
                $.post(base_url + "Production/control", {
                        date:date
                    }, function(data) {
                        $('.dataPoResult').empty().append(data);
						deleteQc();
                    }, 'json');
                  
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
            $('.QTT_STIE').on('change', function() {
                var entre = $('.QTT_ENTRE').val();
                var qtts = $('.QTT_STIE').val();
                $('.CHOIX_DEUX').val(entre - qtts);
            });
            $('.poex').autocomplete({
                source: base_url + "Production/autocompletPo",
                select: function(ui, iteme) {
                    var param = iteme.item.value.trim();
                    $.post(base_url + "Production/dataCoupe", {
                        param: param
                    }, function(data) {
                        $('.QTT_ENTRE').val(data.somme);
                    }, 'json');
                }
            });
            $("form").on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                var po = $('.npo').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + "Production/saveQC",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();

                        $.post(base_url + "Production/control", {
                            PO: po
                        }, function(data) {
                            $('.dataPoResult').empty().append(data);
                        }, 'json');
                        swal("Succé ", "Control enregistre", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            },
                        });

                    },
                    error: function(data) {
                        swal("Erreur ", "Veuillez réessayer!", {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-danger'
                                }
                            },
                        });
                    }

                });

            });

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

        });
    </script>
