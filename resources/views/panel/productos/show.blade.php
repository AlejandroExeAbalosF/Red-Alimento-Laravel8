@extends('adminlte::page')
@section('title', 'Ver')
@section('content_header')
    
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>Datos del Producto: {{$producto->nombre }}</h1>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">    
                            <p>Descripcion: <b>{{ $producto->descripcion }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Categoria: <b>{{ $producto->categoria->nombre }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Imagen:</p>
                            <img src="{{$producto->imagen}}" width="20%">
                        </div>
                        <div class="mb-3" style="text-align: center">
                            <a href="{{ route('panel.productos.index') }}" class="btn btn-sm btn-info text-uppercase">
                                Volver al Listado
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
