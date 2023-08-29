<fieldset class="col-md-12 border mt-2 w-100 p-3 bg-white">
    <b class="pull-right">
        <input type="text" class="mr-3 po" name="po" placeholder="Entre N°PO" id="refnum_commande">
        <input type="date" class="mr-3 choixdate" name="date">
        <button type="submit" class="btn btn-success btn-sm" id="changeDate">AFFICHER</button>
        <a href="#" class="btn btn-sm btn-primary" id="print_data"><i class="fa fa-download"></i>&nbsp;&nbsp;Exporter</a>
        <!--<a href="<?= base_url("stock/printLivraison") ?>" class="btn btn-sm btn-primary print"><i class="fa fa-print"></i>Imprimer</a>-->
    </b>

</fieldset>
<fieldset class="border w-100 p-0 w-100 pt-3 mt-2" id="data_containt">
    
</fieldset>