@extends('adminlte::page')
@section('title', 'Nueva Proveedor')
@section('content_header')
    <h1>Nueva Proveedor</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::open(['route' => 'panel.proveedores.store']) !!}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class'=>'form-control','placeholder'=>'Nombre del proveedor']) !!}

                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('apellido', 'Apellido') !!}
                        {!! Form::text('apellido', null, ['class'=>'form-control','placeholder'=>'Apellido del proveedor']) !!}

                        @error('apellido')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('razon_social', 'Razon_social') !!}
                        {!! Form::text('razon_social', null, ['class'=>'form-control','placeholder'=>'Razon social del proveedor']) !!}

                        @error('razon_social')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('direccion', 'Direccion') !!}
                        {!! Form::text('direccion', null, ['class'=>'form-control','placeholder'=>'Direccion']) !!}

                        @error('direccion')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('provincia', 'Provincia') !!}
                        {!! Form::text('provincia', null, ['class'=>'form-control','placeholder'=>'Provincia']) !!}

                        @error('provincia')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('region', 'Region') !!}
                        {!! Form::text('region', null, ['class'=>'form-control','placeholder'=>'Region ']) !!}

                        @error('region')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
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
                        {!! Form::label('celular', 'Celular') !!}
                        {!! Form::number('celular', null, ['class'=>'form-control','placeholder'=>'Celular']) !!}

                        @error('celular')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('telefono', 'Telefono') !!}
                        {!! Form::number('telefono', null, ['class'=>'form-control','placeholder'=>'Telfono']) !!}

                        @error('telefono')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                     <div class="form-group col-md-6">
                        {!! Form::label('cuil', 'CUIL') !!}
                        {!! Form::number('cuil', null, ['id'=>'cuilProve', 'class'=>'form-control','placeholder'=>'CUIL']) !!}

                        @error('cuil')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div style="text-align: center">
                    {!! Form::submit('Guardar', ['class'=>'btn btn-success col-3']) !!}
                    
                    <a href="{{route('panel.proveedores.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')

    <!--Validacion del CUIL solo deja poner los 11 digitos-->
    <script>
        let dni = document.getElementById('cuilProve');
        dni.addEventListener('input', function()
        {
            if(this.value.length > 11)
            {
                this.value = this.value.slice(0,11)
            }
        });
    </script>
    <!--Fin de la validacion-->
@stop