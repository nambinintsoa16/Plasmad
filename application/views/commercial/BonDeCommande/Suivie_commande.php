<style>

* {
   scrollbar-width: thin;
   scrollbar-color: #346abf white;
}
  ::-webkit-scrollbar {
    width: 3px;
}

::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
</style>
<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-2">
                    Début : <input type="date" class="debut form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    Fin : <input type="date" class="fin form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    N°PO : <input type="text" class="refnum_commande form-control form-control-sm" placeholder="Entrée N° PO">
                </div>
                <div class="col-md-2">
                      Code client :<input type="text" class="client form-control form-control-sm" placeholder="Entrée code client">
                </div>
                <div class="col-md-1 pt-1">
                    <button type="submit" class="btn btn-sm btn-info afficher mt-3"><i class="fa fa-tv"></i> Afficher</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 table-responsive m-0 mt-2 p-0  pt-2 bg-white">
        <table class="p-0 w-100  table-bordered" id="table_rapport_de_commande">
            <thead class="bg-<?= $nav_color ?> text-white">
                <tr>
                    <th>REFERENCE_CLIENT</th>
                    <th>PO_Date </th>
                    <th>Plasmad_PO_No.</th>
                    <th>STATUS</th>
                    <th>Customer</th>
                    <th>Dimensions</th>
                    <th>Order_Quantity</th>
                    <th>Required_Delivery_Date</th>
                    <th>Confirmed_Delivery_Date</th>
                    <th>Description_XIT</th>
                    <th>Delivered_qty</th>
                    <th>Actual_Delivered Date</th>
                    <th>Delivery_Month</th>
                    <th>Cfmd_Delivery Week</th>
                    <th>Unit_Price_USD</th>
                    <th>Amount_USD</th>
                    <th>Unit_Price_Euro</th>
                    <th>Amount_Euro</th>
                    <th>Production_Lead_time_(day)</th>
                    <th>Variance_Delivery_(day)</th>
                    <th>Varaince_Actual_Dlvry_(day)</th>
                    <th>Amount_Dlvd_USD</th>
                    <th>Amount_Dlvd_EURO</th>
                    <th>Balance_to_be_Dlvd_(Qty)</th>
                    <th>Bal_Amount_USD</th>
                    <th>Bal_Amount_Euro</th>

                    <th style="width:250x!important"></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
</div>
</div>



<div class="modal fade modalEditSuivie" id="modale-info" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?=$nav_color?>">
                <h5 class="modal-title" id="exampleModalLongTitle">PO N° : <span class="npo"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="container p-2">
                        <div class="row">
                            <div class="form-group m-auto col-md-12">
                                <label for="">Modifier</label>
                                <select class="form-control form-control-sm itemModif">
                                    <option>Delivered qty</option>
                                    <option>Unit Price Euro</option>
                                    <option>Amount Euro</option>
                                    <option>Production Lead-time (day)</option>
                                    <option>Variance Delivery (day)</option>
                                    <option>Varaince Actual Dlvry (day)</option>
                                    <option>Actual Delivered Date</option>
                                    <option>Amount-Dlvd USD</option>
                                    <option>Amount-Dlvd EURO</option>
                                    <option>Bal Amount USD</option>
                                    <option>Bal Amount Euro</option>
                                </select>
                            </div>
                            <div class="form-group m-auto col-md-12">
                                <label for="">Nouvel valeur</label>
                                <input type="text " class="form-control form-control-sm valeurModif">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success saveModif">Enregistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>