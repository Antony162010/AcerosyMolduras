@extends('layout.app')

<body class="product-background">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div> {{-- Separador --}}
                <div class="col-md-6 m-b-40 m-t-40">
                    <div>
                        <div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
                            <h2>Registro de productos</h2>
                            <br>
                            <form method="POST" action="{{ url('/enterproduct')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="cod_product">Código del producto:</label>
                                    <input type="text" name="cod-product" class="form-control" id="cod_product"
                                        placeholder="Ingrese el código del producto" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="price_product">Precio:</label>
                                    <input type="text" name="price-product" class="form-control" id="price_product"
                                        placeholder="Ingrese precio base" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="brand_product">Marca:</label>
                                    <input type="text" name="brand-product" class="form-control" id="brand_product"
                                        placeholder="Ingrese marca del producto" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="model_product">Modelo:</label>
                                    <input type="text" name="model-product" class="form-control" id="model_product"
                                        placeholder="Ingrese modelo del producto" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-product">Registrar producto</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div> {{-- Separador --}}
            </div>
        </div>
    
    <br><br>
</body>
