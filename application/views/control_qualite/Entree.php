<fieldset class="col-md-12 border bg-white">
    <div class="row">
        <div class="form-group col-md-4">
            <label>N° PO</label>
            <input type="text" class="form-control form-control-sm"  id="refnum_commande">
        </div>
        <div class="form-group col-md-4">
            <label>DIM </label>
            <input type="text" class="form-control form-control-sm"  id="dimm">
        </div>
        <div class="form-group col-md-4">
            <label>NOM QC </label>
            <input type="text" class="form-control form-control-sm" id="operateur">
        </div>
        <div class="form-group col-md-4">
            <label>TAILLE </label>
            <input type="text" class="form-control form-control-sm" id="tail">
        </div>

        <div class="form-group col-md-4">
            <label>POIDS</label>
            <input type="number" class="form-control form-control-sm " id="poid_entree" value="0">
        </div>

        <div class="form-group col-md-4">
            <label>QTT ENTREE</label>
            <input type="number" class="form-control form-control-sm " id="qtt_entre" value="0">
        </div>
        <div class="form-group col-md-4">
            <label>2EME CHOIX </label>
            <input type="number" class="form-control form-control-sm " id="deuxieme_choix" value="0">
        </div>

    
        <div class="form-group col-md-4">
            <label>QTY STIE</label>
            <input type="number" class="form-control form-control-sm " disabled id="qtt_stie" value="0">
        </div>
        <div class="form-group col-md-12 text-right">
            <button class="btn btn-success" id="save_entree_control_quality"><i class="fa fa-save"></i> Enregistre</button>
        </div>
    </div>
</fieldset>

<!-- <fieldset class="col-md-12 border mt-2 pt-2  bg-white">
   <div class="row">
        <div class="form-group col-md-10">
            <input type="date" class="form-control form-control-sm rechDate col-md-2 pull-right">
        </div>
        <div class="form-group col-md-2">
            <button class="btn btn-primary btn-sm dateAffiche"><i class="fa fa-tv"></i>&nbsp;Affichier</button>
        </div>
    </div>
</fieldset>  --> 
<fieldset class="col-md-12 border mt-2 pt-2  bg-white">
    <table class=" table-strepted table-hover table-bordered table-sm w-100" id="table_control_qualite">
        <thead class="bg-<?=$nav_color?> text-white">
            <tr>
                <th>DATE</th>
                <th>PO</th>
                <th>NOM QC</th>
                <th>POIDS</th>
                <th>QTT ENTREE</th>
                <th>2eme choix</th>
                <th>QTy Stie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="dataPoResult">
        </tbody>
    </table>
</fieldset>