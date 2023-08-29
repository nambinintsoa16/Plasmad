<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style>
.container {
    margin: auto;
    padding: 10;
    border: black solid 1px;
    width: 650px;
}

.container-entete {
    display: inline-block;
    width: 250px;
    text-align: left;
    padding-top: 20px !important;
}

td {
    height: 30px !important;
}

.text-copie {
    padding: 30px;
}

.table {
    font-size: 15px;
    width: 100%;

}

.obs {
    height: 110px !important;
    padding-top: 2px !important;
    text-align: top left;
}

.obs span {
    height: 100%;
    padding-top: 2px !important;
}
</style>

<body>
    <div class='container'>
        <div class='container-entete'>
            <img src="assets/img/plasmad.jpg" width='100' alt='Logo'>
        </div>
        <table class="table">
            <tr>
                <td><label>BON DE COMMANDE DU : </label></td>
                <td><?=$data->BC_DATE?></td>
                <td><label>PE N° : </td>
                <td><?=$data->BC_PE?></td>
            </tr>
            <tr>
                <td>CLIENT,Référence : </td>
                <td><?=$data->BC_CLIENT?></td>
                <td>CODE : </td>
                <td><?=$data->BC_CODE?></td>
            </tr>
            <tr>
                <td>Date de Livraison : </td>
                <td colspan='3'><?=$data->BC_DATELIVRE?></td>
            </tr>

            <tr>
                <td>Couleur :</td>
                <td ><?=$data->BC_IMPRESSION?></td>
            
                <td>Model :</td>
                <td><?=$data->BC_MODEL?></td>
            </tr>
            <tr>
                <td>Quantité :</td>
                <td><?=$data->BC_QUNTITE?></td>
                <td>Prix :</td>
                <td><?=$data->BC_PRIX?></td>
            </tr>
            <tr>
                <td colspan="4"><label>Observation</label></td>
            </tr>
            <tr>
                <td colspan='4' style="border: solid gray 1px;" class="obs">
                    <?=$data->BC_OBSERVATION?>
                </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <label class='w-100'> PLASMAD S.a.r.l. PK 8 RN7 Malaza Tanjombato, Antananarivo 102,
                        Madagascar</label>
                </td>
            </tr>
            <td colspan='4'>
                <label class='w-100'> Tél : (+261) 32 07 638 98 / (+261) 33 11 638 98 </label>
            </td>
            </tr>
        </table>
    </div>
</body>
</html>