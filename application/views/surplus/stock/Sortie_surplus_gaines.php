<fieldset class="border p-4 bg-white">
    <form>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="date-sortie">DATE D'ENTREE : </label>
                <input type="date" class="form-control form-control-sm" name="date_entre" id="date_entre">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">N°PO : </label>
                <input type="text" class="form-control reception form-control-sm auto" name="PO" id="refnum_surplus">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">CLIENT : </label>
                <input type="text" class="form-control reception form-control-sm client" disabled id="client">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">DIM : </label>
                <input type="text" class="form-control reception form-control-sm dim" disabled id="dim">
            </div>
            <div class="form-group col-md-3">
                <label for="reception">TAILLE : </label>
                <select class="form-control form-control-sm tail" name="tail" id="tail_suplus">

                    <select>
            </div>
            <div class="form-group col-md-3">
                <label for="reception">QUANTITE DISPONIBLE : </label>
                <input type="number" class="form-control form-control-sm" disabled name="quantite_disponible" id="quantite_disponible">
            </div>

            <div class="form-group col-md-3">
                <label for="reference">SORTIE : </label>
                <input type="number" class="form-control reference form-control-sm" name="sortie" id="quantite_surplus">
            </div>

            <div class="form-group col-md-3">
                <label for="quantite">N°BL : </label>
                <input type="text" class="form-control quantite form-control-sm" name="BL" id="BL">
            </div>
            <div class="form-group col-md-3">
                <label for="quantite">N° PO SORTIE : </label>
                <input type="text"  class="form-control posortie form-control-sm" name="posortie" id="refnum">
            </div>
            <div class="form-group col-md-12">
                <label for="quantite">OBSERVATION</label>
                <textarea class="form-control" id="obs"></textarea>
            </div>
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-danger  m-2">Annule</button>
                <button class="btn btn-success" id="create_sortie_surplus">Enregistré</button>
            </div>
    </form>
</fieldset>