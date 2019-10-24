<div class="container card bg-light space-div">
    <form  method="POST" action="{{ route($route,$routeid) }}">
        @csrf
        @if ( $type == 'update')
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="code-book">Código del libro</label>
            @if ( $type == 'update')
                <input type="text" class="form-control" name="code-book" id="code-book" placeholder="" value="{{ $book->CODLIBRO }}">
            @else
                <input type="text" class="form-control" name="code-book" id="code-book" placeholder="">
            @endif
        </div>
        <div class="form-group">
            <label for="name-book">Nombre del libro</label>
            @if ( $type == 'update' )
                <input type="text" class="form-control" name="name-book" id="name-book" placeholder="" value="{{ $book->DESCRIPCION}}">
            @else
                <input type="text" class="form-control" name="name-book" id="name-book" placeholder="">
            @endif
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
