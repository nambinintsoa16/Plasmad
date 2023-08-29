
        <?php if ($data) : ?>
            <?php foreach ($data as $key => $data) : ?>
                <table class="table table-striped table-bordered">
                    <thead class="bg-info text-white">
                        <tr>
                            <th colspan="4"><?= $key ?></th>
                            <th>QUANTITE</th>
                            <th>POIDS(KGS)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $valeur) : ?>
                            <tr>
                                <td><?= $valeur->BC_PE ?></td>
                                <td><?= $valeur->BC_CODE ?></td>
                                <td><?= $valeur->BC_DIMENSION ?></td>
                                <td><?= $valeur->BC_PE ?></td>
                                <td><?= $valeur->BC_QUNTITE ?></td>
                                <td><?= $valeur->BC_POISENKGSAVECMARGE ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center">
                   Aucun livraison disponible 
            </div>
        <?php endif ?>
  