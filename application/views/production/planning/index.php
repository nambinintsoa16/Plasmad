<style>
    .dataTables_wrapper {
        padding: 2px !important;
    }

    * {
        scrollbar-width: thin;
        scrollbar-color: #346abf white;
    }

    ::-webkit-scrollbar {
        width: 3px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: darkgrey;
        outline: 1px solid slategrey;
    }
</style>
<fieldset class="border p-2 bg-white mb-2">
<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
    <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
        <?php foreach ($machine as $key => $machine) :
            $id_machine = str_replace(" ", "_", $machine->MA_DESIGNATION);
        ?>
            <div>
                <div class="col-md-12 p-2 bg-<?= $nav_color ?> text-white">
                    <span class="col-md-3"><?= $machine->MA_DESIGNATION ?> </span>
                    <span>&nbsp;&nbsp;<a href="#" class="text-white">Capacité de la machine : <?= $machine->CAPACITE ?></a></span>
                    <span>&nbsp;&nbsp;<a href="#" class="text-white">Production prévisionnelle : </a></span>
                    |<span>&nbsp;&nbsp;<a href="#" class="text-white">Términer : </a></span>
                    |<span>&nbsp;&nbsp;<a href="#" class="text-white">Reste à produire : </a></span>
                    <span class="pull-right" style="font-size:11px">
                        <p class="text-right collapsed" data-toggle="collapse" data-target="#tab_<?= $machine->MA_ID ?>"> <i class="fa fa-plus " aria-expanded="false"></i></p>
                    </span>
                </div>
                <fieldset class="border p-0 bg-white table-responsive">
                    <table class="w-100 table-bordered dataTable" id="<?= $id_machine ?>">
                        <thead class="bg-<?= $nav_color ?> text-white">
                            <tr>
                                <th>ORDRE</th>
                                <th>JOB_CARD</th>
                                <th>DATE</th>
                                <th>N°PO</th>
                                <th>CLIENT</th>
                                <th>CODE_CLIENT</th>
                                <th>TYPE</th>
                                <th>MAT </th>
                                <th>DIMENSION</th>
                                <th>IMPRESSION</th>
                                <th>ECHANTILLON</th>
                                <th>METRAGE</th>
                                <th>DIMENSION_PROD</th>
                                <th>POIDS</th>
                                <th>POIDS_EN_PROD</th>
                                <th>TERMINER</th>
                                <th>RESTE</th>
                                <th>QUANTITE</th>
                                <th>EXT</th>
                                <th>KGS/H</th>
                                <th>REEL</th>
                                <th>DATE_DEBUT</th>
                                <th>DEBUT</th>
                                <th>DATE_FIN</th>
                                <th>FIN</th>
                                <th>DUREE</th>
                                <th>RESTE</th>
                                <th>OBS</th>
                                <th>EN_PROD</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        <?php endforeach; ?>
    </div>
    
</fieldset>