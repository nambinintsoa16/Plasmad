<fieldset class="border p-4 bg-white">
    <form method="POST" action="">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="date-sortie">DATE D'ENTREE : </label>
                <input type="date" class="form-control form-control-sm" name="date" id="date">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">N°PO : </label>
                <input type="text" class="form-control reception form-control-sm" name="PO" id="refnum">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">Référence CLIENT : </label>
                <input type="text" disabled class="form-control reception form-control-sm " id="client">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">Code CLIENT : </label>
                <input type="text" disabled class="form-control reception form-control-sm " id="code_client">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">DIM : </label>
                <input type="text" disabled class="form-control reception form-control-sm " id="dim">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">TAILLE : </label>
                <select class="form-control reception form-control-sm " name="taille" id="tail">
                    
                </select>

            </div>

            <div class="form-group col-md-3">
                <label for="reference">ENTREE : </label>
                <input type="text" class="form-control reference form-control-sm" name="entre" id="quantite">
            </div>

            <div class="form-group col-md-3">
                <label for="quantite">N° RACK : </label>
                <input type="text"  class="form-control  form-control-sm" name="local" id="localisation">
            </div>
            <div class="form-group col-md-12">
                <label for="quantite">OBSERVATION</label>
                <textarea class="form-control obs" name="obs" id="obs"></textarea>
            </div>
            <div class="form-group col-md-12 text-right">
                <button type="reste" class="btn btn-danger  m-2">Annule</button>
                <button class="btn btn-success" id="save_entree">Enregistré</button>
            </div>
    </form>
</fieldset>