<div class="card w-100">
    <div class="card-header bg-dark text-white">
        <b>SUIVI PRODUIT FINI</b>
    </div>
    <div class="card-body">
        <fieldset class="border p-2">
            <div class="row">

                <div class="col-sm-4 col-lg-3 btn-clickStock">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-success mr-3"><i class="fa fa-check"></i></span>
                            <div>
                                <h5 class="mb-1"><b><small>STOCK PRODUIT FINI</small></b></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-3 btn-clickStock">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-warning mr-3"><i class="fa fa-edit"></i></span>
                            <div>
                                <h5 class="mb-1"><b><small>MODIFIER TRANSACTION</small></b></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 btn-clickStock">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-info mr-3"><i class="fas fa-sign-in-alt"></i></span>
                            <div>
                                <h5 class="mb-1"><b><small>ENTREE</small></b></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 btn-clickStock">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-secondary mr-3"><i class="fa fa-truck"></i></span>
                            <div>
                                <h5 class="mb-1"><b><small>SUIVIE LIVRAISON</small></b></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4 col-lg-3 btn-clickStock">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-primary mr-3"><i class="fa fa-download"></i></span>
                            <div>
                                <h5 class="mb-1"><b><small>REINITIALISER STOCK</small></b></h5>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </fieldset>
        
    </div>
    <fieldset class="border p-2 mt-2">
            <span class="stockContent">

            </span>
        </fieldset>
    <script>
        $(document).ready(function() {
            $.post(base_url + "Controlleur/page", {
                page: "STOCK PRODUIT FINI"
            }, function(data) {
                $('.stockContent').empty().append(data);
            });
            $('.btn-clickStock').on('click', function(e) {
                e.preventDefault();
                var page = $(this).children().find('b').text();
                $.post(base_url + "Controlleur/page", {
                    page: page
                }, function(data) {
                    $('.stockContent').empty().append(data);
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

        });
    </script>