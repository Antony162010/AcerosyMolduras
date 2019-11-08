<div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
    <form method="POST" @if ($type=='insert' )action="{{ route($route) }}" @endif>
        {{ csrf_field() }}
        @if ( $type == 'update')
        {{ method_field('PUT') }}
        @endif
        <div class="row">
            <div class="form-group col-md-3">
                <label for="department">Departamento:</label>
                <div>
                    <select id="department" class="form-control" required @if ($type=='info' ) disabled @endif>
                        <option selected hidden value="">Seleccione el departamento</option>
                        @foreach ($departments as $d)
                        <option @if ($type=='info' && $d->iddepar == $sale['department']) selected @endif
                            value="{{ $d->iddepar }}">{{ $d->department }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="province">Provincia:</label>
                <div>
                    <select id="province" class="form-control" required @if ($type=='info' ) disabled @endif>
                        <option selected hidden value="">Seleccione un departamento</option>
                        @if ($type == 'info' )<option selected value="{{$sale['idProv']}}">{{$sale['province']}}
                        </option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="district">Distrito:</label>
                <div>
                    <select id="district" name="district" class="form-control" @if ($type=='info' ) disabled @endif>
                        <option selected hidden value="">Seleccione un departamento</option>
                        @if ($type == 'info' ) <option selected value="{{$sale['iddistrict']}}">{{$sale['district']}}
                        </option>
                        @endif
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
        <button type="submit" class="btn btn-primary">Registrar venta</button>
        @else
        <div class="row">
            <div class="form-group col-md-3">
                <label for="department">Fecha:</label>
                <input type="date" class="form-control" value="{{$sale['date']}}" disabled>
            </div>
        </div>
        <h4>Productos</h4>
        <table id="table_sale_products" class="table table-striped">
            <thead class="table-style">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <th scope="row">{{$p->product_code}}</th>
                    <td>{{$p->mark}} - {{$p->model}}</td>
                    <td>{{$p->quantity}}</td>
                    <td>S/{{$p->price}}.00</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </form>
</div>