@extends('adminlte::page')
@section('content_header')
<h1>SUMAK kAUSAY</h1>
@stop
@section('content')

    
    <table class="table">
        <thead class="thead-dark">
          <h4>Historial de Pedidos</h4>
          <tr>
            <th scope="col">Id Pedido</th>
            <th scope="col">Dodo D</th>
            <th scope="col">Productos</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">3</th>
            <td>oscar</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
         
        </tbody>
      </table>
      
     

@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script> console.log('Hi!'); </script>
@stop
