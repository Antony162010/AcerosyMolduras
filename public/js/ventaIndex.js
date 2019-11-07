/*Data Table configuration on page load*/

var config = {
    "order": [[0, "asc"]],
    "responsive": "true",
    "dom": "<'row'<'col-sm col-md-4 m-b-8'B><'col-sm col-md-4'l><'col-sm-12 col-md-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

    "buttons": [
        {
            "text": "Registar nueva venta",
            "attr": {
                class: "btn btn-primary",
                onclick: "window.location='./sale/create'"
            }
        }
    ],

    "language": {
        "emptyTable": "No hay registros",
        "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "infoPostFix": "",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron registros",
        "paginate": {
            "first": "«",
            "previous": "‹",
            "next": "›",
            "last": "»"
        }
    },

    "lengthMenu": [10, 20, 30, 50]

}

$(document).ready(function () {
    $('#table_sale').DataTable(config);
});