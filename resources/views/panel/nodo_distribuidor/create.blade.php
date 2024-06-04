@extends('adminlte::page')
@section('title', 'Nuevo Nodo Distribuidor')
@section('content_header')
    <h1>Nuevo Nodo Distribuidor</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::open(['route' => 'panel.nodo_distribuidor.store']) !!}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre del nodo distribuidor']) !!}

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

                    <div class="form-group col-md-6">
                        {!! Form::label('zona', 'Zona') !!}
                        {!! Form::select('zona', ['Norte' => 'Norte', 'Sur' => 'Sur', 'Este' => 'Este', 'Oeste' => 'Oeste'], null, ['class' => 'form-control']) !!}

                        @error('zona')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    {!! Form::label('nodo_base_id', 'Nodo Base') !!}
                    <select id="nodo_base_id" name="nodo_base_id" class="form-control">
                        @foreach ($nodoBase as $nodoB)
                            <option {{ $nodoDistribuidor->nodo_base_id && $nodoDistribuidor->nodo_base_id == $nodoB->id ? 'selected': ''}} value="{{ $nodoB->id }}"> 
                                {{ $nodoB->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('nodo_base_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <br>
                <div style="text-align: center">
                    {!! Form::submit('Guardar', ['class'=>'btn btn-success col-3']) !!}
                    
                    <a href="{{route('panel.nodo_distribuidor.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop