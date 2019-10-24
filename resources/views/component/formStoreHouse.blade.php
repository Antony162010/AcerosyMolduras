<div class="container card bg-light space-div">
    <form method="POST" action="{{ route($route,$routeid) }}">
        {{ csrf_field() }}
        @if ( $type == 'update')
        @method('PUT')
        @endif

        <div class="form-group">
            <label for="code-book">Código del libro:</label>
            <input type="text" class="form-control" id="code_book" @if ( $type=='update' )value="{{ $book->CODLIBRO }}"
                @else value="{{old('code-book')}}" @endif name="code-book" placeholder="">

        </div>
        <div class="form-group">
            <label for="name-book">Nombre del libro:</label>
            <input type="text" class="form-control" id="name_book" @if ( $type=='update' )value="{{ $book->CODLIBRO }}"
                @else value="{{old('name-book')}}" @endif name="name-book" placeholder="">
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