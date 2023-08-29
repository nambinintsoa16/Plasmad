$(document).ready(function () {
	CKEDITOR.replace('BC_OBSERVATION');
	$('.BC_DATE').datepicker();
	$('.BC_PRIX').on('click', function (e) {
		e.preventDefault();
		$(this).val("");
		$('.width').val("");
		$('.length').val("");
		$('.thickness').val("");
		$('.Flap').val("");
		$('.Gusset').val("");
		$('.Order').val("");
		$('.total').val("");
		$('.marge').val("");
		$(".marges").val("");
		$('.prix').val("");
		$('.prixdefault').val("");
		$('.PrixCalc').modal('show');

	});

	$('.saveCommande').on('click', function (e) {
		e.preventDefault();
		var BC_PO = $('.BC_PE').val();
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
		var BC_OBSERVATION = CKEDITOR.instances.BC_OBSERVATION.getData();
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
		data[13] = BC_PO;
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
		if (BC_DATELIVRE == "" || BC_TYPE == "" || BC_QUNTITE == "" || BC_TYPEPRODUIT == "" || BC_TYPEMATIER == "" || BC_PRIX == "") {
			alertMessage("Erreur!", "Tous les champs sont obligatoire.", "error", "btn btn-danger");
		} else {
			chargement();
			$.post(base_url + "Commercial/sauve_commande_sachet", {
				content: content
			}, function (datas) {
				$('input').val("");
				let type = $('.BC_TYPEMATIER option:selected').val();
				let typePO = $('.BC_TYPEPO option:selected').val();
				if (typePO === "CMTI I") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + datas.refnum_commande + "C");
				} else if (typePO === "CMTI MADA" && type == "PE") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + datas.refnum_commande + "CM");
				} else if (typePO === "CMTI MADA" && type == "PP") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + datas.refnum_commande + "PP");
				} else if (type == "HDPE") {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + datas.refnum_commande);
				} else {
					$('.titlePO').text(type + " N°");
					$('.BC_PE').val(type + datas.refnum_commande);
				}
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
							text: 'NON',
							visible: true,
							className: 'btn btn-danger'
						}
					}
				}).then((Delete) => {
					if (Delete) {
						location.replace(base_url + 'Commercial/printFacture?po=' + BC_PO);
					} else {
						alertMessage("Succè!", "Bon de commande enregistré.", "success", "btn btn-success");
					}
				});


				CKEDITOR.instances.BC_OBSERVATION.setData(data);
			}, 'json');
		}
	});


	$('.prixdefaultEuro').on('change', function (e) {
		e.preventDefault();
		var taux = $('.taux_usd_euro').val();
		var value = $(this).val();
		$('.prixdefault').val(value / taux);

	});
	$('.BC_TYPEMATIER , .BC_TYPEPO,.BC_TYPE_MATIERE_USE').on('change', function (e) {
		e.preventDefault();
		let type = $('.BC_TYPEMATIER option:selected').val();
		let type_po = $('.BC_TYPEPO option:selected').val();
		let type_mat_use = $('.BC_TYPE_MATIERE_USE option:selected').val();
		let use = "";
		type_mat_use != "NORMAL" ? use = "-RC" : "";
		$.post(base_url + 'Commercial/refnum_bon', {
			type,
			type_po
		}, function (data) {
			if (type_po === "CMTI I") {
				$('.titlePO').text(type + " N°");
				$('.BC_PE').val(type + data + "C" + use);
			} else if (type_po === "CMTI MADA" && type == "PE") {
				$('.titlePO').text(type + " N°");
				$('.BC_PE').val(type + data + "CM" + use);
			} else if (type_po === "CMTI MADA" && type == "PP") {
				$('.titlePO').text(type + " N°");
				$('.BC_PE').val(type + data + "PP" + use);
			} else if (type == "HDPE") {
				$('.titlePO').text(type + " N°");
				$('.BC_PE').val(type + data + use);
			} else {
				$('.titlePO').text(type + " N°");
				$('.BC_PE').val(type + data + use);
			}
		});
	});

	$('.afficherR').on('click', function (event) {
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
		$.post(base_url + "Commercial/calculePrixCommande", {
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
		}, function (data) {

			//$('.marge').val(data.marge);
			$('.prix').val(data.prix);

			$('.poidSachet').val(data.wt);
			$('.QttMetre').val(data.totalYeild);
			$('.rollDim').val(data.rollDim);
			//$('.NROULEAUX').val(data.totalYeild);
			$('.poidMarge').val(data.totalMat);


			// calcul total avec marge 

			let marge_pourcent = $('#marge_pourcent').val();
			let total_avec_marge = parseFloat(data.prix) + parseFloat(data.prix) * (parseFloat(marge_pourcent) / 100);

			$('.total').val(total_avec_marge);

			// 


		}, 'json').fail(function () {
			alertMessage("Erreur", "Une erreur ses produit veuillez verifier votre saisie", "error", "btn btn-danger");
		});
	});


	$("#calcul_marge_reel").click(function (event) {
		event.preventDefault();
		let prix_de_vente = parseFloat($("#prix_de_vente").val());
		let prix_pri = parseFloat($("#prix_pri").val());
		let taux = parseFloat($("#taux_usd_euro").val());
		let marge_reel = (prix_de_vente - prix_pri) / prix_pri * 100;
		$("#marge_reel").val(marge_reel);
		$("#prixdefaultEURO").val(prix_de_vente * taux);

	});

	$('.valider').on('click', function (event) {
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
