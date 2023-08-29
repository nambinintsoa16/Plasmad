<style>
    .label {
        color: #2a5591;
    }
    
</style>
<p class='w-100 text-left'><b>Création job card</b></p>
<fieldset class="col-md-12 border text-left text-blue">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="Machine">Machine</label>
            <input type="text" name="machine" disabled value="" class="form-control form-control-sm" id="machine">
        </div>
        <div class="form-group col-md-6">
            <label for="JO_ID">N° Job card : </label>
            <input type="text" name="JO_ID" disabled value="" class="form-control form-control-sm" id="id_jobs">
        </div>
    </div>
</fieldset>
<fieldset class="col-md-12 border text-left mt-2 text-blue">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="BC_PE"> N° PO : </label>
            <input type="text" name="BC_PE" class="form-control form-control-sm" id="refnum" value="">
        </div>
        <div class="form-group col-md-4">
            <label for="quantite">Quantité à produire : </label>
            <input type="text" name="quantite" class="form-control form-control-sm " id="quantite">
        </div>
        <div class="form-group col-md-4">
            <label for="date_prod">Date de production</label>
            <input type="date" id="date_prod" name="date_prod" class="form-control form-control-sm " id="date_prod">
        </div>
        <div class="form-group col-md-4 collapse">
            <input type="text" name="reste" class="form-control form-control-sm reste">
        </div>
    </div>
</fieldset>
<fieldset class="col-md-12 border text-left mt-2 text-blue">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Heure début : </label>
            <input type="Time" name="" class="form-control form-control-sm" id="heure_debut">
        </div>
        <div class="form-group col-md-6">
            <label for="">Durée : </label>
            <input type="time" name="" disabled class="form-control form-control-sm" id="duree_prod">
        </div>
        <div class="form-group col-md-6">
            <label for="">Date fin : </label>
            <input type="date" name="" disabled class="form-control form-control-sm" id="date_fin">
        </div>
        <div class="form-group col-md-6">
            <label for="">Heure fin : </label>
            <input type="time" name="" disabled class="form-control form-control-sm" id="heure_fin">
        </div>
    </div>
</fieldset>
<script>
    $(document).ready(function() {
        $('input').on('change', function(event) {
            let date_prod = $('#date_prod').val();
            let quantite = $('#quantite').val();
            let machine = $('#machine').val();
            let heure_debut = $('#heure_debut').val();
            let methodOk = date_prod!="" && quantite!="" && machine!="" && heure_debut!="";
            if (methodOk) {
                $.post(base_url + 'Planning/get_time_production', {date_prod,quantite,machine,heure_debut}, function(data) {
                    $('#duree_prod').val(data.dure);
                    $('#date_fin').val(data.date_fin);
                    $('#heure_fin').val(data.heure_fin);
                }, 'json');
            }
        });

    })
</script>