<div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
    <form method="POST" enctype="multipart/form-data" @if ($type=='insert' or $type=='update'
        )action="{{ route($route) }}" @endif>
        {{ csrf_field() }}
        @if ( $type == 'update')
        {{ method_field('PUT') }}
        @endif
        <div class="row">
            <div class="form-group col-md-5">
                <label for="cod_product">Código del producto:</label>
                <input type="text" name="cod-product" class="form-control" id="cod_product" @if($type=='update' )
                    value="{{$product->code}}" readonly @elseif($type=='info' ) value="{{$product->code}}" readonly
                    @else value="{{old('cod-product')}}" @endif placeholder="Ingrese el código del producto" required>
            </div>
            <div class="form-group col-md-7">
                <label for="category_product">Categoría:</label>
                <div>
                    <select name="category-product" class="form-control" required @if ($type=='info' ) disabled @endif>
                        <option selected hidden value="">Seleccione una categoría</option>
                        @foreach ($categories as $c)
                        <option @if (($type=='update' or $type=='info' ) && $c->idcategory ==
                            $product->category_idcategory) selected @endif
                            value="{{ $c->idcategory }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="model_product">Modelo:</label>
                <input type="text" name="model-product" class="form-control" id="model_product" @if($type=='update' or
                    $type=='info' ) value="{{$product->model}}" readonly @else value="{{old('model-product')}}" @endif
                    placeholder="Ingrese modelo del producto" required>
            </div>
            <br>
            <div class="form-group col-md-6">
                <label for="brand_product">Marca:</label>
                <input type="text" name="brand-product" class="form-control" id="brand_product" @if($type=='update' or
                    $type=='info' ) value="{{$product->mark}}" readonly @else value="{{old('brand-product')}}" @endif
                    placeholder="Ingrese marca del producto" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="price_product">Precio:</label>
                <input type="number" min="0" name="price-product" class="form-control" id="price_product"
                    @if($type=='update' ) value="{{$product->price}}" @elseif($type=='info' )
                    value="{{$product->price}}" readonly @else value="{{old('price-product')}}" @endif
                    placeholder="Ingrese precio base" required>
            </div>
            <div class="form-group col-md-6">
                <label for="lenght_product">Longitud(mm):</label>
                <input type="number" step="0.01" min="0" name="lenght-product" class="form-control" id="lenght_product"
                    @if($type=='update' ) value="{{$product->lenght}}" @elseif($type=='info' )
                    value="{{$product->lenght}}" readonly @else value="{{old('lenght-product')}}" @endif
                    placeholder="Ingrese longitud" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="hight_product">Altura(mm):</label>
                <input type="number" step="0.01" min="0" name="hight-product" class="form-control" id="hight_product"
                    @if($type=='update' ) value="{{$product->hight}}" @elseif($type=='info' )
                    value="{{$product->hight}}" readonly @else value="{{old('hight-product')}}" @endif
                    placeholder="Ingrese altura" required>
            </div>
            <div class="form-group col-md-6">
                <label for="widht_product">Ancho(mm):</label>
                <input type="number" step="0.01" min="0" name="widht-product" class="form-control" id="widht_product"
                    @if($type=='update' ) value="{{$product->widht}}" @elseif($type=='info' )
                    value="{{$product->widht}}" readonly @else value="{{old('widht-product')}}" @endif
                    placeholder="Ingrese Ancho" required>
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label><i class="fas fa-image"></i> Imagen del libro </label>
                <br />
                <input type="file" id="image_product" onchange="readURL(this)" name="image-product"
                    accept="image/x-png,image/jpeg" @if ( $type=='insert' ) required @endif>
                <label for="image_product"><img id="blah" style="max-width:180px;" alt="your image" @if (
                        $type!='insert' ) @if($product->url == null) src="http://placehold.it/180" @else
                    src="{{ asset('img/'.$product->url)}}" @endif @else src="http://placehold.it/180"
                    @endif/></label>
            </div>

        </div>
        @if($type=='update' )
        <button type="submit" class="btn btn-primary">
            Actualizar producto
        </button>
        @elseif($type == 'insert')
        <button type="submit" class="btn btn-primary">
            Registrar producto
        </button>
        @endif
    </form>
</div>