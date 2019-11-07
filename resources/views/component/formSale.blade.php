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
        
        <button type="button" id="add_product" class="btn btn-primary">Añadir producto</button>
        <br>
        <div class="products"></div>
        <br>
        <button type="submit" class="btn btn-primary">Registrar venta</button>
    </form>
</div>