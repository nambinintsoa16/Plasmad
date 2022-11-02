<table class="w-100 table-bordered  table table-hover  dataTableData" style="font-size: 13px!important;">
    <thead class="bg-dark text-white">
        <tr>
            <th>DATE</th>
            <th>PO</th>
            <th style="width:150px!important;">N° Job cart</th>
            <th>TYPE</th>
            <th>MACHINE</th>
            <th>PROCESSUS</th>
            <th style="width:250px!important;">TYPE DE BAG</th>
            <th>MATIERE</th>
            <th>DIMENSION</th>
            <th>PERFORATION</th>
            <th>QUANTITE</th>
            <th>REASSORT</th>
            <th>RABAT</th>
            <th>PERFORATION</th>
            <th>CYLINDRE</th>
            <th>OBSERVATION</th>
        </tr>
    </thead>
    <tbody class="bg-default text-dark tbody">
        <?php foreach ($data as $row) : ?>
            <tr>
                <td><?= $row->BC_DATE ?></td>
                <td><?= $row->BC_PE ?></td>
                <td><?= $row->JO_ID ?></td>
                <td><?= $row->BC_TYPEPRODUIT ?></td>
                <td><?= $row->BC_MACHINE ?></td>
                <td><?= $row->BC_STATUT ?></td>
                <td><?= $row->BC_TYPE ?></td>
                <td><?= $row->BC_TYPEMATIER ?></td>
                <td><?= $row->BC_DIMENSION ?></td>
                <td><?= $row->BC_PERFORATION ?></td>
                <td><?= $row->BC_QUNTITE ?></td>
                <td><?= $row->BC_REASSORT ?></td>
                <td><?= $row->BC_RABAT ?></td>
                <td><?= $row->BC_PERFORATION ?></td>
                <td><?= $row->BC_CYLINDRE ?></td>
                <td><?= $row->BC_OBSERVATION ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

<script>
    $(document).ready(function() {

        $('.dataTableData').DataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            }
        });


        $('.tbody > tr').on('click', function() {
            var Po = $(this).children().first().next().text();
            $.post(base_url + 'Planning/detailPo', {
                PO: Po
            }, function(data) {
                $('.cont-const').empty().append(data);
            });

        });


    });
</script>