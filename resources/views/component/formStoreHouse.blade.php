<div class="container card bg-light space-div">
    <form method="POST" @if ( $type=='update' ) action="{{ route($route,$routeId) }}" @else action="{{ route($route) }}"
        @endif>
        {{ csrf_field() }}
        @if ( $type == 'update')
        {{ method_field('PUT') }}
        @endif

        <div class="form-group">
            <label for="id_warehouse">Almacén:</label>
            @if ($type=='update')
            <input type="text" class="form-control" id="id_warehouse" value="{{ $warehouse->idstore_house }}"
                name="id-warehouse" hidden required>
            <input type="text" class="form-control" value="{{ $warehouse->name }}" required disabled>
            @else
            <select class="custom-select" id="id_warehouse" name="id-warehouse" required>
                <option selected hidden value="">Seleccione uno...</option>
                @foreach ($warehouses as $item)
                <option value="{{$item->idstore_house}}">{{$item->name}}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="form-group">
            <label for="id_product">Productos disponibles:</label>
            @if ($type=='update')
            <input type="text" class="form-control" id="id_product" value="{{ $warehouse->code }}" name="id-product"
                hidden required>
            <input type="text" class="form-control"
                value="{{ $warehouse->code.' - '.$warehouse->mark.' - '.$warehouse->model }}" required disabled>
            @else
            <select class="custom-select" id="id_product" name="id-product" required>
                <option selected hidden value="">Seleccione uno...</option>
            </select>
            @endif
        </div>
        <div class="form-group">
            <label for="boxes_quantity">Cantidad: (en cajas)</label>
            <input type="number" min="0" class="form-control" id="boxes_quantity" @if ($type=='update' )
                value="{{ $warehouse->boxes_quantity }}" @else value="{{old('boxes-quantity')}}" @endif
                name="boxes-quantity" placeholder="20">
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif

        @if ( $type == 'update')
        <button type="submit" class="btn btn-primary">Actualizar</button>
        @elseif ( $type == 'insert')
        <button type="submit" class="btn btn-primary">Añadir</button>
        @endif
    </form>
</div>