<div class="card w-100">
    <div class="card-header bg-white text-white">
        <b>RECAP SORTIER DES MATIERES</b>
        <b class="pull-right">
            <label>DEBUT : </label>
            <input type="date" class="mr-3 dateCost" name="date">
            <label>FIN : </label>
            <input type="date" class="mr-3 dateCostFin" name="findate">
            <input type="text" class="mr-3 reference" name="reference" placeholder="Référence matière">
            <button type="submit" class="btn btn-sm btn-primary AfficherMatier"><i class="fa fa-tv"></i>
             &nbsp;&nbsp;Afficher</button>
        </b>
    </div>
    <div class="card-body p-0">
        <fieldset class="col-md-12 border mt-2 w-100 p-0 pt-3 ">
            <table class=" table-sm table-bordered table-hover table-strepted tableRecapMatier w-100">
                <thead class="bg-<?=$nav_color?> text-white">
                    <tr>
                        <th>REFERENCE</th>
                        <th>QUANTITE</th>
                        <th>UNITE</th>
                        <th>N° PO</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </fieldset>
    </div>
</div>
</div>