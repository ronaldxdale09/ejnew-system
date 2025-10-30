 // for date

 var minDate, maxDate;

 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function(settings, data, dataIndex) {
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date(data[0]);


         if (
             (min === null && max === null) ||
             (min === null && date <= max) ||
             (min <= date && max === null) ||
             (min <= date && date <= max)
         ) {
             return true;
         }
         return false;
     }
 );


 // for date filter


 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#p_min'), {
         format: 'YYYY-MM-DD'
     });
     maxDate = new DateTime($('#p_max'), {
         format: 'YYYY-MM-DD'
     });

     // DataTables initialisation
     var table = $('#seller_copraTransaction').DataTable({
         "pageLength": 5,

         dom: 'Bfrtip',
         buttons: [{
                 extend: 'excelHtml5',
                 exportOptions: {
                     columns: [1, 2, 3, 4, 5]
                 }
             },
             {
                 extend: 'pdfHtml5',
                 exportOptions: {
                     columns: [1, 2, 3, 4, 5]
                 }
             },
             {
                 extend: 'print',
                 exportOptions: {
                     columns: [1, 2, 3, 4, 5]
                 }
             },



         ],
         orderCellsTop: true,



     });

     // Refilter the table
     $('#p_min, #p_max').on('change', function() {
         purchase_table.draw();
     });
 });