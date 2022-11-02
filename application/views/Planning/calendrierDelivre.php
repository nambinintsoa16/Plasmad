<div class="row pl-5">
    <div class="form-group col-md-4">
        <label for="">Date de livraison : </label>
        <input type="date" name="" id="" class="form-control form-control-sm date" placeholder="">
    </div>
    <div class="form-group col-md-4">
        <label for="">N°PO : </label> 
        <input type="text" name="" id="" class="form-control form-control-sm po" placeholder="Entre N°PO">
    </div>
	<div class="form-group col-md-4">
        <label for="">Quantité livrée : </label> 
        <input type="text" name="" id="" class="form-control form-control-sm quantite" placeholder="Entre quantite à livrée">
    </div>
    <div class="form-group col-md-3">
        <button class="btn btn-warning btn-sm afficherDate"><i class="fa fa-tv"></i>&nbsp;Afficher (Date de livraison obligatoire)</button>
    </div>
    <div class="form-group col-md-2">
        <button class="btn btn-success btn-sm savedate"><i class="fa fa-plus"></i>&nbsp;AJOUTER </button>
    </div>
    <div class="form-group col-md-2">
        <a href="<?=base_url('Planning/printLivraison?date='.date('Y-m-d'))?>" class="btn btn-primary btn-sm export"><i class="fa fa-download"></i>&nbsp;EXPORT </a>
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
        $('.afficherDate').on('click',function(e){
          e.preventDefault();
          var date = $('.date').val();
          var links = base_url + "Planning/tableLivraison?date=" + date;
          $('.export').attr('href',base_url+"Planning/printLivraison?date=" + date);
          Tabele.ajax.url(links);
          Tabele.ajax.reload();
         });




        $('.savedate').on('click', function(e) {
            e.preventDefault();
            var date = $('.date').val();
            var po = $('.po').val();
			var quantite = $('.quantite').val();
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
                    po: po,
					quantite:quantite
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
