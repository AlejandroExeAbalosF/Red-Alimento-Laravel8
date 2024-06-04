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
    <h3 class="text-center"> Listado de Nodo Distribuidor</h3>
    <table class="table table-striped w-100">
        <thead class="bg-primary text-center text-white">
            <tr>
                <th scope="col" class="text-uppercase">#</th>
                <th scope="col" class="text-uppercase">Nombre</th>
                <th scope="col" class="text-uppercase">Email</th>
                <th scope="col" class="text-uppercase">Direccion</th>
                <th scope="col" class="text-uppercase">Nodo Base</th>
                <th scope="col" class="text-uppercase">Celular</th>
                </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($nodoDistribuidor as $nodoD)
                <tr>
                    <td>{{ $nodoD->id}}</td>
                    <td>{{ $nodoD->nombre }}</td>
                    <td>{{ $nodoD->email }}</td> <!-- Corta el string a 30 caracteres -->
                    <td>{{ $nodoD->direccion}}</td>
                    <td>{{ $nodoD->nodoBase->nombre}}</td>
                    <td>{{ $nodoD->celular}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
            