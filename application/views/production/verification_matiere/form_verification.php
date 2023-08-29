<?php if (!isset($last->EX_ID)) : ?>
    <div class="alert alert-danger mt-2" role="alert">
        <h4 class="alert-heading"></h4>
        <p>Erreur!</p>
        <p class="mb-0">Donne introuvable!</p>
    </div>
<?php endif; ?>
<form action="" method="POST" class="formVer">
    <fieldset class="col-md-12 border mt-2 bg-white">
        <div class="row ">

            <div class="form-group">
                <label>EQUIPE</label>
                <input type="text" name="VM_EQUIPE" class="form-control form-control-sm" value="<?= $equipe ?>">
            </div>
            <div class="form-group">
                <label>PO</label>
                <input type="text" name="VM_PO" class="form-control form-control-sm po" value="<?= $PO ?>">
            </div>
            <div class="form-group">
                <?php if (isset($last->EX_ID)) : ?>
                    <input type="text" name="EX_ID" class="form-control form-control-sm collapse" value="<?= $last->EX_ID ?>">
                <?php else : ?>
                    <input type="text" name="EX_ID" class="form-control form-control-sm collapse">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="VP_DATE" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label>ME</label>
                <?php if ($me) : ?>
                    <input type="text" name="VM_ME" value="<?= $me->VM_R1 ?>" class="form-control form-control-sm VM_ME">
                <?php else : ?>
                    <input type="text" name="VM_ME" value="<?= $me ?>" class="form-control form-control-sm VM_ME">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>SUITE</label>
                <input type="text" name="VM_SUITE" class="form-control form-control-sm VM_SUITE">
            </div>
            <div class="form-group">
                <label>PDS NET</label>
                <input type="text" name="VM_PDSNET" class="form-control form-control-sm VM_PDSNET" value="<?= $last!=null ?  $last->EX_PDS_SOMME:0; ?>">                                                                                    
            </div>
            <?php if ($me) : ?>
                <div class="form-group">
                    <label>RESTE 1</label>
                    <input type="text" name="VM_R1" value="<?php $last != null ? $last->EX_PDS_SOMME - $me->VM_R1 : 0 - $me->VM_R1; ?>" class="form-control form-control-sm VM_R1">
                </div>
                <div class="form-group">
                    <label>RESTE 2</label>
                    <input type="text" name="VM_R2" value="<?= $last != null ? ($last->EX_PDS_SOMME - $me->VM_R1) * -1 : 0;  ?>" class="form-control form-control-sm VM_R2">
                </div>
            <?php else : ?>
                <div class="form-group">
                    <label>RESTE 1</label>
                    <input type="text" name="VM_R1" class="form-control form-control-sm VM_R1">
                </div>
                <div class="form-group">
                    <label>RESTE 2</label>
                    <input type="text" name="VM_R2" class="form-control form-control-sm VM_R2">
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>QRT</label>
                <select class="form-control form-control-sm" name="VM_QRT">
                    <option value="J">Jour</option>
                    <option value="N">Nuit</option>
                </select>
            </div>
            <div class="form-group">
                <label>N° MACHINE</label>
                <select class="form-control form-control-sm" name="VM_NMCH">
                    <?php foreach ($machine as $key => $machine) : ?>
                        <option><?= $machine->MA_DESIGNATION ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-md-12 w-100">
                <label>OBSERVATION</label>
                <textarea class="form-control " name="VM_OBSERVATION"></textarea>
            </div>
        </div>
    </fieldset>
    <fieldset class="col-md-12 border">
        <div class="form-group col-md-12 text-right">
            <button type="submit" class="btn btn-success btn-sm">Valider</button>
        </div>
    </fieldset>
</form>

<fieldset class="col-md-12 border p-3 ">


    <table class="table table-bordered table-striped table-hover">
        <thead class="bg-info text-white">
            <tr>
                <th>date</th>
                <th>PO</th>
                <th>ME</th>
                <th>SUITE</th>
                <th>PDS NET</th>
                <th>R1 </th>
                <th>R2 </th>
                <th>QRT</th>
                <th>N° Mch </th>
                <th>OBS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donne as $key => $donne) : ?>
                <tr>
                    <td><?= $donne->VP_DATE ?></td>
                    <td><?= $donne->VM_PO ?></td>
                    <td><?= $donne->VM_ME ?></td>
                    <td><?= $donne->VM_SUITE ?></td>
                    <td><?= $donne->VM_PDSNET ?></td>
                    <td><?= $donne->VM_R1 ?></td>
                    <td><?= $donne->VM_R2 ?></td>
                    <td><?= $donne->VM_QRT ?></td>
                    <td><?= $donne->VM_NMCH ?></td>
                    <td>OBS</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</fieldset>