<fieldset class="border p-3 bg-white">
    <div class="col-sm-12 ">
        <div class="row">
            <div class="form-group col-md-12">
                <b>DATE <span id="date_show">DU : <?= date("d-m-Y") ?></span></b>
            </div>
            <div class="form-group">
                Début : &nbsp;&nbsp; <input type="date" id="debut">
                &nbsp;&nbsp;Fin : &nbsp;&nbsp;<input type="date" id="fin">
            </div>
            <div class="form-group">
                <a href="#" class="btn btn-success btn-sm mb-2" id="show_data"><i class="fa fa-tv"></i>&nbsp; Afficher</a>
            </div>
        </div>
    </div>
</fieldset>
<fieldset class="border p-0 pt-2 mt-2 bg-white">
    <table class="w-100 table-bordered bordered table-hover m-0" id="dataTable">
        <thead class="bg-<?= $nav_color ?> text-white">
            <tr>
                <th>Machine</th>
                <th>Poids/kgs</th>
                <th>Metrage</th>
                <th>PCS</th>
                <th>DECHET</th>
                <th>Hours</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</fieldset>