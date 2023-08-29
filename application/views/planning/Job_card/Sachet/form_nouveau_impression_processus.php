<style>
    .label {
        color: #2a5591;
    }
</style>

<fieldset class="col-md-12 border text-left">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="JO_ID">JOB CARD N° : </label>
            <input type="text" name="JO_ID" class="form-control form-control-sm " id="refnum_job_card">
        </div>
        <div class="form-group col-md-4">
            <label for="BC_PE">PO N° : </label>
            <input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" id="refnum_commande" value="">
        </div>
        <div class="form-group col-md-4">
            <label for="BC_PE">PRODUCTION JOB CARD : </label>
            <input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" id="commande_produit">
        </div>
        <div class="form-group col-md-4">
            <label for="date_prod">DATE DE PRODUCTION</label>
            <input type="date" id="date_prod" name="date_prod" class="form-control form-control-sm " id="date_prod">
        </div>
        <div class="form-group col-md-4">
            <label for="DJ_MACHINE">PROCESSUS</label>
            <select class="form-control BC_STATUT form-control-sm" id="machine_processus">
                <option value="COUPE_EXTRUSION">COUPE</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="DJ_MACHINE">MACHINE</label>
            <select class="form-control form-control-sm " name="DJ_MACHINE" id="machine_pross">
            </select>
        </div>
    </div>
</fieldset>
<fieldset class="col-md-12 border text-left mt-2 w-100">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">DEBUT : </label>
            <input type="time" name="" class="form-control form-control-sm" id="heure_debut">
        </div>
        <div class="form-group col-md-6">
            <label for="">DUREE : </label>
            <input type="text" name="" disabled class="form-control form-control-sm" id="duree_prod">
        </div>
        <div class="form-group col-md-6">
            <label for="">DATE FIN : </label>
            <input type="date" name="" disabled class="form-control form-control-sm" id="date_fin">
        </div>
        <div class="form-group col-md-6">
            <label for="">HEURE FIN : </label>
            <input type="time" name="" disabled class="form-control form-control-sm" id="heure_fin">
        </div>
    </div>
</fieldset>
<script>
    $(document).ready(function() {
        get_machine_processus('COUPE_EXTRUSION');
        $('#refnum_job_card').on('change', function(event) {
            event.preventDefault();
            let refnum = $(this).val();
            $.post(base_url + "planning/get_detail_impression_job_card", {
                refnum
            }, function(data) {
                if (data) {
                    $('#refnum_commande').val(data.BC_PE);
                    $('#commande_produit').val(data.JO_AV);
                } else {
                    $.alert({
                        title: 'Erreur!',
                        content: 'Job card introuvable.',
                        type: 'red'
                    });
                }

            }, 'json')

        });

        $('input').on('change', function(event) {
            event.preventDefault();
            let date_prod= $('#date_prod').val();
            let quantite= $('#commande_produit').val();
            let machine= $('#machine_pross option:selected').text();
            let heure_debut= $('#heure_debut').val();
            let methodOk = date_prod!="" && quantite!="" && machine!="" && heure_debut!=""; 
            if (methodOk) {
                $.post(base_url + 'Planning/get_time_production', {date_prod,quantite,machine,heure_debut}, function(data) {
                    $('#duree_prod').val(data.dure);
                    $('#date_fin').val(data.date_fin);
                    $('#heure_fin').val(data.heure_fin);
                }, 'json');
            }
        });
        
        

        
        $('#machine_processus').on('change',function(event){
            event.preventDefault();
            let type_process = $(this).val();
            get_machine_processus(type_process);
        });
       
        function get_machine_processus(type_process) {
            $.post(base_url + "planning/get_machine_prod", {
                type_process
            }, function(reponse) {
                if (reponse != "") {
                    $('#machine_pross').empty();
                    reponse.forEach(element => $('#machine_pross').append("<option>" + element.MA_DESIGNATION + "</option>"));
                }
            }, "json")
        }
        

    });
</script>