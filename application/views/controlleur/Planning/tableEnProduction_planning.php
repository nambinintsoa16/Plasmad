<hr />
<p class="mt-3 mb-3">
  <a href="#" class="btn btn-success text-left linksTabs" style="width: 200px" aria-expanded="false" aria-controls="EXTRUSION">
    <i class="fa fa-cube"></i> EXTRUSION
  </a>
  <a href="#" class="btn btn-info text-left linksTabs" style="width: 200px" aria-expanded="false" aria-controls="INJECTION">
    <i class="fa fa-cube"></i> INJECTION
  </a>
</p>
<hr />
<span class="cont-data">
</span>
<script>
  $('document').ready(function() {
    chargement();
    $.post(base_url + 'Planning/tableProcessus', {
      page: "EXTRUSION"
    }, function(data) {
      $('.cont-data').empty().append(data);
      processusExtrusion();
      closeDialog();
    });


    $(".linksTabs").on('click', function(event) {
      event.preventDefault();
      var page = $(this).text().trim();
      chargement();
      $.post(base_url + 'Planning/tableProcessus', {
        page: page
      }, function(data) {
        $('.cont-data').empty().append(data);
        if (page == "EXTRUSION") {
          processusExtrusion();
          closeDialog();
        } else if (page == "INJECTION") {
          processusInjection();
          closeDialog();

        }
      });

    });

    function processusExtrusion() {
      $.post(base_url + 'Planning/dataExtrusion', {
        param: "EXTRUSION"
      }, function(data) {
        $('.processus-cont').empty().append(data);
        proxcessuxExtrusionAction();
        closeDialog();
      });


      $('.linsKPro').on('click', function(event) {
        event.preventDefault();
        chargement();
        var param = $(this).text().trim();
        $.post(base_url + 'Planning/dataExtrusion', {
          param: param
        }, function(data) {
          $('.processus-cont').empty().append(data);
          proxcessuxExtrusionAction();
          closeDialog();
        });

      });

    }

    function processusInjection() {
      $.post(base_url + 'Planning/dataInjection', {
        param: "INJECTION"
      }, function(data) {
        $('.processus-cont').empty().append(data);
        closeDialog();
      });

      $('.linsKPro').on('click', function(event) {
        event.preventDefault();
        chargement();
        var param = $(this).text().trim();
        $.post(base_url + 'Planning/dataInjection', {
          param: param
        }, function(data) {
          $('.processus-cont').empty().append(data);
          proxcessuxExtrusionAction();
          closeDialog();
        });

      });

    }

    function processusInjection() {
      $.post(base_url + 'Planning/dataInjection', {
        param: "INJECTION"
      }, function(data) {
        $('.processus-cont').empty().append(data);
        closeDialog();
      });

      $('.linsKPro').on('click', function(event) {
        event.preventDefault();
        chargement();
        var param = $(this).text().trim();
        $.post(base_url + 'Planning/dataInjection', {
          param: param
        }, function(data) {
          $('.processus-cont').empty().append(data);
          proxcessuxExtrusionAction();
          closeDialog();
        });

      });

    }

    function proxcessuxExtrusionAction() {
      $('.UpdateExtrusion').on('click', function(event) {
        event.preventDefault();
        var BC_PE = $('.BC_PE').val();
        var BC_STATUT = $('.BC_STATUT option:selected').val();
        var BC_MACHINE = $('.DJ_MACHINE option:selected').val();
        var date = $('.date_prod').val();
        var DURE = $('.DURE').val();
        var DEBUT = $('.DEBUT').val();

        $.post(base_url + 'Planning/updateBondecommande', {
          DURE: DURE,
          DEBUT: DEBUT,
          date: date,
          BC_PE: BC_PE,
          BC_STATUT: BC_STATUT,
          BC_MACHINE: BC_MACHINE
        }, function(data) {
          $(".editData").modal("hide");
        });



      });

      $('.terminerPro').on('click', function(event) {
        event.preventDefault();
        var parent = $(this).parent().parent().children().eq(2).text().trim();
        swal({
          title: 'Message de confirmation',
          text: "Vous êtes sûr de vouloir terminé le processus",
          type: 'warning',
          buttons: {
            confirm: {
              text: 'Oui',
              className: 'btn btn-success'
            },
            cancel: {
              visible: true,
              text: 'Non',
              className: 'btn btn-danger'
            }
          }
        }).then((Delete) => {
          if (Delete) {
            $.post(base_url + 'Planning/updateJobsTerminer', {
              parent: parent
            }, function(data) {
              swal({
                title: 'Succè!',
                text: 'Processus terminé.',
                type: 'success',
                buttons: {
                  confirm: {
                    className: 'btn btn-success'
                  }
                }
              });
            });
          } else {
            swal.close();
          }
        });

      });
    }

    function chargement() {
      var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
      $.dialog({
        "title": "",
        "content": htmls,
        "show": true,
        "modal": true,
        "close": false,
        "closeOnMaskClick": false,
        "closeOnEscape": false,
        "dynamic": false,
        "height": 150,
        "fixedDimensions": true
      });


    }

    function closeDialog() {
      $('.jconfirm').remove();
    }
  });
</script>