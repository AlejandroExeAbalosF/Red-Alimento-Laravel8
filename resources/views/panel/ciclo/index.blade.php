@extends('adminlte::page')
@section('title', 'Admin')

@section('content_header')
    <h1>Iniciar Nuevo Ciclo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('proceso.ciclo.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-sm-5">                      
    
                        <div class="form-group">
                            <label>Ingresar Fecha y hora limite de retirada para los clientes </label>
                            <input type="datetime-local" id="_esperado" name="datetime" class="form-control input-sm">
                        </div>
                        <input type="submit" class="btn btn-success" id="_btnIniciarCiclo" value="Iniciar Ciclo">
                    </div>
                </div>
            </form>

        </div>
    </div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop