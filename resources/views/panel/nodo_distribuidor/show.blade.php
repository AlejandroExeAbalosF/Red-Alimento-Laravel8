@extends('adminlte::page')
@section('title', 'Ver')
@section('content_header')
    
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>Datos del Nodo Base: {{$nodoDistribuidor->nombre }}</h1>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">    
                            <p>Nombre: <b>{{ $nodoDistribuidor->nombre }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Email: <b>{{ $nodoDistribuidor->email }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Direccion: <b>{{ $nodoDistribuidor->direccion }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Provincia: <b>{{ $nodoDistribuidor->provincia }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Celular: <b>{{ $nodoDistribuidor->celular }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Zona: <b>{{ $nodoDistribuidor->zona }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Nodo Base: <b>{{ $nodoDistribuidor->nodoBase->nombre }}</b></p>
                        </div>
                        <div class="mb-3" style="text-align: center">
                            <a href="{{ route('panel.nodo_distribuidor.index') }}" class="btn btn-sm btn-info text-uppercase">
                                Volver al Listado
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
