<div class="card bg-default">
	<div class="card-header bg-dark text-white">
		<b>SUIVI DES COMMANDES</b>
		<b class="pull-right">
			<input type="text" class="mr-3 po" name="po" placeholder="Entre N°PO">
			<input type="date" class="mr-3 choixdate" name="date">
			<button type="submit" class="btn btn-success btn-sm changeDate">AFFICHER</button>
			<a href="<?=base_url("Magasiner/exportentrelivrasoin")?>" class="btn btn-sm btn-primary"><i
					class="fa fa-download"></i></a>

		</b>
	</div>
	<div class="card-body">
		<fieldset class="border w-100 p-2">
			<div class="row">
				<div class="card">
					<div class="card-body">
						<fieldset class="border">
							<div class="row">
								<div class="form-group col-md-12 form-inline">
									<label class="col-md-2 col-form-label">Mois : </label>
									<div class="col-md-4 p-0">
										<select name="anneé" id="moisliste" class="form-control form-control-sm">
											<?php $p = 1;
							foreach (listemois() as $key => $listemois) : ?>
											<option value="<?= $p ?>"><?= $listemois ?></option>
											<?php $p++;
							endforeach; ?>
										</select>
									</div>
									<label class="col-md-2 col-form-label m-0">Année : </label>
									<div class="col-md-4 p-0">
										<select name="anneé" id="anneliste" class="form-control form-control-sm">
											<?php foreach ($annee as $key => $annee) : ?>
											<option><?= $annee ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<hr />
								</div>
						</fieldset>
						<fieldset class="border mt-3 p-3">
							<div class="row">
								<div class="col-md-12">
									<a href="#"
										class="btn btn-sm btn-primary col-md-3 pull-right recherche">Afficher</a>
								</div>
							</div>
						</fieldset>
						<div class="row">
							<div class="form-group col-md-12">
								<div class="selectgroup w-100">
									<label class="selectgroup-item">
										<input type="radio" name="value" value="50" id="TOUT" class="selectgroup-input"
											checked="">
										<span class="selectgroup-button">TOUT AFFICHER</span>
									</label>
									<label class="selectgroup-item">
										<input type="radio" name="value" value="100" id="SACHETS"
											class="selectgroup-input">
										<span class="selectgroup-button">SACHETS</span>
									</label>
									<label class="selectgroup-item">
										<input type="radio" name="value" value="100" id="CINTRES"
											class="selectgroup-input">
										<span class="selectgroup-button">CINTRES</span>
									</label>
								</div>
							</div>
							<fieldset class="border p-2 w-100">
								<div class=" col-md-12 table-respensive p-0">
									<table
										class="w-100 table dataTableLite table-hover table-bordered table-hover table-bordered-bd-dark">
										<thead class="bg-info text-white">
											<tr>
												<th>PO N°</th>
												<th>Date de commande</th>
												<th>Client,Référence</th>
												<th>Code Client</th>
												<th>Dimension</th>
												<th>Observation</th>
												<th>Produit</th>
												<th>Statut</th>
												<th style="width: 150px!important;"></th>
											</tr>

										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</fieldset>
						</div>
					</div>
				</div>

		</fieldset>
	</div>
</div>
</div>
<script>
	$(document).ready(function() {
        var link = base_url + 'Suivi_Commerciale/listeDesCommande';
        Table = $(".dataTableLite").DataTable({
            processing: true,
            ajax: link,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "rowCallback": function(row, data) {
               
            },
            initComplete: function(setting) {
               
            },
            "drawCallback": function(settings) {
              
            }
        });

        $('.recherche').on('click', function(event) {
            event.preventDefault();
            var anneliste = $('#anneliste option:selected').text();
            var moisliste = $('#moisliste option:selected').val();
            var type = $('.checked').attr('id');
            var links = base_url + "Suivi_Commerciale/suivieType/" + type + "/" + anneliste + "/" + moisliste;
            Table.ajax.url(links);
            Table.ajax.reload();

        });
        $('.selectgroup-input').on('click', function() {
            $('.selectgroup-input').removeClass('checked');
            $(this).addClass('checked');
            if ($(this).attr('id') == "TOUT") {
                var links = base_url + "Suivi_Commerciale/listeDesCommande/";
                Table.ajax.url(links);
                Table.ajax.reload();
            } else {
                var links = base_url + "Suivi_Commerciale/suivieType/" + $(this).attr('id');
                Table.ajax.url(links);
                Table.ajax.reload();
            }
        });


	});
</script>
