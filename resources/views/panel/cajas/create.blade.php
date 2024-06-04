@extends('adminlte::page')
@section('title', 'Apertura de Caja')
@section('content_header')
    <h1>Apertura de Caja</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::open(['route' => 'panel.cajas.store']) !!}

                <div class="form-group">
                    {!! Form::label('monto_inicial', 'Monto Inicial') !!}
                    {!! Form::number('monto_inicial', null, ['class'=>'form-control','placeholder'=>'Monto Inicial']) !!}

                    @error('monto_inicial')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div style="text-align: center">
                    {!! Form::submit('Abrir Caja', ['class'=>'btn btn-success col-3', 'name'=>'AbrirCaja']) !!}
                    <a href="{{route('panel.cajas.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

