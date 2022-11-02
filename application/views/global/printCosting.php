<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta http-equiv='X-UA-Compatible' content='ie=edge'>
	<link type='text/css' href='bootstrap.min.css' rel='stylesheet' />
	<style>
		table {
			border: solid #000 1px;
			margin: 10px;
		}
		td {
			border: solid #000 1px;
			width: 110px!important;
		}
	</style>
</head>

<body>
<table style="background: #000;">
	<tr style="color: #fff;">
		<td>PRE COSTING PO : <?=$data->PB_PO?></td>
	</tr>
</table>

<table style="background: #000;">
	<tr style="color: #fff;">
		<td>TYPE DE CALCULE : <?=$data->PB_TYPECALCULE?></td>
	</tr>
</table>


<table >
	 <tr>
		<td>width :</td>
		<td><?=$data->PB_WIDTH?></td>

		<td>length :</td>
		<td><?=$data->PB_LENGTH?></td>

		<td>thickness :</td>
		<td><?=$data->PB_THICKNESS?></td>
	</tr>

	<tr>
		<td>Flap :</td>
		<td><?=$data->PB_FLAP?></td>

		<td>Gusset :</td>
		<td><?=$data->PB_GUSSET?></td>

		<td>Order :</td>
		<td><?=$data->PB_ORDER?></td>
	</tr>

	<tr>
		<td>Marge :</td>
		<td><?=$data->PB_MARGES?></td>

		<td>Printing area :</td>
		<td><?=$data->PB_PRINTING_AREA?></td>

		<td>Prix_matier :</td>
		<td><?=$data->PB_PRIX_MATIER?></td>
	</tr>
	<tr>
		<td>Vitesse machine:</td>
		<td><?=$data->PB_VITESSEMACHINE?></td>
	</tr>

	
</table>



<table >	
	<tr>
		<td>Marge :</td>
		<td><?=$data->PB_MARGE?></td>
	</tr>
	<tr>
		<td>Prix sans marge :</td>
		<td><?=$data->PB_SANS_MARGE?></td>
	</tr>
	<tr>
		<td>Prix avec marge :</td>
		<td><?=$data->PB_PRIX?></td>
	</tr>
</table>
<table >
	<tr>
		<td>Prix USD :</td>
		<td><?=$data->PB_PRIX?></td>
	</tr>	
	<tr>
		<td>Prix EURO :</td>
		<td><?=$data->PB_PRIXARIARY?></td>
	</tr>
</table>
</body>

</html>
