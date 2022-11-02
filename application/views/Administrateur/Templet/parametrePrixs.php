<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            <b>FORMULE</b>
        </div>
        <div class="card-body">
<div class="alert danger">
        width ,
        length ,
        thickness ,
        Flap ,
        Gusset ,
        Order ,
        marge ,
        total , 
        prix 
 </div>       
            <form class="form" action="Administrateur/parametrePrixSaves" method="post">
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" name="FOR_DESIGNATION" id="" class="form-control FOR_DESIGNATION" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                        <textarea class="form-control w-100" name="FOR_TEXT"  rows="10"></textarea>
                </div>
                <div class="form-group col-md-12 text-right">
                    <button class="btn btn-success">ENREGISTRE</button>
                </div>
        </div>
        </form>
    </div>
</div>