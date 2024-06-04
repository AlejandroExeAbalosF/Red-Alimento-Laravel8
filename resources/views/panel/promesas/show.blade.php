@extends('adminlte::page')
@section('title', 'Ver')
@section('content_header')
    
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>Armado de precio</h1>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">    
                            <p>Nodo Base: <b>{{ $promesa->nodoBase->nombre }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Nodo Distribuidor: <b>{{ $promesa->nodoDistribuidor->nombre }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Producto: <b>{{ $promesa->producto->nombre }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Proveedor: <b>{{ $promesa->proveedor->nombre." ".$promesa->proveedor->apellido}}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Fecha Limite: <b>{{ $promesa->fecha_limite_promesa }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Precio p/venta x kg: <b>{{ $promesa->precio_final }}</b></p>
                        </div>
                        <div class="mb-3">    
                            <p>Precio p/venta x cajon: <b>{{ $promesa->precio_final2 }}</b></p>
                        </div>
                        <div class="mb-3" style="text-align: center">
                            <a href="{{ route('panel.promesas.index') }}" class="btn btn-sm btn-info text-uppercase">
                                Volver al Listado
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
