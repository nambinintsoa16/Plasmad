<?php $this->load->model('global');
$i = 1;
foreach ($data as $data) :
    $total = $this->global->get_sum_colum(["SM_MATIER" => $data->SM_MATIER,"SM_DATE" => $date], "SM_QUANTITE", "sortie_matiere_premiere");
    $commande = $this->global->get_data_joint_parameter("sortie_matiere_premiere", "commande", "commande.BC_PE=sortie_matiere_premiere.SM_DESTINATAIRE", ["SM_MATIER" => $data->SM_MATIER, "SM_DATE" => $date]);
    
?>
     <div class="col-md-12 p-0 m-0 mt-2">
        <table class="table-strepted tableProduitFini table-bordered p-0 w-100">
            <thead class="bg-danger text-white">
                <tr>
                    <th style="width:30%;"><?= $data->SM_MATIER ?></th>
                    <th style="padding-left:5px">Total quantité sortie : <?= $total->SM_QUANTITE; ?></th>
                    <th style="width:4%;text-align:center" class="text-centre"><a href="#" class="text-white text-center" data-toggle="collapse" data-target="#tab_<?= $i ?>"> <i class="fa fa-plus" aria-expanded="false"></i></a></th>
                </tr>
            </thead>
        </table>
        </div>
        <div class="col-md-12 p-0 m-0 collapse pt-3" id="tab_<?= $i ?>">
            <table class="text-xm table-bordered table-sm table-hover w-100 table-strepted dataTable" style="font-size: 13px!important;" id="Table_extrusion">
                <thead class="bg-danger text-white text-center text-xm">
                    <tr>
                        <th>QTE SORTIE/PO</th>
                        <th>PO</th>
                        <th>DIMENSION</th>
                        <th>CLIENT</th>
                        <th>COMMANDE</th>
                        <th>TYPE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commande as $commande) : ?>
                        <tr>
                            <td><?= $commande->SM_QUANTITE ?></td>
                            <td><?= $commande->SM_DESTINATAIRE ?></td>
                            <td><?= $commande->BC_DIMENSION ?></td>
                            <td><?= $commande->BC_CODE ?></td>
                            <td><?= $commande->BC_QUNTITE ?></td>
                            <td><?= $commande->BC_TYPEPRODUIT ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

<?php $i++; endforeach; ?>
<script>
    $(document).ready(function() {
        $(".dataTable").DataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json",
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'colvis',
                className: 'btn btn-warning text-white',
                collectionLayout: 'fixed four-column',
                text: '<i class="icon-eye"></i> Masque colonne',
                columns: ':gt(0)'
            }, {
                className: 'btn btn-primary text-white',
                text: '<i class="icon-printer"></i> Imprimer',
                extend: 'print',
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    }
                },

            }, {
                className: 'btn btn-danger text-white',
                text: '<i class="icon-doc"></i> Export PDF',
                extend: 'pdf',
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    }
                },

            }, {
                className: 'btn btn-success text-white',
                text: '<i class="icon-folder-alt"></i> Exporter',
                extend: 'excel',
                exportOptions: {
                    modifier: {
                        page: 'all',
                        search: 'none'
                    }
                },

            }],
        });
    });
</script>