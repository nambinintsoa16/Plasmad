 <h4 class="ml-2"><b>Sachet</b></h4>
 <div class="row bg-white p-3 m-1 border">
    <p class="text-right w-100">
        <span class="pull-left">
            <label>Last refnum : </label>&nbsp;&nbsp;<span id="refnum_now">--------</span>
        </span>
        <label>Initialiser : </label>
        <select class="mr-2 type" style="width: 70px;height: 27px;" id="int_table" name="type">
            <?php foreach ($type_de_matier as $row) : ?>
                <option hidden>--------</option>
                <option><?= $row->TM_DESIGNATION ?></option>
            <?php endforeach ?>
        </select>
        <label for="BC_PE">TYPE PO : </label>
        <select  class="mr-2 type" style="width: 120px;height: 27px;" id="type">
            <option hidden>--------</option>
            <option>EPZ</option>
            <option>CMTI I</option>
            <option>CMTI MADA</option>
        </select>
        <label>Début : </label>
        <input type="text" class="mr-3" id="refnum" placeholder="refnum">
        <button type="submit" class="btn btn-sm btn-primary" id="show_result"><i class="fa fa-tv"></i>
            Valider</button>
    </p>
</div>
<h4 class="ml-2"><b>Cintre</b></h4>
<div class="row bg-white p-3 m-1 border">
    <p class="text-right w-100">
        <span class="pull-left">
            <label>Last refnum : </label>&nbsp;&nbsp;<span id="refnum_now_cintre">--------</span>
        </span>
        <label for="BC_PE">TYPE PO : </label>
        <select  class="mr-2 type" style="width: 120px;height: 27px;" id="type_cintre">
            <option hidden>--------</option>
            <option>EPZ</option>
            <option>CMTI</option>
        </select>
        <label>Début : </label>
        <input type="text" class="mr-3" id="refnum_cintre" placeholder="refnum">
        <button type="submit" class="btn btn-sm btn-primary" id="show_result_cintre"><i class="fa fa-tv"></i>
            Valider</button>
    </p>
</div>
