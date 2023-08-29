<div class="card">
	<div class="card-body">
		<div class="form">
			<form method="post" action="<?= base_url('Commercial/sauveCommandeSachet') ?>">
				<fieldset class="col-md-12 border bg-white">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="date">DATE : </label>
							<input type="text" name="BC_DATE" class="form-control form-control-sm BC_DATE" value=<?= date('d-m-Y') ?>>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_PE">TYPE PO : </label>
							<select class="form-control form-control-sm BC_TYPEPO custom-select" name="BC_TYPEPO">
								<option>EPZ</option>
								<option>CMTI I</option>
								<option>CMTI MADA</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_PE" class="titlePO">PE N° : </label>
							<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="<?=$num_po?>">
						</div>
						<div class="form-group col-md-3">
							<label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
							<select class="form-control form-control-sm BC_TYPEPRODUIT custom-select" name="BC_TYPEPRODUIT">
								<option>SACHETS</option>
								<option>GAINES</option>
								<option>PUCE DE TAILLES</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="BC_CLIENT">CLIENT, Référence : </label>
							<input type="text" name="BC_CLIENT" class="form-control form-control-sm BC_CLIENT ">
						</div>
						<div class="form-group col-md-3">
							<label for="BC_CODE">CODE : </label>
							<input type="text" name="BC_CODE" class="form-control form-control-sm BC_CODE">
						</div>
						<div class="form-group col-md-3">
							<label for="">TYPE DE MATIERE USE : </label>
							<select class="form-control form-control-sm BC_TYPE_MATIERE_USE custom-select" name="BC_TYPEPRODUIT">
								<option>NORMAL</option>
								<option>RECYCLE</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="BC_DATELIVRE">DATE DE LIVRAISON : </label>
							<input type="date" name="BC_DATELIVRE" class="form-control form-control-sm BC_DATELIVRE">
						</div>
						<div class="form-group col-md-3">
							<label for="BC_LIEU">LIEU DE LIVRAISON : </label>
							<input type="text" name="BC_LIEU" class="form-control form-control-sm BC_LIEU">
						</div>
						<div class="form-group col-md-3">
							<label>TYPE DE PRODUIT</label>
							<select class="form-control typeDeproduit form-control-sm BC_TYPE_PRODUIT custom-select" name="BC_TYPE_PRODUIT">
								<option value="1">direct Printed PE rolls</option>
								<option value="2">PE Plain Guzzet Bags</option>
								<option value="3">Direct rolls PE plain</option>
								<option value="4">PE Plain Bottom Seal Bag</option>
								<option value="5">PE Bottom seal Colour</option>
								<option value="6">PE Bottom Seal Bag printed</option>
								<option value="7">PE Side Seal Printed bag</option>
								<option value="8">PP side seal Plain bag</option>
								<option value="9">PP side seal Printed</option>
								<option value="10">PE Polysheet</option>
							</select>
						</div>
					</div>
				</fieldset>
				<fieldset class="col-md-12 border mt-2">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="BC_REASSORT">Reassort : </label>
							<input type="text" name="BC_REASSORT" class="form-control form-control-sm BC_REASSORT ">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_ECHANTILLON">Echantillon : </label>
							<input type="text" name="BC_ECHANTILLON" class="form-control form-control-sm BC_ECHANTILLON">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_DIMENSION">Dimension : </label>
							<input type="text" name="BC_DIMENSION" class="form-control form-control-sm BC_DIMENSION">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_RABAT">Rabat : </label>
							<input type="text" name="BC_RABAT" class="form-control form-control-sm BC_RABAT">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_SOUFFLET">Soufflet : </label>
							<input type="text" name="BC_SOUFFLET" class="form-control form-control-sm BC_SOUFFLET">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_PERFORATION">Perforation : </label>
							<input type="text" name="BC_PERFORATION" class="form-control form-control-sm BC_PERFORATION">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_TYPE">Type : </label>
							<select class="form-control BC_TYPE form-control-sm custom-select" name="BC_TYPE">
								<?php foreach ($type as $key => $type) : ?>
									<option><?= $type->TF_DESIGNATION ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_IMPRESSION">Impression : </label>
							<input type="text" name="BC_IMPRESSION" class="form-control form-control-sm BC_IMPRESSION">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_CYLINDRE">Cylindre : </label>
							<input type="text" name="BC_CYLINDRE" class="form-control form-control-sm BC_CYLINDRE">
						</div>
					</div>
				</fieldset>
				<fieldset class="col-md-12 border mt-2">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="BC_TYPEMATIER">Matière : </label>
							<select class="form-control BC_TYPEMATIER form-control-sm custom-select" name="BC_TYPEMATIER">
								<?php foreach ($type_de_matier as $key => $type_de_matier) : ?>
									<option><?= $type_de_matier->TM_DESIGNATION ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_QUNTITE">Quantité commandée: </label>
							<input type="numeric" name="BC_QUNTITE" class="form-control form-control-sm BC_QUNTITE">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_QUNTITE">Quantité à produire: </label>
							<input type="numeric" name="BC_QUNTITEPRO" class="form-control form-control-sm BC_QUNTITEPRO">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_CON_PRIX">Prix consenti par le client en USD: </label>

							<input type="text" name="BC_PRIX" class="form-control form-control-sm BC_PRIX">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_CON_PRIX">Prix consenti par le client en euro: </label>

							<input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_PRIXEURO">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_PRIX">Prix calculé : </label>
							<input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm BC_CON_PRIX">
						</div>



					</div>
		</div>
		</fieldset>
		<fieldset class="col-md-12 border mt-2">
			<div class="row">

				<!--/***************************************** PLanning ***************************************************/-->
				<div class="form-group col-md-4 ">
					<label for="BC_PRIX">Quantité à produire en mètre : </label>
					<input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm QttMetre">
				</div>


				<div class="form-group col-md-4 ">
					<label for="BC_PRIX">Poids d'un sachet : </label>
					<input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm poidSachet">
				</div>
				<div class="form-group col-md-4 ">
					<label for="BC_PRIX">Poids en Kg avec marge : </label>
					<input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm poidMarge">
				</div>


				<div class="form-group col-md-4 ">
					<label for="BC_PRIX">Dimension pour la production : </label>
					<input type="text" name="BC_CON_PRIX " disabled class="form-control form-control-sm rollDim">
				</div>

				<div class="form-group col-md-4 ">
					<label for="BC_PRIX">Nombre de rouleaux : </label>
					<input type="text" name="BC_CON_PRIX " class="form-control form-control-sm NROULEAUX">
				</div>

				<!--/*******************************************************************************************************/-->
			</div>
		</fieldset>
		<fieldset class="col-md-12 border mt-2">
			<div class="row">
				<div class="form-group col-md-12">
					<label for="BC_OBSERVATION">Observation : </label>
					<textarea class="form-control BC_OBSERVATION" id="BC_OBSERVATION"></textarea>
				</div>
			</div>
		</fieldset>
		</form>
	</div>
	<div class="card-footer text-right">
		<!-- <a href="<?= base_url('Commercial/printFacture') ?>" class="btn btn-info print"><i class="fa fa-print"></i> Imprimer</a>-->
		<button type="submit" class="btn btn-success saveCommande">Enregistre</button>
		<button type="reset" class="btn btn-danger">Annuler</button>
	</div>
</div>
</div>


<div class="modal fade bd-example-modal-lg PrixCalc" id="infoCOmmandes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header bg-<?=$nav_color?> text-white">
					<b> PRIX USD</b>
				</div>
				<div class="card-body">
					<div class="form">
						<form>
							<fieldset class="col-md-12 border">
								<div class="row">
									<div class="form-group col-md-3">
										<label>width : </label>
										<input type="numeric" class="form-control form-control-sm width">
									</div>
									<div class="form-group col-md-3">
										<label>length : </label>
										<input type="numeric" class="form-control form-control-sm length">
									</div>
									<div class="form-group col-md-3">
										<label>thickness : </label>
										<input type="numeric" class="form-control form-control-sm thickness">
									</div>
									<div class="form-group col-md-3">
										<label>Flap : </label>
										<input type="numeric" class="form-control form-control-sm Flap">
									</div>
									<div class="form-group col-md-3">
										<label>Bottom Gusset : </label>
										<input type="numeric" class="form-control form-control-sm Gusset">
									</div>
									<div class="form-group col-md-3">
										<label>Printing area : </label>
										<input type="text" class="form-control form-control-sm Printing_area ">
									</div>
									<div class="form-group col-md-3">
										<label>Order qty-pcs : </label>
										<input type="numeric" class="form-control form-control-sm Order">
									</div>
									<!--
									<div class="form-group col-md-3">
										<label>Marge prix : </label>
										<input type="text" class="form-control form-control-sm marges">
									</div>
									-->
									<div class="form-group col-md-3">
										<label>Marge matière: </label>
										<input type="text" class="form-control form-control-sm margex">
									</div>
									<div class="form-group col-md-3">
										<label>Prix matière: </label>
										<input type="text" class="form-control form-control-sm Prix_matier">
									</div>
									<div class="form-group col-md-3">
										<label>Vitesse machine: </label>
										<input type="text" class="form-control form-control-sm VitesseMachine">
									</div>
									<div class="form-group col-md-3">
										<label>Taux ( USD => EURO ): </label>
										<input type="text" id="taux_usd_euro" class="form-control form-control-sm taux_usd_euro">
									</div>
									
								</div>
							</fieldset>
							<hr />
							<div class="col-md-4 w-25 text-left">
								<label>Marge : </label>
								<div class="input-group mb-3">
									<input type="numeric" id="marge_pourcent" class="form-control" placeholder=""  aria-describedby="basic-addon2">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2">%</span>
									</div>
								</div>
							</div>
							<hr />
							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-primary btn-sm afficherR text-left"><i class="fa fa-calculator"></i> Calcule</button>
							</div>
							

							<hr />

							<div class="col-md-12 w-100 text-left">
								<label>Prix P.R.I : </label>
								<input type="numeric" id="prix_pri" class="form-control col-md-8 form-control-sm prix" disabled placeholder="Prix USD">
								<label>Prix avec marge : </label>
								<input type="numeric" id="total_avec_marge" class="form-control col-md-8 form-control-sm total" disabled placeholder="Prix  USD avec marge">

							</div>

							
							<hr />
							<div class="form-group col-md-12 text-left">
							    <label>Prix de Vente : </label>
								<input type="text" id="prix_de_vente" class="form-control form-control-sm prixdefault">
							</div>
							<div class="form-group col-md-12 text-left">
							    <label>Prix de Vente en euro : </label>
								<input type="text" id="prixdefaultEuro" class="form-control form-control-sm prixdefaultEuro">
							</div>
							<hr />
							<div class="form-group col-md-12 text-right">
								<button type="button" id="calcul_marge_reel" class="btn btn-primary btn-sm text-left"><i class="fa fa-calculator"></i> Calcule Marge Reel / Euro</button>
							</div>
							
							

							
							<div class="form-group col-md-3 text-left">
							    <label>Marge Réel: </label>
								<div class="input-group mb-3">
									<input type="numeric" id="marge_reel" class="form-control" placeholder=""  aria-describedby="basic-addon2">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2">%</span>
									</div>
								</div>
								
							</div>
				
							<div class="form-group col-md-12 text-left">
							    <label>Prix EURO (du prix de vente): </label>
								<input type="text" id="prixdefaultEURO" class="form-control form-control-sm prixdefaultEURO">
							</div>



					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-success valider">Valider</button>
						<button type="reset" class="btn btn-danger">Annuler</button>
					</div>
					</form>
				</div>
			</div>
