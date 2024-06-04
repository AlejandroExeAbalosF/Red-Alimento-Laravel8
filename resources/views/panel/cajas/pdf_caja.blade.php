<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title></title>
</head>
<body>
    <h3 class="text-center"> Caja de {{ auth()->user()->name }}</h3>
    <table class="table table-striped w-100">
        <thead class="bg-primary text-center text-white">
            <tr>
                <th scope="col" class="text-uppercase">#</th>
                <th scope="col" class="text-uppercase">Monto Inicial</th>
                <th scope="col" class="text-uppercase">Total Ventas</th>
                <th scope="col" class="text-uppercase">Total compras</th>
                <th scope="col" class="text-uppercase">Monto Final</th>
                <th scope="col" class="text-uppercase">Estado</th>
                </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($caja as $caj)
                <tr>
                    <td>{{ $caj->id}}</td>
                    <td>{{ $caj->monto_inicial }}</td>
                    <td>{{ $caj->total_ventas }}</td>
                    <td>{{ $caj->total_compras}}</td>
                    <td>{{ $caj->monto_final}}</td>
                    @if ($caj->estado == 1)
                        <td>
                            <span class="badge badge-pill badge-success">ABIERTA <i class="fas fa-check"></i></span>
                        </td>
                    @else
                        <td>
                            <span class="badge badge-pill badge-danger">Cerrada <i class="fas fa-times"></i></span>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
            
