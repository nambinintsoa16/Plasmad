<div class="row">
	<div class="col-md-6">
		<input type="text" class="form-control form-control-sm auto" placeholder="N°PO">
	</div>
	<div class="col-md-6">
		<a href="#" class="btn btn-danger btn-sm terminer"> <i class="fa fa-check"></i> TERMINER</a>
		<a href="#" class="btn btn-info btn-sm infoProduit"> <i class="fa fa-tv"></i> AFFICHER</a>
	</div>
</div>
<hr />

<div class="table-responsive">
	<table class="w-100 table-bordered bordered-dark table-hover table-sm DataTable" >
		<thead class="bg-<?= $nav_color ?> text-white text-center text-sm">
			<tr>
				<th>PO</th>
				<th>DATE</th>
				<th>DATE_DE_LIVRAISON</th>
				<th>CLIENT</th>
				<th>CODE_CLIENT</th>
				<th>TYPE_DE_PRODUIT</th>
				<th>TYPE_DE_MATIER</th>
				<th>TYPE</th>
				<th>ECHANTILLON</th>
				<th>MODELE</th>
				<th>IMPRESSION</th>
				<th>DIMENSION</th>
				<th>REASSORT</th>
				<th>RABAT</th>
				<th>SOUFFLET</th>
				<th>PERFORATION</th>
				<th>QTY</th>
				<th>OBSERVATION</th>
			</tr>
		</thead>
		<tbody class="bg-default text-dark tbody noplan">

		</tbody>
	</table>
</div>



<div class="modal fade" id="observation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?=$nav_color?>">
                <p class="modal-title text-center" id="exampleModalLongTitle">
                    Obeservation PE N° : <span class="npeObs"></span>
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body obse-content border-dark">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success valideAnnull">Valider</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header bg-<?=$nav_color?> text-white">
					<b> BON DE COMMANDE</b>
				</div>
				<div class="card-body">
					<div class="form">
						<form>
							<fieldset class="col-md-12 border">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="date">Date : </label>
										<input type="text" name="date" disabled class="form-control form-control-sm date">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_PE">PE N° : </label>
										<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
										<input type="text" name="BC_CLIENT" disabled class="form-control form-control-sm BC_TYPEPRODUIT ">
									</div>
									<div class="form-group col-md-3">
										<label for="BC_CLIENT">CLIENT, Référence : </label>
										<input type="text" name="BC_CLIENT" disabled class="form-control form-control-sm BC_CLIENT ">
									</div>
									<div class="form-group col-md-3">
										<label for="BC_CODE">CODE : </label>
										<input type="text" name="BC_CODE" disabled class="form-control form-control-sm BC_CODE">
									</div>
									<div class="form-group col-md-3">
										<label for="BC_DATELIVRE">Date de livraison : </label>
										<input type="date" name="BC_DATELIVRE" disabled class="form-control form-control-sm BC_DATELIVRE">
									</div>
								</div>
							</fieldset>
							<fieldset class="col-md-12 border mt-2">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="BC_REASSORT">Reassort : </label>
										<input type="text" name="BC_REASSORT" disabled class="form-control form-control-sm BC_REASSORT ">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_ECHANTILLON">Echantillon : </label>
										<input type="text" name="BC_ECHANTILLON" disabled class="form-control form-control-sm BC_ECHANTILLON">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_DIMENSION">Dimension : </label>
										<input type="text" name="BC_DIMENSION" disabled class="form-control form-control-sm BC_DIMENSION">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_RABAT">Rabat : </label>
										<input type="text" name="BC_RABAT" disabled class="form-control form-control-sm BC_RABAT">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_SOUFFLET">Soufflet : </label>
										<input type="text" name="BC_SOUFFLET" disabled class="form-control form-control-sm BC_SOUFFLET">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_PERFORATION">Perforation : </label>
										<input type="text" name="BC_PERFORATION" disabled class="form-control form-control-sm BC_PERFORATION">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_TYPE">Type : </label>
										<input type="text" name="BC_TYPE" disabled class="form-control form-control-sm BC_TYPE">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_IMPRESSION">Impression : </label>
										<input type="text" name="BC_IMPRESSION" disabled class="form-control form-control-sm BC_IMPRESSION">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_CYLINDRE">Cylindre : </label>
										<input type="text" name="BC_CYLINDRE" disabled class="form-control form-control-sm BC_CYLINDRE">
									</div>
								</div>
							</fieldset>
							<fieldset class="col-md-12 border mt-2">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="BC_TYPEMATIER">Matiér : </label>
										<input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_TYPEMATIER">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_TYPEMATIER">QUANTITE A PRODUIRE EN METRE : </label>
										<input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_QUANTITEAPRODUIREENMETRE">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_TYPEMATIER">POIDS EN KG : </label>
										<input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_POISENKGSAVECMARGE">

									</div>

									<div class="form-group col-md-4">
										<label for="BC_QUNTITE">Quantité : </label>
										<input type="text" name="BC_QUNTITE" disabled class="form-control form-control-sm BC_QUNTITE">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_PRIX">Prix : </label>
										<input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_PRIX">
									</div>
								</div>
					</div>
					</fieldset>
					<fieldset class="col-md-12 border mt-2">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="BC_OBSERVATION">Observation : </label>
								<textarea disabled class="form-control BC_OBSERVATION"></textarea>
							</div>
						</div>
					</fieldset>
				</div>

			</div>
		</div>
	</div>

