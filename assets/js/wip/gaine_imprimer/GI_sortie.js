$(document).ready(function () {
	$("#refnum").autocomplete({
		source: base_url + "wip/autocomplet_stock_wipe_gane_imprimer",
		select: function (data, iteme) {
			let refnum_pe = iteme.item.value.trim();
			$.post(
				base_url + "wip/detail_wipe_gaines_imprimer_stock",
				{ refnum_pe },
				function (data) {
					if (data.mesage == "false") {
						alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
					} else {
						$("#client").val(data.client);
						$("#dim").val(data.dim);
						$("#Codeclient").val(data.BC_CODE);
						$('#qtt_dispot').val(data.stock);
					}
				},
				"json"
			);
		},
	});
	$('#operateur').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
    });
    $('#machine').autocomplete({
        source: base_url + "Production/autocomplete_machine",
    });
    $("#taille").autocomplete({
        source: base_url + "gaines/autocomplet_taille_gaines",
    });
	$("form").on("submit", function (event) {
		event.preventDefault();
        let date = $("#date").val();
        let refnum = $("#refnum").val();
        let client = $("#client").val();
        let dim = $("#dim").val();
        let quantite = $("#quantite").val();
        let BL = $("#BL").val();
		let operateur = $("#operateur").val();
		let machine = $("#machine").val();
		let qtt_dispot = $("#qtt_dispot").val();
        let obs = $("#obs").val();

        if(date==""){
            alertMessage("Erreur!", "Date non valide.", "error", "btn btn-danger");
        }else if(refnum==""){
            alertMessage("Erreur!", "Refnum commande non valide.", "error", "btn btn-danger");
        }else if(quantite ==""){
            alertMessage("Erreur!", "Quantité invalide.", "error", "btn btn-danger");
		}else if(parseFloat(quantite) > parseFloat(qtt_dispot)){	
			alertMessage("Erreur!", "Stock non diponible.", "error", "btn btn-danger");
        }else{
		$.post(
			base_url + "wip/wip_gaine_imprimer_save_sortie",
			{ date, refnum, client, dim, quantite, obs,BL,machine,operateur },
			function (data) {}
		)
			.fail(() => {
				alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
			})
			.done(() => {
				$("input").val("");
				$("textarea").val("");
				alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
			});
        }
	});

	function alertMessage(title, message, icons, btn) {
		swal(title, message, {
			icon: icons,
			buttons: {
				confirm: {
					className: btn,
				},
			},
		});
	}
});
