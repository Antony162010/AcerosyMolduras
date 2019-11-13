<div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
    <form method="POST" @if ($type=='insert' )action="{{ route($route) }}" @endif>
        {{ csrf_field() }}
        @if ( $type == 'update')
        {{ method_field('PUT') }}
        @endif
        <div class="row">
            <div class="form-group col-md-3">
                <label for="provider">Proveedor:</label>
                <div>
                    <select id="provider" name="provider"  class="form-control" required @if ($type=='info' ) disabled @endif>
                        <option selected hidden value="">Seleccione el Proveedor</option>
                        @foreach ($providers as $p)
                        <option @if ($type=='info' && $p->idprovider == $buy['provider']) selected @endif
                            value="{{ $p->idprovider }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>

        @if ($type=='insert')
        <button type="button" id="add_product" class="btn btn-primary">Añadir producto</button>
        <br>
        <div class="products"></div>
        <br>
        <button type="submit" class="btn btn-primary">Registrar compra</button>
        @else
        <div class="row">
            <div class="form-group col-md-3">
                <label for="department">Fecha:</label>
                <input type="date" class="form-control" value="{{$buy['date']}}" disabled>
            </div>
        </div>
        <h4>Productos</h4>
        <table id="table_sale_products" class="table table-striped">
            <thead class="table-style">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio(S/)</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Importe(S/)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <th scope="row">{{$p->idbuy}}</th>
                    <td>{{$p->mark}} - {{$p->model}}</td>
                    <td>{{$p->price}}</td>
                    <td>{{$p->quantity}}</td>
                    <td>S/{{$p->amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="total">Total:</label>
                <input type="number" class="form-control" value="{{$buy['total']}}" disabled>
            </div>
        </div>
        @endif
    </form>
</div>