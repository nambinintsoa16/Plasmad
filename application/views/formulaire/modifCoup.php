<?php
$this->load->model('Production_model');
$heure = explode("-", $data->ED_HEURE);
?>
<div class="container">
    <fieldset class="col-md-12 border card">
        <div class="row">

            <div class="form-group col-md-3">
                <label>Date</label>
                <input type="date" class="form-control form-control-sm" name="ED_DATE" value="<?= $data->ED_DATE ?>">
            </div>
            <div class="form-group col-md-3">
                <label>ID</label>
                <input type="text" class="form-control form-control-sm poex" name="BC_ID" value="<?= $data->ED_ID ?>">
            </div>

            <div class="form-group col-md-3">
                <label>N°RLX</label>
                <input type="text" class="form-control form-control-sm" name="ED_RLX" value="<?= $data->ED_RLX ?>">
            </div>
            <div class="form-group col-md-3">
                <label>METTRAGE</label>
                <input type="text" class="form-control form-control-sm" name="ED_METRAGE" value="<?= $data->ED_METRAGE ?>">
            </div>
            <div class="form-group col-md-3">
                <label>POIDS ENTREE</label>
                <input type="text" class="form-control form-control-sm" name="ED_POID_ENTRE" value="<?= $data->ED_POID_ENTRE ?>">
            </div>
            <div class="form-group col-md-3">
                <label>1ER CHOIX</label>
                <input type="text" class="form-control form-control-sm" name="ED_1ER_CHOIX" value="<?= $data->ED_1ER_CHOIX ?>">
            </div>

            <div class="form-group col-md-3">
                <label>POIDS SORTIE</label>
                <input type="text" class="form-control form-control-sm" name="ED_POID_SORTIE" value="<?= $data->ED_POID_SORTIE ?>">
            </div>

            <div class="form-group col-md-3">
                <label>2E CHOIX</label>
                <input type="text" class="form-control form-control-sm" name="ED_2E_CHOIX" value="<?= $data->ED_2E_CHOIX ?>">
            </div>
            <div class="form-group col-md-3">
                <label>POIDS 2E CHOIX</label>
                <input type="text" class="form-control form-control-sm" name="ED_2E_POIDS" value="<?= $data->ED_2E_POIDS ?>">
            </div>

            <div class="form-group col-md-3">
                <label>DECHET EXTRUSION</label>
                <input type="text" class="form-control form-control-sm" value="0" name="ED_DECHE_EXTRUSION" value="<?= $data->ED_DECHE_EXTRUSION ?>">
            </div>
            <div class="form-group col-md-3">
                <label>DECHET IMPRESSION</label>
                <input type="text" class="form-control form-control-sm" value="0" name="ED_DECHE_INPRESSION" value="<?= $data->ED_DECHE_INPRESSION ?>">
            </div>
            <div class="form-group col-md-3">
                <label>DECHET COUPE</label>
                <input type="text" class="form-control form-control-sm" value="0" name="ED_DECHE_COUPE" value="<?= $data->ED_DECHE_COUPE ?>">
            </div>
            <div class="form-group col-md-3">
                <label>GAINE TIRE</label>
                <input type="text" class="form-control form-control-sm" name="ED_GAINE_TIRE" value="<?= $data->ED_GAINE_TIRE ?>">
            </div>
            <div class="form-group col-md-3">
                <label>EQUIPE</label>
                <input type="text" class="form-control form-control-sm op" name="EI_EQUIPE" value="<?= $data->ED_EQUIPE ?>">

            </div>
            <div class="form-group col-md-3">
                <label>OPERATEUR 1</label>
                <input type="text" class="form-control form-control-sm op" name="ED_OPERATEUR_1" value="<?= $data->ED_OPERATEUR_1 ?>">
            </div>
            <div class="form-group col-md-3">
                <label>OPERATEUR 2</label>
                <input type="text" class="form-control form-control-sm op" name="ED_OPERATEUR_2" value="<?= $data->ED_OPERATEUR_2 ?>">
            </div>
            <div class="form-group col-md-3">
                <label>OPERATEUR 3</label>
                <input type="text" class="form-control form-control-sm op" name="ED_OPERATEUR_3" value="<?= $data->ED_OPERATEUR_3 ?>">
            </div>
            <div class="form-group col-md-3">
                <label>QC</label>
                <input type="text" class="form-control form-control-sm ED_QC" name="ED_QC" value="<?= $data->ED_QC ?>">
            </div>
            <div class="form-group col-md-3">
                <label>TAILLE</label>
                <input type="text" class="form-control form-control-sm" name="ED_TAILL" value="<?= $data->ED_TAILL ?>">
            </div>

            <div class="form-group col-md-3">
                <label>QUART</label>
                <select class="form-control form-control-sm" name="ED_QUART">
                    <?php if ($data->ED_QUART == "J") : ?>
                        <option selected>J</option>
                        <option>N</option>
                    <?php else : ?>
                        <option selected>N</option>
                        <option>J</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>N° MACHINE</label>
                <select class="form-control form-control-sm" name="ED_MACHINE">

                    <?php foreach ($MACHINE as $key => $MACHINE) : ?>
                        <?php if ($MACHINE->MA_DESIGNATION == $data->ED_MACHINE) : ?>
                            <option selected><?= $MACHINE->MA_DESIGNATION ?></option>
                        <?php else : ?>
                            <option><?= $MACHINE->MA_DESIGNATION ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>DEBUT</label>
                <input type="time" class="form-control form-control-sm" name="EX_DEBUT" value="<?= $heure[0] ?>">
            </div>

            <div class="form-group col-md-3">
                <label>FIN </label>
                <input type="time" class="form-control form-control-sm" name="EX_FIN" value="<?=$heure[1]?>">
            </div>
            <div class="form-group col-md-3">
                <label>RESTE GAINE</label>
                <input type="text" class="form-control form-control-sm" name="ED_RESRT_GAINE" value="<?= $data->ED_RESTE_GAINE ?>">
            </div>

            <div class="form-group col-md-3">
                <label>OBSERVATION 1</label>
                <select class="form-control form-control-sm" name="ED_OBSERVATION">
                    <?php if ($data->ED_OBSERVATION == "") : ?>
                        <option selected></option>
                        <option>Suite</option>
                        <option>Suite à suivre</option>
                        <option>A suivre</option>
                    <?php elseif ($data->ED_OBSERVATION == "Suite") : ?>
                        <option></option>
                        <option selected>Suite</option>
                        <option>Suite à suivre</option>
                        <option>A suivre</option>
                    <?php elseif ($data->ED_OBSERVATION == "Suite à suivre") : ?>
                        <option></option>
                        <option>Suite</option>
                        <option selected>Suite à suivre</option>
                        <option>A suivre</option>
                    <?php else : ?>
                        <option></option>
                        <option>Suite</option>
                        <option>Suite à suivre</option>
                        <option selected>A suivre</option>
                    <?php endif; ?>
                </select>
                <option></option>

                </select>
            </div>
            <div class="form-group col-md-12">
                <label>OBSERVATION 2</label>
                <textarea class="form-control form-control-sm" name="ED_OBSERVATION2"></textarea>
            </div>
    </fieldset>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('.ED_QC').autocomplete({
            source: base_url + "Production/autocompleteQC",
            appendTo: "#modalProccess"

        });

    })
</script>