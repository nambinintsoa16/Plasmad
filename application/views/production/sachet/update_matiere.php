<div class="container">
    <div class="row">
        <fieldset class="col-md-12 border mt-2 bg-white">
            <div class="row ">
                <div class="form-group">
                    <input type="text" name="PO" class="form-control form-control-sm " placeholder="Entrée N°PO" id="autocomplete_refnum_commande">
                </div>
            </div>
        </fieldset>
        <fieldset class="col-md-12 border mt-2 p-2 bg-white">
            <table class="w-100 table-hover table-bordered table-strepted pl-2" id="table_matiere">
                <thead class="bg-<?=$nav_color?> text-white ">
                    <tr>
                        <td>ID</td>
                        <td>DATE</td>
                        <td>N°PO</td>
                        <td>DESIGNATION</td>
                        <td>QUANTITE</td>
                        <td>PRIX</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody class="dataPoResult">
                </tbody>
            </table>
        </fieldset>
    </div>
</div>