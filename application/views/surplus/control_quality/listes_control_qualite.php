<fieldset class="col-md-12 border mt-2 pt-2  bg-white">
   <div class="row">
        <div class="form-group col-md-5">
            <input type="date" class="form-control form-control-sm col-md-9 " id="debut">
        </div>
        <div class="form-group col-md-5">
            <input type="date" class="form-control form-control-sm col-md-9 " id="fin">
        </div>
        <div class="form-group col-md-2">
            <button class="btn btn-primary btn-sm dateAffiche"><i class="fa fa-tv"></i>&nbsp;Affichier</button>
        </div>
    </div>
</fieldset>  
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
            </tr>
        </thead>
        <tbody class="dataPoResult">
        </tbody>
    </table>
</fieldset>