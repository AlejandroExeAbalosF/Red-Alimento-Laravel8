@extends('adminlte::page')
@section('title', 'Nuevo Nodo Base')
@section('content_header')
    <h1>Nuevo Nodo Base</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::open(['route' => 'panel.nodo_bases.store']) !!}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre del nodo base']) !!}

                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Email']) !!}

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('direccion', 'Direccion') !!}
                        {!! Form::text('direccion', null, ['class'=>'form-control','placeholder'=>'Direccion']) !!}

                        @error('direccion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('provincia', 'Provincia') !!}
                        {!! Form::text('provincia', null, ['class'=>'form-control','placeholder'=>'Provincia']) !!}

                        @error('provincia')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('celular', 'Celular') !!}
                        {!! Form::number('celular', null, ['class'=>'form-control','placeholder'=>'Celular']) !!}

                        @error('celular')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <br>
                <div style="text-align: center">
                    {!! Form::submit('Guardar', ['class'=>'btn btn-success col-3']) !!}
                    
                    <a href="{{route('panel.nodo_bases.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop