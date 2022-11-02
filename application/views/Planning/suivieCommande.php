<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Planning</a></li>
		<li class="breadcrumb-item active" aria-current="page">Suivie commandes</li>
	</ol>
</nav>
<div class="card">
	<div class="card-header bg-dark text-white">
		<b>SUIVIE COMMANDES</b>
	</div>
	<div class="card-body">
		<fieldset class="border p-2">
			<div class="row">

    <div class="col-md-3">
        <input type="text" class="form-control form-control-sm auto" placeholder="N°PO">
    </div>
    <div class="col-md-3">
        <input type="date" class="form-control form-control-sm date" placeholder="DATE">
    </div>
    <div class="col-md-3">
        <a href="#" class="btn btn-info btn-sm afficeProd"> <i class="fa fa-tv"></i> AFFICHER</a>
    </div>
	<div class="col-md-3">
        <a href="#" class="btn btn-success btn-sm exporter"> <i class="fa fa-download"></i> EXPORTER</a>
    </div>
</div>
<div class="main-containte mt-3">
	<div class="table-responsive">
	<table class="table table-bordered table-hovre tableSuivie table-striped table-respensive">
		<thead class="bg-dark text-white table-sm">
			<tr>
				<th>DATE</th>
				<th>PO</th>
				<th>CLIENT</th>
				<th>DIMENSION</th>
				<th>IMPRESSION</th>
				<th>METRAGE</th>
				<th>POIDS</th>
				<th>QUANT</th>
				<th>TYPE</th>
				<th>NOMBRE RLX</th>
				<th>STATUT</th>
				<th>OBSERVATION</th>
			</tr>
		</thead>
	</table>
	 </div>
</div>
</fieldset>
<script type="text/javascript">
	$(document).ready(function(){
        let link = base_url +'Planning/dataSuivie?po=&date=';
		Table = $(".tableSuivie").DataTable({
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

       $('.afficeProd').on('click',function(e){
       	   e.preventDefault();
              let po= $('.auto').val();
              let date =$('.date').val();
            let links = base_url +'Planning/dataSuivie?po='+po+'&date='+date
			let linkExport = base_url +'Planning/dataExportSuivie?po='+po+'&date='+date
			$('.exporter').attr('href',linkExport)
            Table.ajax.url(links);
			Table.ajax.reload();
       });

        $('.auto').autocomplete({
            source: base_url + "Magasiner/autocompletPo",
        });

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