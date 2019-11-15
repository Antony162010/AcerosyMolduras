var products = [];
var productsOptions = '';
$(document).ready(function () {
    $('#add_product').attr('disabled', true);
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "./products",
        success: function (result) {
            products = result;
            
            if (result.length > 0) {
                var pro = '';
                
                result.forEach(r => {
                    pro += `<option value="${r.code}">${r.code} - ${r.name} - ${r.model}</option>`;
                });
                
                productsOptions = pro;
            }
            $('#add_product').attr('disabled', false);
        }
    });
});

$(document).on('click', '#add_product', function () {
    $(".products").append(`
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Producto</label>
                <select class="form-control products_select" id="cod_product"
                    name="idproduct[]" required>
                    ${productsOptions}
                </select>
            </div>
            <div class="form-group col-md-4"></div>
            <div class="form-group col-md-4"></div>
        </div>
    `);
});