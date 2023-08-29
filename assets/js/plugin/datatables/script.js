// Code goes here

$(document).ready(function(){

  table =  $('#example').DataTable( {
      responsive: true,
      fixedColumns: true,
      dom: 'Bfrtip',
      buttons: [ {
        extend:'colvis',
        collectionLayout:'fixed three-column',
        text:'<i class="fa fa-download"></i> Andrana',
        columns:':gt(0)'
    },{
        className: 'btn btn-info',
        text: '<i class="fa fa-copy"></i> copy',
       extend:'copy',
              exportOptions: {
              modifier: {
              page: 'all',
              search: 'none'   
            }
         },dom:{
          button:{
              tag:"a",
              className:"btn btn-primary"
          },
          buttonLiner: {
              tag: null
          }
      }
      },{
        className: 'green',
        text: 'Data print',
        extend:'pdf',
        exportOptions: {
               modifier: {
                  page: 'all',
                    search: 'none'   
                   }
              },
                   
      },{
        className: 'yellow',
        text: 'Data print',
        extend:'excel',
        exportOptions: {
               modifier: {
                  page: 'all',
                    search: 'none'   
                   }
              },
                   
      },{
        className: 'blue',
        text: 'Data print',
        extend:'print',
        exportOptions: {
               modifier: {
                  page: 'all',
                    search: 'none'   
                   }
              },
                   
      }]
      
  } );
 
  //table.button(2).active(true);
  
  $('#btn-export').on('click', function(){
    console.log(table.$('tr').clone());
      $('<table>').append(table.$('tr').clone()).table2excel({
          exclude: ".excludeThisClass",
          name: "Worksheet Name",
          filename: "SomeFile" //do not include extension
      });
  });      
})
