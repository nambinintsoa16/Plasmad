<div class="card w-100">
   <div class="card-header bg-dark text-white">
      <b>SUIVIE PO</b>
   </div>
<div class="card-body">
<div class="container">
	<div class="row">
		<div class="form-group">
			<label>Date début</label>
			<input type="date" name="" class="form-control-sm form-control debut">
		</div>	
		<div class="form-group">
			<label>Date Fin</label>
			<input type="date" name="" class="form-control-sm form-control fin">
		</div>	
		<div class="form-group pt-3">
			<button class="btn btn-success btn-sm mt-4 afficher">Valider</button>
		</div>	
		<div class="form-group pt-3">
			<a class="btn btn-primary btn-sm mt-4 exporterSuivie" href="<?=base_url('controlleur/exportSuiviPo/?debut=&fin=')?>"><i class="fa fa-download"></i>&nbsp; Exporter</a>
		</div>	


	</div>	

	</div>
	</div>
			<table class=" table-hover table-bordered table-striped w-100 table-sm table-suivie">
				<thead class="bg-dark text-white border">
					<tr><th>N°PO</th>
						<th>TYPE</th>
						<th colspan="3">EXTRUSION</th>
						<th colspan="3">IMPRESSION</th>
						<th colspan="3">COUPE</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th>SORTIE MAGASIN</th>
						<th>UTILISER</th>
						<th>NON UTILISER</th>

						<th>SORTIE EXTRUSION</th>
						<th>IMPRIMER</th>
						<th>NON IMPRIMER</th>

						<th>SORTIE IMPRESSION</th>
						<th>COUPER</th>
						<th>NON COUPER</th>

					</tr>
				</thead>
				<tbody>
				
				</tbody>
			</table>
	
</div>
<script type="text/javascript">
	
	$(()=>{
     
       $('.afficher').on('click',function(e){
	       	e.preventDefault()
	       	let debut = $('.debut').val()
			let fin = $('.fin').val()
            let link = base_url + 'controlleur/dataSuivie?debut='+debut+'&fin='+fin
			let links = base_url + 'controlleur/exportSuiviPo/?debut='+debut+'&fin='+fin
			$('.exporterSuivie').attr('href',links)
            TableSuivie.ajax.url(link)
			TableSuivie.ajax.reload()
       })
	
       TableSuivie = $('.table-suivie').DataTable({
       	 processing: true,
       	 ajax : base_url + 'controlleur/dataSuivie',
       	 language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
       })

	})
</script>