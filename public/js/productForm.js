//Obtener productos disponibles por almacén
$(document).on('change', '#department', function () {
    $('#province').html('');
    $('#district').html('<option selected value="">Seleccione una provincia</option>');
    $.ajax({
        type: "POST",
        url: "./provinces",
        data: {
            idDepartment: $('#department').val()
        },
        dataType: "json",
        success: function (response) {
            response.forEach(p => {
                $('#province').append(`<option value='${p.idProv}'>${p.name}</option>`);
            });
        }
    });
});

$(document).on('change', '#province', function () {
    $('#district').html('');
    $.ajax({
        type: "POST",
        url: "./districts",
        data: {
            idProvince: $('#province').val()
        },
        dataType: "json",
        success: function (response) {
            response.forEach(d => {
                $('#district').append(`<option value='${d.iddistrict}'>${d.name}</option>`);
            });
        }
    });
});