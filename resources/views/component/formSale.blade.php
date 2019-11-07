<div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
    <form method="POST" action="{{ route($route) }}">
        {{ csrf_field() }}
        @if ( $type == 'update')
        {{ method_field('PUT') }}
        @endif
        <div class="row">
            <div class="form-group col-md-3">
                <label for="department">Departamento:</label>
                <div>
                    <select id="department" class="form-control" required>
                        <option selected hidden value="">Seleccione el departamento</option>
                        @foreach ($departments as $d)
                        <option @if ($type == 'info' && $d->iddepar == $sale->iddepar) selected @endif
                            value="{{ $d->iddepar }}">{{ $d->department }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="province">Provincia:</label>
                <div>
                    <select id="province" class="form-control" required>
                        <option selected hidden value="">Seleccione un departamento</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="district">Distrito:</label>
                <div>
                    <select id="district" name="district" class="form-control">
                        <option selected hidden value="">Seleccione un departamento</option>
                    </select>
                </div>
            </div>
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
        <button type="submit" class="btn btn-primary">Registrar producto</button>
    </form>
</div>