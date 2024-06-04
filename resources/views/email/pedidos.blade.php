<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

   
    @if ($use=$user[2]->id)
        
        <h1>sumak kawsay</h1>
        <p>su pedido a sido realizado con exito!</p>
        <p>podra ser retirado el dia: -------   </p>
        <h6> {{$user[2]->name}} gracias por su compra!!</h6>

    @endif
    
</body>
</html>