<fieldset class="border p-0 bg-white mb-2 w-100">
    <div class="row">
        <div class="form-group col-md-12">
            <b class="pull-right pr-3">
                <input type="date" class="mr-3" id="debut" >
                <input type="date" class="mr-3" id="fin" >
                <button type="submit" class="btn btn-sm btn-primary" id="show_data"><i class="fa fa-tv"></i>
                &nbsp;&nbsp;Afficher</button>
            </b>
        </div>
    </div>
</fieldset>

<fieldset class="border p-0 bg-white m-0 pt-3" id="show_data">
    <table class="table-hover table-strepted table-bordered w-100 m-0" id="dataTable">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>
                <th>N°</th>
                <th>TYPE</th>
                <th>DIMENSION</th>
                <th>COMMANDE</th>
                <th>STATUT</th>
                <th>EXTRUSION</th>
                <th>IMPRESSION</th>
                <th>COUPE</th>
                <th>STOCK_MAG</th>
                <th>SURPLUS</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</fieldset>