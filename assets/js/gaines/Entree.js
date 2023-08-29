$(document).ready(function () {
	$("#refnum").autocomplete({
		source: base_url + "Commercial/autocomplet_commande",
		select: function (data, iteme) {
			let refnum_pe = iteme.item.value.trim();
			$.post(
				base_url + "Commercial/detail_commande",
				{ refnum_pe },
				function (data) {
					if (data.mesage == "false") {
						alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
					} else {
						$("#client").val(data.BC_CLIENT);
						$("#dim").val(data.BC_DIMENSION);
						$("#Codeclient").val(data.BC_CODE);
					}
				},
				"json"
			);
		},
	});
    $("#taille").autocomplete({
        source: base_url + "gaines/autocomplet_taille_gaines",
    });
	$("form").on("submit", function (event) {
		event.preventDefault();
		let date = $("#date").val();
		let refnum = $("#refnum").val();
		let client = $("#client").val();
		let Codeclient = $("#Codeclient").val();
		let dim = $("#dim").val();
		let taille = $("#taille").val();
		let entre = $("#entre").val();
		let obs = $("#obs").val();
        if(date==""){
            alertMessage("Erreur!", "Date non valide.", "error", "btn btn-danger");
        }else if(refnum==""){
            alertMessage("Erreur!", "Refnum commande non valide.", "error", "btn btn-danger");
        }else if(entre ==""){
            alertMessage("Erreur!", "Quantité invalide.", "error", "btn btn-danger");
        }else{
		$.post(
			base_url + "gaines/save_entree",
			{ date, refnum, client, Codeclient, dim, taille, entre, obs },
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
