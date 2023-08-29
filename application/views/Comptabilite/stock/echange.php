<div class="container p-0">
      <div class="row p-0 m-0">
            <div class="col-md-6">
                  <div class="card full-height">
                        <div class="card-body">
                              <div class="card-title"><b id="sortie_title">Plasmad</b></div>
                              <div class="card-category"><b>Sortie</b></div>
                              <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                    <div class="px-2 pb-2 pb-md-0 text-left col-md-6">
                                          <label>Produit : </label>
                                          <input type="text" class="form-control form-control-sm collapse" placeholder="Article" id="refnum_sortie">
                                          <input type="text" class="form-control form-control-sm produit_sortie" placeholder="Article" id="produit_sortie">
                                    </div>
                                    <div class="px-2 pb-2 pb-md-0 text-left col-md-6">
                                          <label>Quantité : </label>
                                          <input type="text" class="form-control form-control-sm " placeholder="Quantité" id="quantite_sortie">
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="col-md-6">
                  <div class="card full-height">
                        <div class="card-body">
                              <div class="card-title"><b id="entre_title">Madakem</b></div>
                              <div class="card-category"><b>Entree</b></div>
                              <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                    <div class="px-2 pb-2 pb-md-0 text-left col-md-6">
                                          <label>Produit : </label>
                                          <input type="text" class="form-control form-control-sm collapse" placeholder="Article" id="refnum_entree">
                                          <input type="text" class="form-control form-control-sm produit_entree" placeholder="Produit" id="produit_entree">
                                    </div>
                                    <div class="px-2 pb-2 pb-md-0 text-left col-md-6">
                                          <label>Quantité : </label>
                                          <input type="text" class="form-control form-control-sm" placeholder="Quantité" id="quantite_entree">
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <fieldset class="col-md-12 border w-100 bg-white">
                  <div class="row">
                        <div class="form-group col-md-4">
                              <div class="row">
                                    <label class="col-md-6 mt-2">Choix mouvement</label>
                                    <select class="form-control form-control-sm col-md-6" id="mouvement">
                                          <option>Plasmad -> Madakem</option>
                                          <option>Madakem -> Plasmad</option>
                                    </select>
                              </div>
                        </div>
                        <div class="form-group col-md-8 text-right">
                              <a href="#" class="btn btn-success" id="save_echange">
                                    <i class="fa fa-save"></i>&nbsp;Enregistre</a>
                        </div>
                  </div>
            </fieldset>
      </div>
</div>