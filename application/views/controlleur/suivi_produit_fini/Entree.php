<fieldset class="border p-4 bg-white">
    <form method="POST" action="">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="date-sortie">DATE D'ENTRE : </label>
                <input type="date" class="form-control form-control-sm" name="date">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">N°PO : </label>
                <input type="text" class="form-control reception form-control-sm" id="refnum" name="refnum">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">Référence CLIENT : </label>
                <input type="text" disabled class="form-control reception form-control-sm client">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">Code CLIENT : </label>
                <input type="text" disabled class="form-control reception form-control-sm Codeclient">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">DIM : </label>
                <input type="text" disabled class="form-control reception form-control-sm dim">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">TAILLE : </label>
                <input type="text" class="form-control reception form-control-sm " name="taille">
            </div>

            <div class="form-group col-md-3">
                <label for="reference">ENTRE : </label>
                <input type="text" class="form-control reference form-control-sm" name="entree">
            </div>

            <div class="form-group col-md-3 ">
                <label for="quantite">TYPE : </label>
                <select class="form-control form-control-sm typeSortie" name="type">
                    <option value="entree">ENTREE</option>
                    <option value="retour">RETOUR</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="quantite">OBSERVATION</label>
                <textarea class="form-control" name="obs"></textarea>
            </div>
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-danger  m-2">Annule</button>
                <button class="btn btn-success"> <i class="fa fa-save" aria-hidden="true"></i>&nbsp; Enregistré</button>
            </div>
    </form>
</fieldset>