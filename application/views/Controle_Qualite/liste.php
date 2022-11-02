<div class="card">
	<div class="card-header bg-dark text-white">
		<b>DETAIL QC</b>
	</div>
	<div class="card-body">
	<!--	<fieldset class="border p-4">
			<legend class="w-auto">Filtre</legend>
			<div class="row">
				<div class="form-group col-md-3">
					<input type="date" class="form-control form-control-sm date">
				</div>
				<div class="form-group col-md-3">
					<input type="text" class="form-control form-control-sm po" placeholder="N°PO">
				</div>
				<div class="form-group col-md-3">
					<input type="text" class="form-control form-control-sm qc" placeholder="Nom QC">
				</div>

				<div class="form-group col-md-3">
					<button class="btn btn-sm btn-success updateQC">&nbsp;<i class="fa fa-tv"></i>Afficher</button>
				</div>
			</div>
		</fieldset>-->
		<fieldset class="border p-4">
			<legend class="w-auto">Liste</legend>
			<table class=" table-strepted table-hover table-bordered table-sm w-100 tableQC">
				<thead class="bg-dark text-white">
					<tr>
						<th>DATE</th>
						<th>NOM QC</th>
						<th>PO</th>
						<th>POIDS</th>
						<th>QTT ENTREE</th>
						<th>QTy Stie</th>
						<th>2eme choix</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="dataPoResult">
				</tbody>
			</table>
		</fieldset>
	</div>
</div>

<script>
	$(document).ready(function() {
		var tables = $('.tableQC').dataTable({
			processing: true,
			ajax: base_url + "Controle_Qualite/liseteControl",
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
			"rowCallback": function(row, data) {deleteQc();},
			initComplete: function(setting) {deleteQc();},
			"drawCallback": function(settings) {deleteQc();}
		});
		$('.updateQC').on('click', function(e) {
			e.preventDefault();
			var date = $('.date').val();
			var po = $('.po').val();
			var qc = $('.qc').val();
			var links = base_url + "Controle_Qualite/liseteControl?C_DATE=" + date + "&C_PO=" + po + "&QC=" + qc;
            tables.ajax.url(links);
            tables.ajax.reload();
			
		});

		function deleteQc() {
                $(".delete").on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this).parent().parent();
                    chargement();
                    var parametre = $(this).attr('href');
                    $.post(base_url + "Production/deleteQC", {
                        parametre: parametre
                    }, function(data) {
                        alertMessage("Suppression QC", "QC supprimer avec succè", "success", "btn btn-success");
                        $this.remove();
                        closeDialog();
                    });

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

	});
</script>
