<style>
  .dataTables_wrapper {
    padding: 2px !important;
  }

  * {
    scrollbar-width: thin;
    scrollbar-color: #346abf white;
  }

  ::-webkit-scrollbar {
    width: 3px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  }

  ::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
  }
</style>
<fieldset class="border p-3 bg-white">
  <div class="col-sm-12 ">
    <p class="w-100 text-right">
   <input type="date" id="date_commande">
   <input type="text" placeholder="N°PO" id="refnum">
   <a href="#" class="btn btn-success btn-sm" id="show_data"><i class="fa fa-tv"></i>&nbsp; Afficher</a>
    </p>
  </div>
</fieldset>
<fieldset class="border p-0 pt-2 mt-2 bg-white">
  <div class="table-responsive m-0 p-0 mt-3">
    <table class="w-100 table-bordered bordered-<?= $nav_color ?> table-hover table-responsive m-0" id="table_non_planifier">
      <thead class="bg-<?= $nav_color ?> text-white text-center">
        <tr>
          <th>PO</th>
          <th>DATE</th>
          <th>LIVRAISON</th>
          <th>CLIENT</th>
          <th>CODE</th>
          <th>PRODUIT</th>
          <th>MATIERE</th>
          <th>TYPE</th>
          <th>ECHANTILLON</th>
          <th>MODELE</th>
          <th>IMPRESSION</th>
          <th>DIMENSION</th>
          <th>REASSORT</th>
          <th>RABAT</th>
          <th>SOUFFLET</th>
          <th>PERFORATION</th>
          <th>QTY </th>
          <th>QTY_PROD</th>
          <th>P.SACHET</th>
          <th>P.AVEC_MARGE</th>
          <th>DIMENSION_PROD</th>
          <th>ROULEAUX</th>
          <th>OBSERVATION</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-body">

      </tbody>
    </table>
  </div>
  </div>
</fieldset>
<div class="modal fade bd-example-modal-lg" id="modal_form_job_card" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="card">
        <div class="card-header bg-<?= $nav_color ?> text-white">
          <b>CREATION JOB CARD</b>
        </div>
        <div class="card-body">
          <div class="form">
            <form method="post" action="<?= base_url('Commerciale/sauveCommande') ?>">
              <fieldset class="col-md-12 border">
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="BC_PE">PO N° : </label>
                    <input type="text" name="" disabled class="form-control form-control-sm" id="refnum_commande">
                  </div>
                </div>
              </fieldset>
              <fieldset class="col-md-12 border mt-2">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="">NOMBRE DE ROULEAUX: </label>
                    <input type="text" name="" class="form-control form-control-sm " id="nb_rouleaux">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="">POIDS D'UN SACHET : </label>
                    <input type="text" name="" class="form-control form-control-sm  " id="pois_sachet">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="">DIMENSION POUR LA PRODUCTION : </label>
                    <input type="text" name="" class="form-control form-control-sm  " id="dim_prod">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">QUANTITE A PRODUIRE EN METRE : </label>
                    <input type="text" name="" class="form-control form-control-sm " id="quantite_en_mettre">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">POIDS EN KG AVEC MARGE : </label>
                    <input type="text" name="" class="form-control form-control-sm " id="poids_en_kg">
                  </div>
                </div>
              </fieldset>
              <fieldset class="col-md-12 border mt-2">
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="BC_OBSERVATION">Matière première : </label>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="form-group">
                      <div class="input-group-append">
                        <input type="text" class="form-control form-control-sm " id="matiere" placeholder="Entre désignation">
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="form-group">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm " id="Quantite" placeholder="Quantité" aria-label="Entrée désignation" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <a href="#" class="input-group-text btn btn-primary text-white form-control-sm " id="add-table"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="form-group col-md-12">
                    <table class="w-100 table-bordered table-hover table-sm">
                      <thead class="bg-<?= $nav_color ?> text-white text-center">
                        <tr>
                          <th>N°</th>
                          <th>Designation</th>
                          <th>Quantite</th>
                          <th>PU</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="tbody_tab_matiere text-center">

                      </tbody>
                    </table>
                  </div>
                </div>
              </fieldset>
              <fieldset class="col-md-12 border mt-2">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="BC_OBSERVATION">Observation : </label>
                    <textarea class="form-control BC_OBSERVATION"></textarea>
                  </div>
                </div>
              </fieldset>

          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-success" id="lance_planning">ENREGISTRE</button>
            <button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
          </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<div class="modal fade" id="observation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-<?= $nav_color ?>">
        <p class="modal-title text-center" id="exampleModalLongTitle">
          Obeservation PE N° : <span class="refnum_commande"></span>
        </p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body obse-content border-dark">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>