<div class="row pl-5 bg-white border">
    <div class="form-group col-md-2">
        <input type="date" name="" class="form-control form-control-sm " placeholder="" id="date_de_sortie">
    </div>
    <div class="form-group col-md-2">
        <input type="text" name="" class="form-control form-control-sm " placeholder="Entre N°PO" id="refnum_commande">
    </div>
	<div class="form-group col-md-2">
        <input type="text" name="" class="form-control form-control-sm "  placeholder="Quantité à livrer" id="quantite">
    </div>
    <div class="form-group col-md-6 text-right  text-midlle-right">
        <a  href="#" class="btn btn-warning btn-sm" id="afficher_result"><i class="fa fa-tv"></i>&nbsp;&nbsp;Afficher (Date de livraison obligatoire)</a>
        <a  href="#" class="btn btn-success btn-sm" id="save_data"><i class="fa fa-plus"></i>&nbsp;&nbsp;AJOUTER </a>
    </div>
</div>
<fieldset class="border w-100 p-0 pt-2 bg-white mt-2 mb-2">
        <table class="w-100  table-hover mt-2 table-sm table-bordered mb-2" id="table_show_data">
            <thead class="bg-<?=$nav_color?> text-white"> 
                 <th>Date</th>
                 <th>N°PO</th>
                 <th>CLIENT</th>
                 <th>DIMENSION</th>
                 <th>PIECES</th>
                 <th>POIDS</th>
            </thead>
        <tbody>    
           
            </tbody>
        </table>
</fieldset>