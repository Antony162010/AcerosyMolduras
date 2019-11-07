<div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
    <form method="POST" action="{{ route($route) }}">
        {{ csrf_field() }}
        @if ( $type == 'update')
        {{ method_field('PUT') }}
        @endif
        <div class="row">
            <div class="form-group col-md-5">
                <label for="cod_product">Código del producto:</label>
                <input type="text" name="cod-product" class="form-control" id="cod_product" @if($type=='update' )
                    value="{{$product->code}}" @else value="{{old('cod-product')}}" @endif
                    placeholder="Ingrese el código del producto" required readonly>
            </div>
            <div class="form-group col-md-7">
                <label for="category_product">Categoría:</label>
                <div>
                    <select name="category-product" class="form-control" required>
                        <option selected hidden value="">Seleccione una categoría</option>
                        @foreach ($categories as $c)
                        <option @if ($c->idcategory == $product->category_idcategory) selected @endif
                            value="{{ $c->idcategory }}">{{ $c->name }}</option>
                        @endforeach
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