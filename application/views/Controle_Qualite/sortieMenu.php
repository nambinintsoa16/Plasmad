<div class="card">
    <div class="card-header bg-dark text-white">
        <b>SORTIE DEUXIEME CHOIX</b>
    </div>
    <div class="card-body">
        <div class="row m-auto">
            <div class="col-sm-3 col-lg-3 btn-click-choix">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-success mr-3">
                            <i class="fa fa-database"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><small>SORTIE</small></b></h5>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 btn-click-choix">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-success mr-3">
                            <i class="fa fa-database"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><small>DETAIL SORTIE DEUXIEME CHOIX</small></b></h5>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-12 choixContent p-0 m-0">
    </div>
</div>
<script>
    $(document).ready(function() {
        $.post(base_url + 'Controle_Qualite/page', {
            page: "SORTIE"
        }, function(data) {
            $('.choixContent').empty().append(data);
        });
        $('.btn-click-choix').on('click', function(e) {
            var param = $(this).find('b').text();
            $.post(base_url + 'Controle_Qualite/page', {
                page: param
            }, function(data) {
                $('.choixContent').empty().append(data);
            });
        });

    });
</script>