<fieldset class="border  bg-white m-0 pl-3">
    <p class="text-right p-2 pr-3">
        <input type="date" name="" id="debut">
        <input type="date" name="" id="fin">
        <a href="#" class="btn btn-success btn-sm" id="show_data"><i class="fa fa-tv"></i> Valider</a>
    </p>
</fieldset>
<fieldset class="border p-0 bg-white m-0 pt-3 m-0 mt-2">
    <table class="table-hover table-strepted table-bordered w-100 m-0" id="table-suivi">

        <thead class="bg-<?=$nav_color?> text-white border">
            <tr>
                <th>N°PO</th>
                <th>TYPE</th>
                <th colspan="3">EXTRUSION</th>
                <th colspan="3">IMPRESSION</th>
                <th colspan="3">COUPE</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>SORTIE MAGASIN</th>
                <th>UTILISER</th>
                <th>NON UTILISER</th>

                <th>SORTIE EXTRUSION</th>
                <th>IMPRIMER</th>
                <th>NON IMPRIMER</th>

                <th>SORTIE IMPRESSION</th>
                <th>COUPER</th>
                <th>NON COUPER</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</fieldset>