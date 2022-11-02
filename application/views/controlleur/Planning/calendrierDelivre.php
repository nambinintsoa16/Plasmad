<div class="row pl-5">
    <div class="form-group col-md-3">
        <label for="">Date de livraison : </label>
        <input type="date" name="" id="" class="form-control form-control-sm date" placeholder="">
    </div>
</div>
<div class="row pl-5">
    <div class="form-group col-md-4">
        <input type="text" name="" id="" class="form-control form-control-sm po" placeholder="N°PO">
    </div>
    <div class="form-group col-md-4">
        <button class="btn btn-success btn-sm savedate"><i class="fa fa-plus"></i>&nbsp;AJOUTER </button>
    </div>
    <div class="form-group col-md-4">
        <button class="btn btn-primary btn-sm export"><i class="fa fa-download"></i>&nbsp;EXPORT </button>
    </div>
</div>
<hr />
<div class="row mt-2">
    <div class="table-responsive">
        <table class="table tableLivre  table-hover ">
            <thead> 
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
    </div>
</div>
<script>
    $(document).ready(function() {
        var Tabele = $('.tableLivre').DataTable({
            processing: true,
            processing: true,
			ajax:base_url+"Planning/tableLivraison",
			language: {
					   url :base_url+"assets/dataTableFr/french.json"
					 },
			
        });
        $('.po').autocomplete({
            source : base_url + "Production/autocompletPo"
        });
        $('.savedate').on('click', function(e) {
            e.preventDefault();
            var date = $('.date').val();
            var po = $('.po').val();
            if (date == "") {
                swal("", "Date non valide", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });

            } else if (po == "") {
                swal("", "N°PO Invalide", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });

            } else {

                $.post(base_url + 'Planning/savedateLivre', {
                    date: date,
                    po: po
                }, function() {
                    $('input').val('');
                    Tabele.ajax.reload();
                    swal("", "Date de livraison enregistré.", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                    });
                });

            }
        });

   
  // tableLivraison()
    });
</script>