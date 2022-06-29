
   // for date
   
   var minDate, maxDate;
    
   // Custom filtering function which will search data in column four between two values
   $.fn.dataTable.ext.search.push(
       function( settings, data, dataIndex ) {
           var min = minDate.val();
           var max = maxDate.val();
           var date = new Date( data[1] );
   
    
           if (
               ( min === null && max === null ) ||
               ( min === null && date <= max ) ||
               ( min <= date   && max === null ) ||
               ( min <= date   && date <= max )
           ) {
               return true;
           }
           return false;
       }
   );
   
   
   // for date filter
   
   
   $(document).ready(function() {
       // Create date inputs
       minDate = new DateTime($('#min'), {
           format: 'YYYY-MM-DD'
       });
       maxDate = new DateTime($('#max'), {
           format: 'YYYY-MM-DD'
       });
    
       // DataTables initialisation
       var table = $('#expenses_table').DataTable(
           {
           dom: 'Bfrtip',
           buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 1, 2, 3,4,5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 1, 2, 3,4,5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1, 2, 3,4,5 ]
                }
            },

               
               
           ],
         orderCellsTop: true,
       initComplete: function () {
               this.api().columns( [4] ).every( function () {
                   var column = this;
                   var select = $('<select class="form-control"><option value="">All</option></select>')
                        .appendTo(  $('thead tr:eq(1) th:eq(' + this.index()  + ')') )
                       .on( 'change', function () {
                           var val = $.fn.dataTable.util.escapeRegex(
                               $(this).val()
                           );
    
                           column
                                .search(val ? '^' + val + '$' : '', true, false)
                               .draw();
                       } );
    
                   column.data().unique().sort().each( function ( d, j ) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                   } );
               } );
           }
       
       
       
       }
       );
    
       // Refilter the table
       $('#min, #max').on('change', function () {
           table.draw();
       });
   });

   