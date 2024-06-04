@extends('adminlte::page')
@section('title', 'Arqueo de Caja')
@section('content_header')
    <h1>Arqueo de Caja</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::model($arqueo,['route' => ['panel.cajas.arqueo.update',$arqueo], 'method'=>'put']) !!}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('monto_inicial', 'Monto Inicial') !!}
                        {!! Form::number('monto_inicial', null, ['class'=>'form-control','placeholder'=>'Monto Inicial']) !!}

                        @error('monto_inicial')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('saldo', 'Saldo') !!}
                        {!! Form::number('saldo', null, ['class'=>'form-control','placeholder'=>'Saldo']) !!}

                        @error('saldo')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('total_ventas', 'Total de las Ventas') !!}
                        {!! Form::number('total_ventas', null, ['class'=>'form-control','placeholder'=>'Total de las Ventas']) !!}

                        @error('total_ventas')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('faltante', 'Faltante') !!}
                        {!! Form::number('faltante', null, ['class'=>'form-control','placeholder'=>'Faltante']) !!}

                        @error('faltante')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('total_compras', 'Total de las Compras') !!}
                        {!! Form::number('total_compras', null, ['class'=>'form-control','placeholder'=>'Total de las Compras']) !!}

                        @error('total_compras')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('sobrante', 'Sobrante') !!}
                        {!! Form::number('sobrante', null, ['class'=>'form-control','placeholder'=>'Sobrante']) !!}

                        @error('sobrante')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <br>

                {!! Form::submit('Guardar arqueo', ['class'=>'btn btn-success']) !!}
                <a href="{{route('panel.cajas.index')}}" class="btn btn-danger">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop

