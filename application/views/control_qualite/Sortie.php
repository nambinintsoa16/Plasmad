<fieldset class="border p-4 bg-white">
    <form>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="date-sortie">DATE DE SORTIE : </label>
                <input type="date" class="form-control form-control-sm" name="CS_DATE" id="CS_DATE">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">N°PO : </label>
                <input type="text" class="form-control reception form-control-sm auto" name="CS_PO" id="CS_PO">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">DIM : </label>
                <input type="text" class="form-control reception form-control-sm dim" id="CS_DIM" name="CS_DIM">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">TAILLE : </label>
                <select class="form-control form-control-sm tail" name="CS_TAIL" id="CS_TAIL">
                    <option></option>
                <select>
            </div>
            <div class="form-group col-md-3">
                <label for="reference">SORTIE : </label>
                <input type="text" class="form-control reference form-control-sm" name="CS_QTT" id="CS_QTT">
            </div>

            <div class="form-group col-md-3">
                <label for="quantite">N°BL : </label>
                <input type="text" id="quantite" class="form-control quantite form-control-sm" name="CS_BL" id="CS_BL">
            </div>
            <div class="form-group col-md-12">
                <label for="quantite">OBSERVATION</label>
                <textarea class="form-control" name="CS_obs"></textarea>
            </div>
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-danger  m-2">Annuler</button>
                <button class="btn btn-success">Enregistrer</button>
            </div>
    </form>
</fieldset>