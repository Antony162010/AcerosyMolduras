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
    
    {{-- Siguientes --}}
    @foreach ($products as $item)
    {{-- @if (sizeof($item)>0) --}}
    @foreach ($item as $i)
    {{$i->model}}
    {{$i->name}}
    
    @endforeach
    <div class="page-break"></div>
    {{-- @endif --}}
    @endforeach
    <header><span><img class="navbar-logo" src="../public/img/Aceros y molduras logo.png" /></span></header>

    <footer>footer on each page</footer>
</body>

</html>