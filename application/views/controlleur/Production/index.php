	<nav class="nav nav-tabs mt-2">
	<a class="nav-item nav-link active" href="#accueil" data-toggle="tab" >PLANNING DU JOUR</a>
	<!--<a class="nav-item nav-link" href="#extrusion" data-toggle="tab">EXTRUSION</a>-->
	<!--<a class="nav-item nav-link" href="#injection" data-toggle="tab">INJECTION</a>-->
	<!--<a class="nav-item nav-link" href="#decoupe" data-toggle="tab">DECOUPE</a>-->
	<!--<a class="nav-item nav-link" href="#Inpression" data-toggle="tab">INPRESSION</a>-->
	<a class="nav-item nav-link " href="#Operateur" data-toggle="tab">PROCESSUS EN COURS</a>
	<a class="nav-item nav-link creetfiches" href="#fiche" data-toggle="tab">CREE FICHE</a>
	<a class="nav-item nav-link" href="#Terminer" data-toggle="tab">TERMINER</a>
	<a class="nav-item nav-link" href="#verification" data-toggle="tab">VERIFICATION MATIER</a>
	</nav>

	<div class="tab-content p-0 w-100 m-0">
	<div class="tab-pane active pt-2 table-responsive" id="accueil">
		<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted TableProduction" >
			<thead class="bg-dark text-white">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th class="collapse">N° Job cart</th>
					<th>TYPE</th>
					<th>MACHINE</th>
					<th>PROCCESSUS</th>
					<th>TYPE DE BAG</th>
					<th>MATIER</th>
					<th>DIMENSION</th>
					<th>PERFORATION</th>
					<th>QUANTITE</th>
					<th>REASSORT</th>
					<th>RABAT</th>
					<th>PERFORATION</th>
					<th>CYLINDRE</th>
					<th>OBSERVATION</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
	</div>
	<div class="tab-pane pt-2 table-responsive" id="Terminer"> 

		<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted" >
			<thead class="bg-dark text-white">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th class="collapse">N° Job cart</th>
					<th>TYPE</th>
					<th>MACHINE</th>
					<th>PROCCESSUS</th>
					<th>TYPE DE BAG</th>
					<th>MATIER</th>
					<th>DIMENSION</th>
					<th>PERFORATION</th>
					<th>QUANTITE</th>
					<th>REASSORT</th>
					<th>RABAT</th>
					<th>PERFORATION</th>
					<th>CYLINDRE</th>
					<th>OBSERVATION</th>
					<th>Plus de détail</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
	</div>
	<div class="tab-pane pt-2 table-responsive" id="verification"> 
        <div class="container">
		<div class="row">	
	<fieldset class="col-md-12 border">
		<div class="row">
				
					<div class="form-group col-md-4">
						<label for="BC_PE">PO N° : </label>
						<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
					</div>
					<div class="form-group col-md-4">
						<label for="JO_ID">JOB CARD N° : </label>
						<input type="text" name="JO_ID"  disabled class="form-control form-control-sm JO_ID">
					</div>
					<div class="form-group col-md-4">
						<label for="J_N">J/N</label>
						<select id="J_N" class="form-control form-control-sm J_N">
							<option>Jour</option>
							<option>Nuit</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="DC_PRO">MACHINE</label>
						<select id="DC_PRO" class="form-control form-control-sm DC_PRO">
							<option>MACHINE I </option>
							<option>MACHINE II</option>
							<option>MACHINE III</option>
							<option>MACHINE IV</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="Date">Date</label>
						<input id="Date" type="date" class="form-control form-control-sm Date">
					</div>
		
		</div>			
	</fieldset>	
	<fieldset class="col-md-12 border mt-2">
			<div class="row">  
				<div class="form-group col-md-4">
					<label for="BC_OBSERVATION">Opèrateur : </label>
				</div>	
				<div class="form-group col-md-4">
                    <div class="form-group">
						<div class="input-group mb-3">
							<input type="text" class="form-control form-control-sm chefEquipe" placeholder="Chef d'equipe" aria-label="Entre chef d'equipe" aria-describedby="basic-addon2">
					    </div>
				   </div>	
				</div>
				<div class="form-group col-md-4">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="text" class="form-control form-control-sm Operateur" placeholder="Opèrateur" aria-label="Entre Opèrateur" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<a href="#" class="input-group-text btn btn-primary text-white form-control-sm add-table" id="basic-addon2"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
					
				</div>	
				<div class="form-group col-md-12">
						<table class="w-100 table-bordered table-hover table-sm table-ficher">
							<thead class="bg-dark text-white text-center">
								<tr>
									<th>PO</th>
									<th>Job card</th>
									<th>Equipe</th>
									<th>J/N</th>
									<th>Nom et Prénom</th>
									<th></th>
								</tr>
							</thead>
							<tbody class="tbody tbody-equipe text-center">
								
							</tbody>
						</table>

				</div>			
			</div>	 
	</fieldset>
	<fieldset class="col-md-12 border mt-2">
				<div class="row">  
					<div class="form-group col-md-12">
						<label for="BC_OBSERVATION">Observation : </label>
						<textarea class="form-control BC_OBSERVATION"></textarea>
					</div>	
				</div>
	</fieldset>	
	<fieldset class="col-md-12 border mt-2">
		<div class="text-right m-3"> 
			<button type="submit" class="btn btn-success creetfiches_btn">Enregistre</button>
			<button type="reset" class="btn btn-danger">Annuler</button>
	</div>
	</fieldset>	
	</div>	
	</div>	

	</div>
	<div class="tab-pane pt-2 table-responsive" id="Operateur">
<p class="btn btn-warning"> EXTRUSION </p> 	
		 <table class="text-sm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableOperateurEX"  id="EXTRUSION">
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>CLIENT</th>
					<th>DIMENSION</th>
					<th>POIDS EN KG</th>
					<th>TYPE</th>
					<th>HEURE</th>
					<th>METRE</th>
					<th>POIDS ENTRE</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>MACHINE</th>
					<th>1ER CHOIX</th>
					<th>2E CHOIX</th>
					<th>QUART TIME</th>
					<th>DURE</th>
					<th>NOMBRE DE ROULAUX</th>
				</tr>
				</thead>
				<tbody class="tbody tbody-TableOperateurEX">
				</tbody>
		   </table>

<p class="btn btn-warning">INPRESSION</p> 
<table class="text-sm table-bordered table-sm  table-responsive table-hover w-100 table-strepted TableOperateurINPRESS table-modif" >
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>CLIENT</th>
					<th>DIMENSION</th>
					<th>POIDS EN KG</th>
					<th>QTT</th>
					<th>TYPE</th>
					<th>METRAGE</th>
					<th>POIDS ENTRE</th>
					<th>DECHET</th>
					<th>DURE</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>N°OPERATEUR</th>
					<th>QTIME</th>
					<th>N°MACHINE</th>
					<th>TAILLE</th>
					<th>OBSERVATION</th>
					<th>RESTE GAINE</th>
					<th>N°RLX</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
		   </table>		
<p class="btn btn-warning">COUPE</p> 	
 <table class="text-sm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableDecoupeEX table-modif" >
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>CLIENT</th>
					<th>DIMENSION</th>
					<th>POIDS EN KG</th>
					<th>QTT</th>
					<th>TYPE</th>
					<th>N°RLX</th>
					<th>METRAGE</th>
					<th>POID ENTREE</th>
					<th>1ER CHOIX</th>
					<th>POID SORTIE</th>
					<th>2E CHOIX</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>QUART</th>
					<th>MACHINE</th>
					<th>NOMBRE DE ROULAUX</th>
					<th>METRAGE</th>
					<th>REFERENCE</th>
					<th>KGS</th>
					<th>HEURE</th>
				    <th>OBSERVATION</th>
					
				</tr>
				</thead>
				<tbody>
				</tbody>
		   </table>				   	   	   		   	   
<p class="btn btn-primary mt-3">INJECTION</p>   
		    <table class="text-sm table-bordered table-sm table-hover w-100 table-strepted TableOperateurIN table-modif" >
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>REFERENCE</th>
					<th>QTT</th>
					<th>DECHET</th>
					<th>N°MACHINE</th>
					<th>DUREE</th>
					<th>QUART</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>MATIER EN KG</th>
					<th>MASTER BATCHE(kg)</th>
					<th>OBSERVATION I</th>
					<th>OBSERVATION II</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
		   </table>

   
<p class="btn btn-primary">INPRESSION</p> 
<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted TableOperateurIN table-modif" >
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>REFERENCE</th>
					<th>N°MACHINE</th>
					<th>QTT</th>
					<th>DECHET</th>
					<th>DUREE</th>
					<th>QUART</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>OBSERVATION I</th>
					<th>OBSERVATION II</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
		   </table>		


<p class="btn btn-primary">HOOK</p> 	
<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted TableOperateurIN table-modif" >
		 	<thead class="bg-dark text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>REFERENCE</th>
					<th>N°MACHINE</th>
					<th>QTT</th>
					<th>DECHET</th>
					<th>DUREE</th>
					<th>QUART</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>OBSERVATION I</th>
					<th>OBSERVATION II</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
		   </table>				   	   	   
	</div> 
	<div class="tab-pane pt-2 table-responsive" id="fiche">
	<div class="container">
		<div class="row">	
	<fieldset class="col-md-12 border">
		<div class="row">
				
					<div class="form-group col-md-4">
						<label for="BC_PE">PO N° : </label>
						<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
					</div>
					<div class="form-group col-md-4">
						<label for="JO_ID">JOB CARD N° : </label>
						<input type="text" name="JO_ID"  disabled class="form-control form-control-sm JO_ID">
					</div>
					<div class="form-group col-md-4">
						<label for="J_N">J/N</label>
						<select id="J_N" class="form-control form-control-sm J_N">
							<option>Jour</option>
							<option>Nuit</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="DC_PRO">Proccessus</label>
						<select id="DC_PRO" class="form-control form-control-sm DC_PRO">
							<option>EXTRUSION</option>
							<option>INJECTION</option>
							<option>DECOUPE</option>
							<option>INPRESSION</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="Date">Date</label>
						<input id="Date" type="date" class="form-control form-control-sm Date">
					</div>
		
		</div>			
	</fieldset>	
	<fieldset class="col-md-12 border mt-2">
			<div class="row">  
				<div class="form-group col-md-4">
					<label for="BC_OBSERVATION">Opèrateur : </label>
				</div>	
				<div class="form-group col-md-4">
                    <div class="form-group">
						<div class="input-group mb-3">
							<input type="text" class="form-control form-control-sm chefEquipe" placeholder="Chef d'equipe" aria-label="Entre chef d'equipe" aria-describedby="basic-addon2">
					    </div>
				   </div>	
				</div>
				<div class="form-group col-md-4">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="text" class="form-control form-control-sm Operateur" placeholder="Opèrateur" aria-label="Entre Opèrateur" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<a href="#" class="input-group-text btn btn-primary text-white form-control-sm add-table" id="basic-addon2"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
					
				</div>	
				<div class="form-group col-md-12">
						<table class="w-100 table-bordered table-hover table-sm table-ficher">
							<thead class="bg-dark text-white text-center">
								<tr>
									<th>PO</th>
									<th>Job card</th>
									<th>Equipe</th>
									<th>J/N</th>
									<th>Nom et Prénom</th>
									<th></th>
								</tr>
							</thead>
							<tbody class="tbody tbody-equipe text-center">
								
							</tbody>
						</table>

				</div>			
			</div>	 
	</fieldset>
	<fieldset class="col-md-12 border mt-2">
				<div class="row">  
					<div class="form-group col-md-12">
						<label for="BC_OBSERVATION">Observation : </label>
						<textarea class="form-control BC_OBSERVATION"></textarea>
					</div>	
				</div>
	</fieldset>	
	<fieldset class="col-md-12 border mt-2">
		<div class="text-right m-3"> 
			<button type="submit" class="btn btn-success creetfiches_btn">Enregistre</button>
			<button type="reset" class="btn btn-danger">Annuler</button>
	</div>
	</fieldset>	
	</div>	
	</div>	
	</div>	

	<div class="tab-pane pt-2 table-responsive" id="extrusion">
	<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted extrusion">
			<thead class="bg-dark text-white">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>METRE</th>
					<th>PDS BRUT</th>
					<th>DECHETS</th>
					<th>PDS NET</th>
					<th>DUREE</th>
					<th>J/N</th>
					<th>N° MACH</th>
					<th>N° RLX</th>
					<th>NBR RLX</th>
					<th>T/T</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>OBS</th>
				</tr>
				</thead>
				<tbody>
			
				</tbody>
			</table>
	</div>
	<div class="tab-pane pt-2 table-responsive" id="injection">
	<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted TableProduction ">
		
		<thead class="bg-dark text-white">
		<tr> 
		<th>DATE</th>	
		<th>PO</th>	
		<th>METRAGE</th>
		<th>POIDS</th>
		<th>DUREE</th>	
		<th>EQUIPE</th>
		<th>OP1</th>
		<th>OP2</th>
		<th>NB</th>
		<th>OP</th>	
		<th>QUART</th>
		<th>MACH</th>	
		<th>TAILLE</th>	
		<th>OBS</th>	
		<th>R-G</th>	
		<th>RLX</th>
		</tr>
			</thead>
			<tbody>
		
			</tbody>
		</table>
	</div>
	<div class="tab-pane pt-2 table-responsive" id="Terminer">
	<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted TableProduction" >
			<thead class="bg-dark text-white">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>TYPE</th>
					<th>MACHINE</th>
					<th>PROCCESSUS</th>
					<th>TYPE DE BAG</th>
					<th>MATIER</th>
					<th>DIMENSION</th>
					<th>PERFORATION</th>
					<th>QUNTITE</th>
					<th>REASSORT</th>
					<th>RABAT</th>
					<th>PERFORATION</th>
					<th>CYLINDRE</th>
					<th>OBSERVATION</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
	</div>
	<div class="tab-pane pt-2 table-responsive" id="Inpression">
		<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted TableProduction ">
		
			<thead class="bg-dark text-white">
			<tr> 
			<th>DATE</th>	
			<th>PO</th>	
			<th>METRAGE</th>
			<th>POIDS</th>
			<th>DUREE</th>	
			<th>EQUIPE</th>
			<th>OP1</th>
			<th>OP2</th>
			<th>NB</th>
			<th>OP</th>	
			<th>QUART</th>
			<th>MACH</th>	
			<th>TAILLE</th>	
			<th>OBS</th>	
			<th>R-G</th>	
			<th>RLX</th>
			</tr>
				</thead>
				<tbody>
			
				</tbody>
			</table>
	</div>
	<div class="tab-pane pt-2 table-responsive" id="decoupe">
		<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted Tabledecoupe ">
			<thead class="bg-dark text-white">
			<tr> 
				<th>DATE</th>	
				<th>PO</th>	
				<th>RLX	</th>
				<th>METRAGE</th>	
				<th>KGS</th>	
				<th>1ER CHOIX</th>	
				<th>KGS</th>	
				<th>2E CHOIX</th>		
				<th>COUPE</th> 	
				<th>EXT</th>	
				<th>IMPRE </th>	
				<th>GAINE</th>	
				<th>EQUIPE</th>	
				<th>OP1</th>	
				<th>OP2	</th>
				<th>TAILLE</th>	
				<th>NB OP</th>
				<th>QUART</th>	
				<th>MACHINE</th>
				<th>HEURE</th>	
				<th>RESTE</th>
				<th>TOATL</th>	
				<th>DIFF</th>
				<th>NB</th>
				<th>POIDS</th>	
				<th>COUPE</th>	
				<th>EXT</th>	
				<th>IMP</th>	
				<th>TIREE</th>							
				<th>GAINE</th>
				<th>SORTIE</th>	
			<tr>																				
																							
																
				</thead>
				<tbody>
			
				</tbody>
			</table>
	</div>


	
	</div>


	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modifier job card</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">FERMER</button>
				<button type="button" class="btn btn-success">ENREGISTRE</button>
			</div>
		</div>
	</div>
</div>

	<div class="modal fade bd-example-modal-lg" id="modaleInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
	<div class="card">
	<div class="card-header bg-dark text-white">
		<b>CREE FICHE</b>
	</div>
	<div class="card-body">
		<div class="form">
			<form>	
		
		
	<fieldset class="col-md-12 border">
		<div class="row">
				<div class="form-group col-md-4">
					<label for="date">Date : </label>
					<input type="text" name="date"  disabled class="form-control form-control-sm date" value=<?=date('d-m-Y')?>>
					</div>
					<div class="form-group col-md-2">
					<label for="BC_PE">PE N° : </label>
					<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
					</div>
					<div class="form-group col-md-2">
					<label for="BC_PE">N° Job Cart : </label>
					<input type="text" name="JO_ID" disabled class="form-control form-control-sm JO_ID" value="">
					</div>
					<div class="form-group col-md-4">
					<label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>
					<select  class="form-control form-control-sm BC_TYPEPRODUIT">
						<option>CINTRES</option>
						<option>SACHETS</option>
						<option>GAINES</option>
						<option>PUCE DE TAILLES</option>
					</select> 
					</div>
					
					<div class="form-group col-md-3">
					<label for="BC_CLIENT">CLIENT, Réfèrence : </label>
					<input type="text" name="BC_CLIENT" disabled class="form-control form-control-sm BC_CLIENT ">
					</div>
					<div class="form-group col-md-3">
					<label for="BC_CODE">CODE : </label>
					<input type="text" name="BC_CODE" disabled class="form-control form-control-sm BC_CODE">
					</div>
					<div class="form-group col-md-3">
					<label for="BC_DATELIVRE">Date de livraison : </label>
					<input type="date" name="BC_DATELIVRE" disabled class="form-control form-control-sm BC_DATELIVRE">
					</div>

		</div>			
	</fieldset>	
	<fieldset class="col-md-12 border mt-2">
			<div class="row">  
					<div class="form-group col-md-4">
					<label for="BC_REASSORT">Reassort : </label>
					<input type="text" name="BC_REASSORT" disabled  class="form-control form-control-sm BC_REASSORT ">
					</div>
					<div class="form-group col-md-4">
					<label for="BC_ECHANTILLON">Echantillon : </label>
					<input type="text" name="BC_ECHANTILLON"  disabled class="form-control form-control-sm BC_ECHANTILLON">
					</div>
					
					<div class="form-group col-md-4">
					<label for="BC_DIMENSION">Dimension : </label>
					<input type="text" name="BC_DIMENSION" disabled  class="form-control form-control-sm BC_DIMENSION">
					</div>		
					<div class="form-group col-md-4">
					<label for="BC_RABAT">Rabat : </label>
					<input type="text" name="BC_RABAT" disabled class="form-control form-control-sm BC_RABAT">
					</div>
					<div class="form-group col-md-4">
					<label for="BC_SOUFFLET">Soufflet : </label>
					<input type="text" name="BC_SOUFFLET" disabled  class="form-control form-control-sm BC_SOUFFLET">
					</div>
					
					<div class="form-group col-md-4">
					<label for="BC_PERFORATION">Perforation : </label>
					<input type="text" name="BC_PERFORATION" disabled class="form-control form-control-sm BC_PERFORATION">
					</div>
					<div class="form-group col-md-4">
					<label for="BC_TYPE">Type : </label>
					<select disabled class="form-control BC_TYPE form-control-sm">
						<?php foreach ($type as $key => $type):?> 
						<option><?=$type->TF_DESIGNATION?></option>
						<?php endforeach;?>
					</select>
					</div>
					
					<div class="form-group col-md-4">
					<label for="BC_IMPRESSION">Impression : </label>
					<input type="text" disabled name="BC_IMPRESSION"  class="form-control form-control-sm BC_IMPRESSION">
					</div>
					<div class="form-group col-md-4">
					<label for="BC_CYLINDRE">Cylindre : </label>
					<input type="text" disabled name="BC_CYLINDRE"  class="form-control form-control-sm BC_CYLINDRE">
					</div>
				</div>	


	</fieldset>
	<fieldset class="col-md-12 border mt-2">
			<div class="row">  
				<div class="form-group col-md-4">
					<label for="BC_TYPEMATIER">Matiér : </label>
					<select disabled class="form-control BC_TYPEMATIER form-control-sm">
						<?php foreach ($type_de_matier as $key => $type_de_matier):?> 
						<option><?=$type_de_matier->TM_DESIGNATION?></option>
					<?php endforeach;?>
					</select>
					</div>
					<div class="form-group col-md-4">
					<label for="BC_QUNTITE">Quantité : </label>
					<input type="number" disabled name="BC_QUNTITE"  class="form-control form-control-sm BC_QUNTITE">
					</div>
					<div class="form-group col-md-4">
					<label for="BC_PRIX">Prix : </label>
					<input type="number" disabled name="BC_PRIX" class="form-control form-control-sm BC_PRIX">
					</div>
				</div>
		</div>	 
	</fieldset>	 
	<fieldset class="col-md-12 border mt-2">
				<div class="row">  
					<div class="form-group col-md-12">
						<label for="BC_OBSERVATION">Observation : </label>
						<textarea disabled class="form-control BC_OBSERVATION"></textarea>
					</div>	
				</div>
	</fieldset>	

	</div>
	<div class="card-footer text-right"> 
			<button type="submit" class="btn btn-success creetfiche">Crée fiche</button>
			<button type="reset" class="btn btn-danger removeModal">Annuler</button>
	</div>
	</form>
	</div>  
	</div>  
	</div> 


	<div class="modal fade bd-example-modal-lg" id="modaleInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
	<div class="card">
	<div class="card-header bg-dark text-white">
		<b>Verification matières</b>
	</div>
	<div class="card-body">
		<div class="form">
		
		</div>
	<div class="card-footer text-right"> 
			<button type="submit" class="btn btn-success creetfiche">Crée fiche</button>
			<button type="reset" class="btn btn-danger removeModal">Annuler</button>
	</div>
	</form>
	</div>  
	</div>  
	</div> 









	<div class="modal fade bd-example-modal-lg" id="matier" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
	<div class="card">
	<div class="card-header bg-dark text-white">
		<b>Verification matières</b>
	</div>
	<div class="card-body">
		<div class="form">
		b
		</div>
	<div class="card-footer text-right"> 
			<button type="submit" class="btn btn-success creetfiche">Crée fiche</button>
			<button type="reset" class="btn btn-danger removeModal">Annuler</button>
	</div>
	</form>
	</div>  
	</div>  
	</div> 




