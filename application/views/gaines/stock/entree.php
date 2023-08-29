<fieldset class="border p-4 shadow-sm">
    <form method="POST" action="">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="date-sortie">DATE D'ENTRE : </label>
                <input type="date" class="form-control form-control-sm" id="date" name="date">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">N°PO : </label>
                <input type="text" class="form-control reception form-control-sm " id="refnum" name="PO">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">Référence CLIENT : </label>
                <input type="text" disabled class="form-control reception form-control-sm "id="client" name="client">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">Code CLIENT : </label>
                <input type="text" disabled class="form-control reception form-control-sm "id="Codeclient" name="Codeclient">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">DIM : </label>
                <input type="text" disabled class="form-control reception form-control-sm " id="dim" name="dim">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">TAILLE : </label>
                <input type="text" class="form-control reception form-control-sm " id="taille" name="taille">
            </div>

            <div class="form-group col-md-3">
                <label for="reference">ENTREE : </label>
                <input type="text" class="form-control reference form-control-sm" id="entre" name="entre">
            </div>
            <div class="form-group col-md-12">
                <label for="quantite">OBSERVATION</label>
                <textarea class="form-control" id="obs" name="obs"></textarea>
            </div>
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-danger  m-2" type="reset"> <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Annule</button>
                <button class="btn btn-success" type="submit"> <i class="fa fa-save" aria-hidden="true"></i>&nbsp; Enregistré</button>
            </div>
    </form>
</fieldset>