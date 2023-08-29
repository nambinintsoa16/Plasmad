<style>
.dataTables_wrapper {
    padding: 2px !important;
}
* {
   scrollbar-width: thin;
   scrollbar-color: #346abf white;
}
  ::-webkit-scrollbar {
    width: 3px;
}

::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
</style>

<div class="card">
	<div class="card-header bg-white">
		<b>STOCK DES DECHETS</b>
		<b class="w-100 border-dark text-right col-md-8 pull-right">
			<input type="date" class="m-0 " id="debut">
			<input type="date" class="m-0 ml-2" id="fin">
			<a href="#" class=" text-white ml-2 btn btn-success btn-sm" id="show_selection"><i class="fa fa-tv"></i>&nbsp; AFFICHER</a>
		</b>
	</div>
		<div class="row m-auto">
			<div class="col-sm-6 col-md-4">
				<div class="card card-stats card-round mt-2">
					<div class="card-body ">
						<div class="row align-items-center">
							<div class="col-icon">
								<div class="icon-big text-center icon-success bubble-shadow-small">
									<i class="flaticon-database"></i>
								</div>
							</div>
							<div class="col col-stats ml-5 ml-sm-0">
								<div class="numbers">
									<p class="card-category">Quantite en stock</p>
									<h4 class="card-title"><?=$data->stock?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-12 p-0 border bg-white pt-2">
				<table class="table-bordered table-hover table-strepted w-100" id="dataTable">
					<thead class="bg-<?=$nav_color?> text-white">
						<tr>
							<th>DATE</th>
							<th>N°PO</th>
							<th>OPERATEUR</th>
							<th>MACHINES</th>
							<th>TYPE_DE_MATIERE</th>
							<th>TYPE_DE_DECHETS</th>
							<th>POIDS</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
</div>
