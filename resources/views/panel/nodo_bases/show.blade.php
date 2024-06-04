@extends('adminlte::page')
@section('title', 'Ver')
@section('content_header')
    
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>Datos del Nodo Base: {{$nodoBase->nombre }}</h1>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">    
                            <p>Nombre: <b>{{ $nodoBase->nombre }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Email: <b>{{ $nodoBase->email }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Direccion: <b>{{ $nodoBase->direccion }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Provincia: <b>{{ $nodoBase->provincia }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Celular: <b>{{ $nodoBase->celular }}</b></p>
                        </div>
                        <div class="mb-3" style="text-align: center">
                            <a href="{{ route('panel.nodo_bases.index') }}" class="btn btn-sm btn-info text-uppercase">
                                Volver al Listado
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
