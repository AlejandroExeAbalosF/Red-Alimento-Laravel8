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
    <h3 class="text-center"> Listado de Armado de Precio</h3>
    <table class="table table-striped w-100">
        <thead class="bg-primary text-center text-white">
            <tr>
                <th scope="col" class="text-uppercase">#</th>
                <th scope="col" class="text-uppercase">Fecha Limite</th>
                <th scope="col" class="text-uppercase">Precio x kg</th>
                <th scope="col" class="text-uppercase">Precio Final p/venta</th>
                <th scope="col" class="text-uppercase">Precio x cajon</th>
                <th scope="col" class="text-uppercase">Producto</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($promesa as $prome)
                <tr>
                        <td>{{$prome->id}}</td>
                        <td>{{$prome->fecha_limite_promesa}}</td>
                        <td>{{$prome->precio_x_kg}}</td>
                        <td>{{$prome->precio_final}}</td>
                        <td>{{$prome->precio_final2}}</td>
                        <td>{{$prome->producto->nombre}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
