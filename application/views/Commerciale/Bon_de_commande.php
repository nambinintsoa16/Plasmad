<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Commerciale</a></li>
		<li class="breadcrumb-item"><a href="#">Bon de commande</a></li>
	</ol>
</nav>
<div class="card">
	<div class="card-header bg-dark text-white">
		<b> BON DE COMMANDE</b>
	</div>
	<div class="card-body">
		<div class="form">
			<form method="post" action="<?= base_url('Commerciale/sauveCommande') ?>">
				<fieldset class="col-md-12 border">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="date">Date : </label>
							<input type="text" name="BC_DATE" class="form-control form-control-sm BC_DATE" value=<?= date('d-m-Y') ?>>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_PE">TYPE PO : </label>
							<select class="form-control form-control-sm BC_TYPEPO" name="BC_TYPEPO">
								<option>EPZ</option>
								<option>CMTI I</option>
								<option>CMTI MADA</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_PE" class="titlePO">PE N° : </label>
							<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="<?= $BC_PE ?>">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
							<select class="form-control form-control-sm BC_TYPEPRODUIT" name="BC_TYPEPRODUIT">
								<option>CINTRES</option>
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
							<label for="BC_DATELIVRE">DATE DE LIVRAISON : </label>
							<input type="date" name="BC_DATELIVRE" class="form-control form-control-sm BC_DATELIVRE">
						</div>
						<div class="form-group col-md-3">
							<label for="BC_LIEU">LIEU DE LIVRAISON : </label>
							<input type="text" name="BC_LIEU" class="form-control form-control-sm BC_LIEU">
						</div>
						<div class="form-group col-md-3">
							<label>Type de produit</label>
							<select class="form-control typeDeproduit form-control-sm BC_TYPE_PRODUIT" name="BC_TYPE_PRODUIT">
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
							<select class="form-control BC_TYPE form-control-sm" name="BC_TYPE">
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
							<select class="form-control BC_TYPEMATIER form-control-sm" name="BC_TYPEMATIER">
								<?php foreach ($type_de_matier as $key => $type_de_matier) : ?>
									<option><?= $type_de_matier->TM_DESIGNATION ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_QUNTITE">Quantité commander: </label>
							<input type="numeric" name="BC_QUNTITE" class="form-control form-control-sm BC_QUNTITE">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_QUNTITE">Quantité à produire: </label>
							<input type="numeric" name="BC_QUNTITEPRO" class="form-control form-control-sm BC_QUNTITEPRO">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_CON_PRIX">Prix consentie par le client USD: </label>

							<input type="text" name="BC_PRIX" class="form-control form-control-sm BC_PRIX">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_CON_PRIX">Prix consentie par le client en euro: </label>

							<input type="text" name="BC_PRIX" disabled class="form-control form-control-sm BC_PRIXEURO">
						</div>
						<div class="form-group col-md-4">
							<label for="BC_PRIX">Prix calculer : </label>
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
		<!-- <a href="<?= base_url('Commerciale/printFacture') ?>" class="btn btn-info print"><i class="fa fa-print"></i> Imprimer</a>-->
		<button type="submit" class="btn btn-success saveCommande">Enregistre</button>
		<button type="reset" class="btn btn-danger">Annuler</button>
	</div>
</div>
</div>
<script>
	$(document).ready(function() {

		
		$('.addPro').on('click', function(event) {
			event.preventDefault();
			var UNITE = $('.UNITE').val();
			var QTE = $('.QTE').val();
			var Designation = $('.Designation').val();
			var CU = $('.CU').val();
			$('.tbody-pro').append('<tr><td>' + Designation + '</td><td>' + QTE + '</td><td>' + UNITE + '</td><td>' + CU + '</td><td>' + QTE * CU + '</td><tr>');
			$('.UNITE').val("");
			$('.QTE').val("");
			$('.Designation').val("");
			$('.CU').val("");

		});
		$('.validers').on('click', function(event) {
			event.preventDefault();
			var somme = 0;
			$('.tbody-pro > tr').each(function(index, el) {
				var data = "";
				data = $(this).children().eq(4).text();
				somme = parseFloat(somme) + parseFloat(data);
			});

		});

$('.BC_DATE').datepicker();
		$('.saveCommande').on('click', function(e) {
			e.preventDefault();
			var BC_PE = $('.BC_PE').val();
			var BC_CLIENT = $('.BC_CLIENT').val();
			var BC_CODE = $('.BC_CODE').val();
			var BC_DATELIVRE = $('.BC_DATELIVRE').val();
			var BC_REASSORT = $('.BC_REASSORT').val();
			var BC_ECHANTILLON = $('.BC_ECHANTILLON').val();
			var BC_DIMENSION = $('.BC_DIMENSION').val();
			var BC_RABAT = $('.BC_RABAT').val();
			var BC_SOUFFLET = $('.BC_SOUFFLET').val();
			var BC_PERFORATION = $('.BC_PERFORATION').val();
			var BC_TYPE = $('.BC_TYPE option:selected').val();
			var BC_TYPEPO = $('.BC_TYPEPO option:selected').val();
			var BC_IMPRESSION = $('.BC_IMPRESSION').val();
			var BC_CYLINDRE = $('.BC_CYLINDRE').val();
			var BC_QUNTITE = $('.BC_QUNTITE').val();
			var BC_PRIX = $('.BC_PRIX').val();
			var BC_TYPEPRODUIT = $('.BC_TYPEPRODUIT option:selected').val();
			var BC_TYPEMATIER = $('.BC_TYPEMATIER option:selected').val();
			var BC_TYPE_PRODUIT = $('.BC_TYPE_PRODUIT option:selected').text();
			var BC_OBSERVATION =CKEDITOR.instances.BC_OBSERVATION.getData();
			var BC_LIEU = $('.BC_LIEU').val();
			var BC_CON_PRIX = $('.BC_CON_PRIX').val();
			var QttMetre = $('.QttMetre').val();
			var poidSachet = $('.poidSachet').val();
			var poidMarge = $('.poidMarge').val();
			var rollDim = $('.rollDim').val();
            var BC_QUNTITEPRO = $(".BC_QUNTITEPRO").val();
			var prixSansMarge = $('.prix').val().trim();
			var width = $('.width').val().trim();
			var length = $('.length').val().trim();
			var thickness = $('.thickness').val().trim();
			var Flap = $('.Flap').val().trim();
			var Gusset = $('.Gusset').val().trim();
			var Order = $('.Order').val().trim();
			var marge = $("#marge_pourcent").val().trim();
			var Printing_area = $('.Printing_area').val();
			var Prix_matier = $('.Prix_matier').val();
			var marges = $('.margex').val();
			var VitesseMachine = $('.VitesseMachine').val();
			var prixdefaultEuro = $('.prixdefaultEURO').val();
			var marge_reel = $('#marge_reel').val();








			var NROULEAUX = $('.NROULEAUX').val();
			var BC_PRIXEURO = $('.BC_PRIXEURO').val();

			var data = new Array();
			data[1] = BC_CYLINDRE;
			data[2] = BC_QUNTITE;
			data[3] = BC_PRIX;
			data[4] = BC_OBSERVATION;
			data[5] = BC_SOUFFLET;
			data[6] = BC_PERFORATION;
			data[7] = BC_TYPE;
			data[8] = BC_IMPRESSION;
			data[9] = BC_REASSORT;
			data[10] = BC_ECHANTILLON;
			data[11] = BC_DIMENSION;
			data[12] = BC_RABAT;
			data[13] = BC_PE;
			data[14] = BC_CLIENT;
			data[15] = BC_CODE;
			data[16] = BC_DATELIVRE;
			data[17] = BC_TYPEPRODUIT;
			data[18] = BC_TYPEMATIER;
			data[19] = BC_TYPE_PRODUIT;
			data[20] = BC_LIEU;
			data[21] = BC_TYPEPO;
			data[22] = BC_CON_PRIX;
			data[23] = QttMetre;
			data[24] = poidSachet;
			data[25] = poidMarge;
			data[26] = rollDim;
			data[27] = NROULEAUX;
			data[28] = BC_PRIXEURO;



			data[29] = width;
			data[30] = length;
			data[31] = thickness;
			data[32] = Flap;
			data[33] = Gusset;
			data[34] = Order;
			data[35] = marge;
			data[36] = Printing_area;
			data[37] = Prix_matier;
			data[38] = marges;
			data[39] = VitesseMachine;
		    data[40] = prixSansMarge;
			data[41] = prixdefaultEuro;
			data[42] = marge_reel;
			data[43] = BC_QUNTITEPRO;



			var content = JSON.stringify(data);
			if ( BC_DATELIVRE == "" || BC_TYPE == "" || BC_QUNTITE == "" || BC_TYPEPRODUIT == "" || BC_TYPEMATIER == "" || BC_PRIX == "") {
				alertMessage("Erreur!", "Tous les champs sont obligatoire.", "error", "btn btn-danger");
			} else {
				chargement();
				$.post(base_url + "Commerciale/saveCommande", {
					content: content
				}, function(datas) {
					$('.BC_PE').val(datas.bc);
					$('.jconfirm').remove();

					swal({
						title: 'Bon de commande enregistré!',
						text: "Voulez-vous imprimer?",
						type: 'warning',
						buttons: {
							confirm: {
								text: 'OUI',
								className: 'btn btn-success'
							},
							cancel: {
								text:'NON',
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Delete) => {
						if (Delete) {
							/*$.post(base_url+'Commerciale/printFacture',{PO:BC_PE},function(){
								alertMessage("Succè!","Bon de commande enregistré.","success","btn btn-success");
							});*/
							location.replace(base_url + 'Commerciale/printFacture?po=' + BC_PE);
						} else {
							alertMessage("Succè!", "Bon de commande enregistré.", "success", "btn btn-success");
						}
					});
					
                   $('input').val("");
				   CKEDITOR.instances.BC_OBSERVATION.setData(data);
				}, 'json');
			}
		});
			

	    $('.prixdefaultEuro').on('change',function(e){
	    	e.preventDefault();
	    	var taux = $('.taux_usd_euro').val();
	    	var value = $(this).val();
	    	$('.prixdefault').val(value/taux);

	    });
		$('.BC_TYPEMATIER').on('change', function(e) {
			e.preventDefault();
			var type = $('.BC_TYPEMATIER option:selected').val();
			var typePO = $('.BC_TYPEPO option:selected').val();

			$.post(base_url + 'Commerciale/numBon', {
				type: type,
				typePO: typePO
			}, function(data) {
				if (typePO === "CMTI I") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + data + "C");
				} else if (typePO === "CMTI MADA" && type == "PE") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + data + "CM");
				} else if (typePO === "CMTI MADA" && type == "PP") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + data + "PP");
				} else if (type == "HDPE") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val('PE' + data);
				} else {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + data);
				}
			});
		});
		$('.BC_PRIX').on('click', function(e) {
			e.preventDefault();
			$(this).val("");
			$('.width').val("");
			$('.length').val("");
			$('.thickness').val("");
			$('.Flap').val("");
			$('.Gusset').val("");
			$('.Order').val("");
			$('.result').val("");
			$('.total').val("");
			$('.marge').val("");
			$(".marges").val("");
			$('.prix').val("");
			$('.prixdefault').val("");
			$('.PrixCalc').modal("show");
			$('.Prix_matier').val("");
			$('.margex').val("");
			$('.Printing_area ').val("");
			$('.VitesseMachine').val("");
			$('.BC_PRIX').val("");
			$('.BC_CON_PRIX').val("");
			$('.total').val("");
			$('.marge').val("");
			$('.prix').val("");
			$('.poidSachet').val("");
			$('.QttMetre').val("");
			$('.rollDim').val("");
			$('.NROULEAUX').val("");
			$('.poidMarge').val("");



		});
		$('.afficherR').on('click', function(event) {
			event.preventDefault();
			var width = $('.width').val().trim();
			var length = $('.length').val().trim();
			var thickness = $('.thickness').val().trim();
			var Flap = $('.Flap').val().trim();
			var Gusset = $('.Gusset').val().trim();
			var Order = $('.Order').val().trim();
			//var marge = $(".marges").val().trim();
			var Printing_area = $('.Printing_area').val();
			var Prix_matier = $('.Prix_matier').val();
			var marges = $('.margex').val();
			var VitesseMachine = $('.VitesseMachine').val();
			var parametre = $('.BC_TYPE_PRODUIT option:selected').val().trim();
			$.post(base_url + "Commerciale/calculePrixCommande", {
				VitesseMachine: VitesseMachine,
				Prix_matier: Prix_matier,
				Printing_area: Printing_area,
				marges: marges,
				width: width,
				length: length,
				thickness: thickness,
				Flap: Flap,
				Gusset: Gusset,
				Order: Order,
				parametre: parametre,
				//marge: marge
			}, function(data) {

				//$('.marge').val(data.marge);
				$('.prix').val(data.prix);

				$('.poidSachet').val(data.wt);
				$('.QttMetre').val(data.totalYeild);
				$('.rollDim').val(data.rollDim);
				//$('.NROULEAUX').val(data.totalYeild);
				$('.poidMarge').val(data.totalMat);


				// calcul total avec marge 

				let marge_pourcent = $('#marge_pourcent').val();
				let total_avec_marge = parseFloat(data.prix) + parseFloat(data.prix) * (parseFloat(marge_pourcent)/100) ;

				$('.total').val( total_avec_marge );

				// 
					

			}, 'json').fail(function() {
				alertMessage("Erreur", "Une erreur ses produit veuillez verifier votre saisie", "error", "btn btn-danger");
			});
		});


		$("#calcul_marge_reel").click(function(){
			
			let prix_de_vente = parseFloat( $("#prix_de_vente").val() );
			let prix_pri = parseFloat( $("#prix_pri").val() );
			let taux = parseFloat( $("#taux_usd_euro").val() );
			
			let marge_reel = ( prix_de_vente - prix_pri ) / prix_pri * 100 ;

			$("#marge_reel").val(marge_reel);

			$("#prixdefaultEURO").val( prix_de_vente * taux  );




		});	





		$('.valider').on('click', function(event) {
			event.preventDefault();

			var prix = $('.prixdefault').val();
			var total = $('.total').val();
			var prixdefaultEURO = $('.prixdefaultEURO').val();
			$('.BC_PRIX').val(prix);
			$('.BC_CON_PRIX').val(total);
			$('.BC_PRIXEURO').val(prixdefaultEURO);
			$('.PrixCalc').modal('hide');
		});

		function alertMessage(title, message, icons, btn) {
			swal(title, message, {
				icon: icons,
				buttons: {
					confirm: {
						className: btn
					}
				},
			});

		}

		function chargement() {
			var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
			$.dialog({
				"title": "",
				"content": htmls,
				"show": true,
				"modal": true,
				"close": false,
				"closeOnMaskClick": false,
				"closeOnEscape": false,
				"dynamic": false,
				"height": 150,
				"fixedDimensions": true
			});


		}

		function closeDialog() {
			$('.jconfirm').remove();
		}
	});
</script>
