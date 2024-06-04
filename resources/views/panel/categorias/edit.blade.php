@extends('adminlte::page')
@section('title', 'Editar Categoria')
@section('content_header')
    <h1>Editar Categoria: {{$categoria->nombre}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::model($categoria,['route' => ['panel.categorias.update',$categoria], 'method'=>'put']) !!}

                
            
                    {!! Form::label('nombre', 'Nombre de la Categoria') !!}
                    {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre de la Categoria']) !!}

                    @error('nombre')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div style="text-align: center">
                    {!! Form::submit('Actualizar', ['class'=>'btn btn-success col-3']) !!}
                    <a href="{{route('panel.categorias.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop