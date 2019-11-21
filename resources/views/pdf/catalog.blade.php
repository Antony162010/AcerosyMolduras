<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" />
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../public/css/styles.css" rel="stylesheet">
    <link href="../public/css/pdf.css" rel="stylesheet">
</head>

<body>
    {{-- Primera página --}}
    <img src="../public/img/ci_1.png" class="img-fluid" alt="" />
    <div class="text-center">
        <p class="color-secondary fs-25"><b>Lista de Precios 2019</b></p>
        <p class="color-secondary fs-25">Precios no incluyen instalación | Precios no incluyen IGV</p>
    </div>

    <div class="page-break"></div>

    {{-- Segunda página --}}

    <nav class="navbar navbar-expand-lg navbar-light nav-style navbar-padding shadow">
        <span><img class="navbar-logo" src="../public/img/Aceros y molduras logo.png" /></span>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item text-right"> Productos </li>
        </ul>
    </nav>
    <br /><br /><br />
    <div class="row"></div>
    <img src="../public/img/ri_2.png" class="rounded">
    {{-- <img src="../public/img/ri_1.png" class="rounded"> --}}
    </div>

    <div class="page-break"></div>

    {{-- <main> --}}
    @foreach ($categories as $item)
    @if (sizeof($products[$item->idcategory]) > 0)
    {{-- Vista de una categoría --}}
    <p>{{$item->name}}</p>
    <img src="../public/img/{{strtolower($item->name)}}.png" class="card-img" alt="...">

    <div class="page-break"></div>

    <header><span><img class="navbar-logo" src="../public/img/Aceros y molduras logo.png" /></span></header>

    @foreach ($products[$item->idcategory] as $key => $elem)
    <div class="card mb-3" style="max-width: 650px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if ($elem->url == null)
                <img src="http://placehold.it/250" class="card-img" alt="...">
                @else
                <img src="../public/img/{{$elem->url}}" class="card-img" alt="...">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h6 class="card-title">{{$elem->mark}}&reg; {{$elem->code}}</h6>
                    <ul>
                        <li>
                            <p class="card-text">{{$elem->type}}</p>
                        </li>
                        <li>
                            <p class="card-text">{{$elem->model}}</p>
                        </li>
                    </ul>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
    @if (($key+1)%2 == 0 && array_key_exists($key+1,$products[$item->idcategory]))
    <div class="page-break"></div>
    @endif
    @endforeach

    <footer>Aceros y Molduras</footer>
    @endif
    @endforeach
    {{-- </main> --}}

</body>

</html>