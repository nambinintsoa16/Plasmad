<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link type='text/css' href='bootstrap.min.css' rel='stylesheet'/>
</head>
<body>
<style type="text/css">
  body{
    font-size: 12px;
    margin: auto;
  }
  .table >td{
    border: solid  1px gray!important; 
    height: 16px !important;
  }
  .table{
    width: 100%;

  
  }
  .container{
    margin: auto;
    padding: auto;
  }


   .dataTable{
    width: 100%;
   }
   .table-marge > td{

         width: 70px!important;
   }
   .table-marge{
    margin-top: 30px;
   }
</style>
<body>
  <div class="container">
      <div style='width:200px;Height:100px;position:absolute;float:left'>
            <!--<img src='logo.png' width='80px' height='80px'/> -->
            <?=$logo?>
        </div>

    
  <table class="dataTable">
    <tr>
       <td colspan="3"> JOB CARD No  : <?=$data->JO_ID?></td> 
       <td colspan="1" >  Issue Date : <?=$data->BC_DATE?></td> 
    </tr> 
    <tr>  
      <td>Extrusion :   <?=$data->JO_MACHINE?></td> 
      <td>Bag Type <?=$data->BC_TYPE?></td>
      <td>Material :  <?=$data->BC_TYPEMATIER?> </td> 
      <td style="width:152px!important">Date de livraison : <?=$data->BC_DATELIVRE?> </td>
    </tr>
    <tr>
     <td>Customer Name :  <?= $data->BC_CODE?> </td> 
     <td> PO No : <?= $data->BC_PE?> </td> 
     <td  colspan="2">Rabat :  <?= $data->BC_RABAT?></td> 
    </tr>
    <tr>


    <td> Dimension :  <?= $data->BC_DIMENSION?></td>
    <td>Couleur: </td>
    <td  colspan="2">Soufflet : <?= $data->BC_SOUFFLET?></td>
  </tr>
    <tr>
    <td>Ordré Quantité :  <?= $data->BC_QUNTITE?></td>
    <td >Quantité à produire en mètre :  <?= $data->BC_QUANTITEAPRODUIREENMETRE?></td>
    <td colspan="2">Perforation :  <?= $data->BC_PERFORATION?></td>
</tr>
    <tr>
    <td>Poids d'un sachet :  <?= $data->BC_POIDSDUNSACHET?></td>
    <td>Poids en kg avec marge :   <?= $data->BC_POISENKGSAVECMARGE?></td>
    <td>Poids par rlx ext :  <?= $data->BC_SOUFFLET?></td></tr>
    <tr><td>Demande Spéciale : </tr>
    <tr><td colspan="3"> Matière première venant du magasin : (Document no. & issue by) : </td></tr>
    </tr>
  </table>  
    <table class="table table-marge">
       
            <tr>
                <td>LD</td>
                <td></td>
                <td>LLD</td>
                <td></td>
                <td>Re-Extrusion</td>
                <td>Core Tube</td>
                <td>Impression Encre</td>
                <td>Sealing Tape</td>
            </tr>
            <tr>
                <td>HD</td>
                <td></td>
                <td>PP</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>MB</td>
                <td></td>
                <td>Other</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
           
          
    </table>
    <table class="dataTable" style="margin-top:20px;">
      
  <tr>
     <td>EXT Dimension pour la Production</td>
      <td> Impression M/c no</td>
     <td> Cylindre</td>
  </tr>
    </table>
   
 <table class="dataTable">
    <tr>
         <td>................... </td>
         <td>Nombre de rouleaux </td>
          <td> Impression couleur</td>
         <td>  Echantillion no</td>
    </tr>

    </table>
   

   


<Table  class=" table">
  <thead>
      <tr>
        <td>Date</td>
        <td>Total Mètre</td>
        <td>Poids</td>
        <td>Déchet</td>
        <td>Leader</td>
        <td>Date</td>
        <td>Total Mètre</td>
        <td>Podis</td>
        <td>Déchet</td>
        <td>M/min</td>
        <td>Leader</td>
      </tr>
  </thead>
  <tbody>
     <tr>
        <td> </td>
        <td></td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>   </td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
  <tr>
        <td> </td>
        <td></td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>   </td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

  <tr>
        <td> </td>
        <td></td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>   </td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

  <tr>
        <td> </td>
        <td></td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>   </td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

  <tr>
        <td> </td>
        <td></td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>   </td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

  <tr>
        <td> </td>
        <td></td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>   </td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>


  </tbody>


</Table>
<table style="margin-top:20px;">
  <tr>
    <td>COUPE SECTION : Machine No: </td>
  <tr>

</table>
<Table  class="table">
    <thead>
        <tr>
          <td>Date</td>
          <td>Shift</td>
          <td>Total Pcs</td>
          <td>Total Poids</td>
          <td>Déchet kg</td>
          <td>2 Choix pcs</td>
          <td>Poids</td>
          <td>Operator</td>
          <td>Leader</td>
          <td>Online QC Check Remark</td>
        </tr>
    </thead>
    <tbody>
       <tr>
          <td></td>
          <td></td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
         <tr>
          <td></td>
          <td></td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

 <tr>
          <td></td>
          <td></td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

 <tr>
          <td></td>
          <td></td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

 <tr>
          <td></td>
          <td></td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>

 <tr>
          <td></td>
          <td></td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>




    </tbody>
  
  
  </Table>
<div style="width: 100%;margin-top: 30px">
  <div style="display: inline-block; width: 80%;">
    Planning ....................
  </div >
  <div style="display: inline-block;width: 20%;"">Production Head  ....................</div>
 
<div>  

</div>
</body>
</html>