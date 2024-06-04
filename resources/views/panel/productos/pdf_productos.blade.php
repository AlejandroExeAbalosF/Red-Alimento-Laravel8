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
    <h3 class="text-center"> Listado de Productos</h3>
    <table class="table table-striped w-100">
        <thead class="bg-primary text-center text-white">
            <tr>
                <th scope="col" class="text-uppercase">#</th>
                <th scope="col" class="text-uppercase">Nombre</th>
                <th scope="col" class="text-uppercase">Descripcion</th>
                <th scope="col" class="text-uppercase">Temporada</th>
                <th scope="col" class="text-uppercase">Categoria</th>
                </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($producto as $produ)
                <tr>
                    <td>{{ $produ->id}}</td>
                    <td>{{ $produ->nombre }}</td>
                    <td>{{ Str::limit($produ->descripcion, 30) }}</td> <!-- Corta el string a 30 caracteres -->
                    
                    @if ($produ->temporada == 'Activo')
                                <td>
                                    <span class="badge badge-pill badge-success">Activo <i class="fas fa-check"></i></span>
                                </td>
                            @else
                            <td>
                                <span class="badge badge-pill badge-danger">Inactivo <i class="fas fa-times"></i></span>
                            </td>
                            @endif

                    <td>{{ $produ->categoria->nombre}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
