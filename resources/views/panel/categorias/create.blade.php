@extends('adminlte::page')
@section('title', 'Nueva Categoria')
@section('content_header')
    <h1>Nueva Categoria</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::open(['route' => 'panel.categorias.store']) !!}

                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre de la Categoria']) !!}

                    @error('nombre')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div style="text-align: center">
                    {!! Form::submit('Guardar', ['class'=>'btn btn-success col-3']) !!}
                    <a href="{{route('panel.categorias.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop