//Obtener productos disponibles por almacén
$(document).on('change', '#id_warehouse', function () {
    $.ajax({
        type: "POST",
        url: "./products",
        data: {
            idWarehouse: $('#id_warehouse').val()
        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            response.forEach(p => {
                $('#id_product').append(`<option value='${p.code}'>${p.mark} - ${p.model}</option>`);
            });
        }
    });
});