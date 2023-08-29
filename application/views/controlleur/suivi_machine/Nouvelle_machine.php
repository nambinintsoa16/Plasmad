<fieldset class="border p-4 bg-white">
    <form method="POST" action="">
        <div class="row border">
            <div class="form-group col-md-3">
                <label>DESIGNATION </label>
                <input type="text" class="form-control form-control-sm input" id="designation">
            </div>
            <div class="form-group col-md-3">
                <label>VITESSE MACHINE </label>
                <input type="text" class="form-control form-control-sm input" id="vitesse">
            </div>
            <div class="form-group col-md-3">
                <label>CAPACITE</label>
                <input type="text" class="form-control form-control-sm input" id="capacite">
            </div>
            <div class="form-group col-md-3">
                <label>DIMENSION</label>
                <input type="text" class="form-control form-control-sm input" id="dimension">
            </div>
            <div class="form-group col-md-3">
                <label>SPECIFIQUE </label>
                <select class="form-control" id="specification">
                    <optgroup label="SACHETS">
                        <option value="EXTRUSION">Extrusion</option>
                        <option value="IMPRESSION_EXTRUSION">Impression</option>
                        <option value="COUPE_EXTRUSION">Coupe</option>
                    </optgroup>
                    <optgroup label="CINTRE">
                        <option value="INJECTION">Injection</option>
                        <option value="IMPRESSION_INJECTION">Impression</option>
                        <option value="HOOK">Hook</option>
                    </optgroup>
                </select>
            </div>
        </div>    
        <div class="row border mt-2">
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-danger  m-2 " id="annuler">Annuler</button>
                <button class="btn btn-success" id="save_machine"> <i class="fa fa-save" aria-hidden="true"></i>&nbsp; Enregistrer</button>
            </div>
        </div>
    </form>
</fieldset>