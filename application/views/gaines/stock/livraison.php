<div class="container m-0 p-0 bg-white">
    <fieldset class="col-md-12 border mt-2 w-100 pt-3">
        <form method="post" action="">
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm auto" name="PO" placeholder="N°PO :" id="refnum_commande">
                </div>
            </div>
    </fieldset>
    <fieldset class="col-md-12 border mt-2 w-100 pt-3">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="reception">CODE CLIENT : </label>
                <input type="text" class="form-control reception form-control-sm code" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="reception">CLIENT : </label>
                <input type="text" class="form-control reception form-control-sm client" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="reception">DIM : </label>
                <input type="text" class="form-control reception form-control-sm dim" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="reception">QUANTITE A LIVREE : </label>
                <input type="text" class="form-control reception form-control-sm quantite" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="reception">QUANTITE DISPONIBLE : </label>
                <input type="number" class="form-control reception form-control-sm quantite_disponible" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="reception">LIVREE : </label>
                <input type="text" class="form-control reception form-control-sm livre" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="reception">RESTE A LIVRE : </label>
                <input type="text" class="form-control reception form-control-sm reste" disabled>
            </div>
        </div>
    </fieldset>

    <fieldset class="border p-4">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="date-sortie">DATE DE SORTIE : </label>
                <input type="date" class="form-control form-control-sm date_entre" name="date_entre">
            </div>

            <div class="form-group col-md-4">
                <label for="reception">TAILLE : </label>
                <select class="form-control form-control-sm tail" name="tail">
                    <select>
            </div>

            <div class="form-group col-md-4">
                <label for="reference">SORTIE : </label>
                <input type="number" class="form-control sortie form-control-sm" name="sortie">
            </div>
        <!--    <div class="form-group col-md-4">
                <label for="surplus">N° PO SURPLUS : </label>
                <input type="text" id="surplus" class="form-control surplus form-control-sm" name="BL">
            </div>

            <div class="form-group col-md-4">
                <label for="reception">TAILLE SURPLUS : </label>
                <select class="form-control form-control-sm tailSuplus" name="tailSuplus" id="tail_suplus">
                    <select>
            </div>
            <div class="form-group col-md-4">
                <label for="quantite">QUANTITE SURPLUS : </label>
                <input type="text" id="quantite" class="form-control quantitesuplus form-control-sm" name="BL">
            </div>-->
            <div class="form-group col-md-4">
                <label for="quantite">N°BL : </label>
                <input type="text" id="quantite" class="form-control form-control-sm BL" name="BL">
            </div>
            <div class="form-group col-md-12">
                <label for="quantite">OBSERVATION</label>
                <textarea class="form-control obs" name="obs"></textarea>
            </div>
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-danger  m-2">Annulé</button>
                <button type="submit" class="btn btn-success" id="save_sortie">Enregistré</button>
            </div>
            </form>
    </fieldset>

    <fieldset class="col-md-12 border mt-2 w-100 mb-2">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">SORTIE - SURPLUS</label>
            </div>
    </fieldset>
    <fieldset class="border p-2">
        <table class=" table-sm table-bordered table-hover table-strepted w-100" id="data_sortie">
            <thead class="bg-<?= $nav_color ?> text-white">
                <tr>
                    <th>DATE</th>
                    <th>PERSONNEL</th>
                    <th>N°PO</th>
                    <th>TAILLE</th>
                    <th>QUANTITE</th>
                </tr>
            </thead>
            <tbody class="table-body">
            </tbody>
        </table>
    </fieldset>
</div>