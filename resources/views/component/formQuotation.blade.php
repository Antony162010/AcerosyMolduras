<div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="department">Fecha:</label>
                <input type="date" class="form-control" value="{{$quotation['date']}}" disabled>
            </div>
        </div>
        <h4>Productos</h4>
        <table id="table_sale_products" class="table table-striped">
            <thead class="table-style">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Producto</th>
                    <th scope="col" class="text-center">Cantidad</th>
                    <th scope="col" class="text-center">Precio unit.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <th scope="row" class="text-center">{{$p->product_code}}</th>
                    <td class="text-center">{{$p->mark}} - {{$p->model}}</td>
                    <td class="text-center">{{$p->quantity}}</td>
                    <td class="text-center">S/. {{$p->price}}.00</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="total">Total:</label>
                <input type="text" step="any" class="form-control" value="S/. {{$quotation['total-price']}}" disabled>
            </div>
        </div>
    </form>
</div>