

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css"rel="stylesheet" type="text/css"/>

<script src="https://code.jquery.com/jquery-1.12.4.js" ></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js" ></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js" ></script>
<script>

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>        