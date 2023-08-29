<fieldset class="col-md-12 border mt-2 w-100 pt-3 bg-white">
    <b class="pull-right"> 
    <input type="text" name="" placeholder="N° PO" id="autocomplete_refnum_commande">
        <select id="type"style="height: 30px;">
            <option value="entree">Entrée</option>
            <option value="sortie">Sortie</option>
        </select>
       
        <button class="btn btn-success btn-sm mb-1" id="show_data"><i class="fa fa-tv"></i> Afficher</button>
    </b>
</fieldset>

<fieldset class="col-md-12 border mt-2 w-100 pt-3 bg-white">
    <table class=" table-sm table-bordered table-hover table-strepted w-100" id="dataTable">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>USER</th>
                <th>PO</th>
                <th>QUANTITE</th>
                <th>TAILLE</th>
                <th>OBS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</fieldset>