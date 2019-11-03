<div class="container card bg-light space-div">
    <form method="POST" action="{{ route($route,$routeid) }}">
        {{ csrf_field() }}
        @if ( $type == 'update')
        @method('PUT')
        @endif

        <div class="form-group">
            <label for="id-warehouse">Almacén:</label>
            {{-- <input type="text" class="form-control" id="id_warehouse" @if ( $type=='update' )value="{{ $book->CODLIBRO }}"
                @else value="{{old('id-warehouse')}}" @endif name="id-warehouse" placeholder="">

        </div>
        <div class="form-group"> --}}
            <select class="custom-select" id="inputGroupSelect01">
              <option value="1" selected>Almácen COLONIAL</option>
            </select>
          </div>
        <div class="form-group">
            <label for="ip-product">Producto:</label>
            <input type="text" class="form-control" id="id_product" @if ( $type=='update' )value="{{ $book->CODLIBRO }}"
                @else value="{{old('ip-product')}}" @endif name="ip-product" placeholder="">
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
        <button type="submit" class="btn btn-primary">Registrar</button>
        @endif
    </form>
</div>