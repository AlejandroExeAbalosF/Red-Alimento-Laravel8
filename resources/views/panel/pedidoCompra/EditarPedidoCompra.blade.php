@extends('adminlte::page')
@section('title', 'Editar pedido de compra')
@section('content_header')
    <h1>Editar Compra del Pedido:</h1>
@stop
@section('content')

    <div class="card">
        <div class="card-body">
      
             <form action="{{route('filaU',$consul[0])}}" method="post">  
    
             @csrf
             @method('put')
            <label for="">Nombre del Producto</label>  
             <input type="text" class="form-control" name="nombrepro" readonly value="{{$consul[0]->namep}}"> 

            <label for="">Nombre del Proveedor</label> 
            <input type="text" class="form-control" name="nombreprov" readonly value="{{$consul[0]->nameprov}}">

            <label for="">Estado del Pedio</label> 
            <input type="text" class="form-control" name="estado_pedido_compra" value="{{$consul[0]->estado_pedido_compra}}">

            <label for="">Fecha que fue Efectuado el Pedido</label> 
            <input type="date" class="form-control" name="fecha-pedido"  readonly value="{{$consul[0]->realizado_pedido_compra}}">

            <label for="">Fecha de llegada del pedido</label>    
            <input type="date" class="form-control" name="llegada_pedido_compra" value="{{$consul[0]->llegada_pedido_compra}}">

            <label for="">Nodo Distribuidor</label> 
            <input type="text" name="nodoDis" class="form-control" readonly value="{{$consul[0]->namend}}">


                   
        </div>

                <div style="text-align: center">
                   <button type="submit" class='btn btn-success col-3'>Actualizar</button>
                    <a href="{{route('pedido.compra.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
@stop


{{-- {{ $consul}} 

    {!! Form::model($consul, ['method'=>'put', 'route' => ['filaU', $consul]]) !!}
    <div class="form-group">
      <label for="">Nombre del Producto</label>  
      <input type="text" class="form-control" name="nombrepro" readonly value="{{$consul->ciclo_id}}" placeholder="Nombre del producto">

      <label for="">Nombre del Proveedor</label> 
      <input type="text" class="form-control" name="nombreprov" value="" placeholder="Nombre del proveedor">

      <label for="">Nodo Distribuidor</label>         <select name="estado" id="">
                                                      <option value="">Elegir</option>
                                                      <option value="">vaqueros</option>
                                                      <option value="">tre cerritos</option></select><br> 

      <label for="">Stok prometido mayor</label> 
      <input type="num" class="form-control" name="stock-prometido" value="">

      <label for="">Fecha de llegada del pedido</label>    
      <input type="date" class="form-control" name="fecha-llegada" value="">
      
    </div>
      <div style="text-align: center">
        {!! Form::submit('Actualizar', ['class'=>'btn btn-success col-3']) !!}
         <a href="{{route('pedido.compra.index')}}" class="btn btn-danger col-3">Cancelar</a> 
      </div>
          {!! Form::close() !!}
      </div>
    </div> --}}



           