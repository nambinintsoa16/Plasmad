<div class="row bg-white p-3 m-1 border">
    <form action="" method="post" class="m-auto">
       <!-- <select class="origin" style="width: 100px;height: 27px;" name="origin">
            <option>Plasmad</option>
            <option>Madakem</option>
        </select>-->
        <label>Type : </label>
        <select class="mr-2 type" style="width: 70px;height: 27px;" name="type">
            <option>PE</option>
            <option>PP</option>
        </select>

        <label>N°PO : </label>
        <input type="text" class="mr-3 numpo" name="po" placeholder="N°PO">
        <label>DEBUT : </label>
        <input type="date" class="mr-3 dateCost" name="date">
        <label>FIN : </label>
        <input type="date" class="mr-3 dateCostFin" name="findate">
        <button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
            Afficher</button>
        <a href="<?= base_url("Comptabilite/export_costing_excel") ?>" class="btn btn-sm btn-success export">
            <i class="fas fa-file-excel"></i>&nbsp;EXPORT
        </a>
    </form>
</div>
<div class="row bg-white mt-2 border m-1" id="result_containt">

</div>
<div class="modal fade" id="modaleInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?=$nav_color?>">
                <h5 class="modal-title" id="exampleModalLongTitle">DETAIL PRODUCTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dataProd">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">FERMER</button>
            </div>
        </div>
    </div>
</div>