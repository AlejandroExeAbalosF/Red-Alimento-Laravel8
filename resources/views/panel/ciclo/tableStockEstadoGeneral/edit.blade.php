@extends('adminlte::page')
@section('title', 'Admin')

@section('content_header')
    <h1>Editar Producto Recibido al Nodo ...</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- <p class="h5">Nombre:</p>
            <p class="form-control">{{ $procesoCiclo }}</p> --}}
            <input type="hidden" value="{{$info->kg_x_cajon}}" id="kgXcajon">
            <h2 class="h5">Editar Cantida de producto Recibida en el Nodo Base</h2>
            <div class="col-sm-5">
                {!! Form::model($procesoCiclo, ['route' => ['proceso.ciclo.update', $procesoCiclo], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('nb_cantidad_pedido_recibido_menor','Cantida de '.$procesoCiclo->unidad_menor.' Recibida del Nodo Base') !!}
                    {!! Form::number('nb_cantidad_pedido_recibido_menor', null, ['class'=>'form-control','step'=>'0.01']) !!}
                    
                    @error('nb_cantidad_pedido_recibido_menor')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('nb_cantidad_pedido_recibido_mayor','Cantida de '.$procesoCiclo->unidad_mayor.' Recibida del Nodo Base') !!}
                    {!! Form::number('nb_cantidad_pedido_recibido_mayor', null, ['class'=>'form-control']) !!}
                    
                    @error('nb_cantidad_pedido_recibido_mayor')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    {!! Form::label('nb_fecha_pedido_recibido','Ingrese la Fecha') !!}                    
                    {!! Form::date('nb_fecha_pedido_recibido', null, ['class'=>'form-control']) !!}
                    
                    @error('nb_fecha_pedido_recibido')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div> --}}
                {{-- <div class="form-group">
                    {!! Form::label('stock_pedido_menor','Cantida de unidad minima Recibida del Nodo Distribuidor') !!}
                    {!! Form::number('stock_pedido_menor', null, ['class'=>'form-control']) !!}

                    @error('stock_pedido_menor')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div> --}}

                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!} 
            </div>
            
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        // $(document).on('input', '#cantidadV', validarCant);
        document.getElementById('nb_cantidad_pedido_recibido_mayor').addEventListener('input', function(e) {
            let kgXcajon = document.getElementById("kgXcajon").value;
            // console.log(kgXcajon);
            document.getElementById("nb_cantidad_pedido_recibido_menor").value=parseFloat(e.srcElement.value) * parseFloat(kgXcajon)
        })
    </script>
@stop
