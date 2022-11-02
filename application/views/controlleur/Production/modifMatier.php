<div class="card">
    <div class="card-header bg-dark text-white">
        <b> MODIFIER MATIERE</b>
    </div>
    <div class="card-body">
        <fieldset class="col-md-12 border mt-2">
            <div class="row ">
                <div class="form-group">
                    <input type="text" name="PO" class="form-control form-control-sm PO" placeholder="N°PO">
                </div>
            </div>
        </fieldset>
        <fieldset class="col-md-12 border mt-2 p-2">
            <table class="w-100 table-hover table-bordered table-strepted pl-2">
                <thead class="bg-dark text-white ">
                    <tr>
                        <td>ID</td>
                        <td>DATE</td>
                        <td>N°PO</td>
                        <td>DESIGNATION</td>
                        <td>QUANTITE</td>
                        <td>PRIX</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody class="dataPoResult">
                </tbody>
            </table>
        </fieldset>
    </div>
</div>






<div class="modal fade" id="editMatier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">MODIFIER MATIER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url("Production/updateMatier") ?>">
                <div class="modal-body">

                    <div class="row w-100">
                        <div class="form-group col-md-12">
                            <label for="">ID</label>
                            <input type="text" class="form-control form-control-sm id" name="id" placeholder="" value="">
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="">DESIGNATION</label>
                            <input type="text" class="form-control form-control-sm designation" name="MI_DESIGNATION" placeholder="" value="">
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="">QUANTITE</label>
                            <input type="text" class="form-control form-control-sm qunatite" name="MI_QUANTITE" placeholder="" value="">
                        </div>
                        <div class="form-group  col-md-12">
                            <label for="">PRIX</label>
                            <input type="text" class="form-control form-control-sm prix" name="MI_PRIX" placeholder="" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">FERMER</button>
                    <button type="submit" class="btn btn-success">ENREGISTRER</button>
                </div>
            </form>
        </div>
    </div>
</div>



















<script type="text/javascript">
    $(document).ready(function() {
        $('.PO').autocomplete({
            source: base_url + "Production/autocompletPo",
            select: function(ui, iteme) {
                var param = iteme.item.value.trim();
                $.post(base_url + "Production/matierinression", {
                    PO: param
                }, function(data) {
                    $('.dataPoResult').empty().append(data);
                    matiere();
                }, 'json');
            }
        });





        function matiere() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var param = $('.PO').val();
                var id = $(this).attr('id');
                $.post(base_url + "Production/deleteMatier", {
                    id: id
                }, function(data) {
                    $.post(base_url + "Production/matierinression", {
                        PO: param
                    }, function(data) {
                        $('.dataPoResult').empty().append(data);
                        matiere();
                    }, 'json');
                    swal("Succé!", "Matiere supprimer", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success"
                            }
                        },
                    });

                });

            });

            $('.edit').on('click', function(e) {
                e.preventDefault();
                var  $this = $(this);

                $(".id").val($this.attr('id'));
                $(".designation").val($this.parent().parent().children().eq(3).text());
                $(".qunatite").val($this.parent().parent().children().eq(4).text());
                $(".prix").val($this.parent().parent().children().eq(5).text());

                $('#editMatier').modal('show');
            });

        }
        $('form').on('submit',function(e){
            e.preventDefault();
            var  $this = $(this);
            var formData = new FormData(this);
		$.ajax({
			type:'POST',
			url: $this.attr('action'),
			data: formData,
			cache:false,
			contentType: false,
			processData: false,
			success: (data) => {
			this.reset();
			swal("Succé ", "Matiere modifier", {
				icon : "success",
				buttons: {
					confirm: {
						className : 'btn btn-success'
					}
				},
			});         
			
			},
			error: function(data){
				swal("Erreur ", "Veuillez réessayer!", {
					icon : "error",
					buttons: {
						confirm: {
							className : 'btn btn-danger'
						}
					},
				});                        
			}
	  
});

        });
    });
</script>