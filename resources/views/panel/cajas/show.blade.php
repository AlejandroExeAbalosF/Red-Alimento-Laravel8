@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
    
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>Datos de la Caja Nº {{ $caja->id }}</h1>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">    
                            <p>Fecha de Apertura: <b>{{ $caja->fecha_hora_cierre }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Fecha de Cierre: <b>{{ $caja->fecha_hora_cierre }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Monto Inicial: <b>${{ $caja->monto_inicial }}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Total de las Ventas: <b>${{ $caja->total_ventas}}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Total de las Compras: <b>${{ $caja->total_compras}}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Faltante: <b>${{ $caja->faltante}}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Sobrante: <b>${{ $caja->sobrante}}</b></p>
                        </div>
                        <div class="mb-3">
                            <p>Monto Final: <b>${{ $caja->monto_final }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Usuario: <b>{{ $caja->usuario->name }}</b></p>
                        </div>
                        <div class="mb-3" style="text-align: center">
                            <a href="{{ route('panel.cajas.index') }}" class="btn btn-sm btn-info text-uppercase">
                                Volver al Listado
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script> console.log('Hi!'); </script>
@stop
