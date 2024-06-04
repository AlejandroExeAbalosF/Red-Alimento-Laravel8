@extends('adminlte::page')
@section('title', 'Arqueo de Caja')
@section('content_header')
    <h1>Cerrar Caja</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <!--Formulario Collective-->
            {!! Form::model($caja,['route' => ['panel.cajas.update',$caja], 'method'=>'put']) !!}
                <div class="form-row">
                
                    <div class="form-group col-md-6">
                        {!! Form::label('fecha_hora_cierre', 'Fecha y Hora Cierre de Caja') !!}
                        {!! Form::date('fecha_hora_cierre', date('Y-m-d'), ['class'=>'form-control', 'readonly']) !!}

                        @error('fecha_hora_cierre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('monto_inicial', 'Monto Inicial') !!}
                        {!! Form::number('monto_inicial', null, ['id' => 'monto_inicial', 'step'=> '0.001', 'oninput' => 'calcular()', 'class'=>'form-control', 'placeholder'=>'Monto Inicial', 'readonly']) !!}

                        @error('monto_inicial')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('total_ventas', 'Total de Ventas') !!}
                        {!! Form::number('total_ventas', null, ['id' => 'total_ventas', 'step'=> '0.001', 'oninput' => 'calcular()', 'class'=>'form-control','placeholder'=>'Total de Ventas']) !!}

                        @error('total_ventas')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('faltante', 'Faltante') !!}
                        {!! Form::number('faltante', null, ['id' => 'faltante', 'step'=> '0.001', 'oninput' => 'calcular()', 'class'=>'form-control','placeholder'=>'Faltante']) !!}

                        @error('faltante')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('total_compras', 'Total de Compras') !!}
                        {!! Form::number('total_compras', null, ['id' => 'total_compras', 'step'=> '0.001', 'oninput' => 'calcular()', 'class'=>'form-control','placeholder'=>'Total de Compras']) !!}

                        @error('total_compras')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('sobrante', 'Sobrante') !!}
                        {!! Form::number('sobrante', null, ['id' => 'sobrante', 'step'=> '0.001', 'oninput' => 'calcular()', 'class'=>'form-control','placeholder'=>'Sobrante']) !!}

                        @error('sobrante')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('saldo_contable', 'Saldo Contable') !!}
                        {!! Form::number('saldo_contable', null, ['id' => 'saldo_contable', 'step'=> '0.001', 'oninput' => 'calcular()', 'class'=>'form-control','placeholder'=>'Saldo Contable', 'readonly']) !!}

                        @error('saldo_contable')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('monto_final', 'Monto Final') !!}
                        {!! Form::number('monto_final', null, ['id' => 'monto_final', 'step'=> '0.001', 'class'=>'form-control','placeholder'=>'Monto Final']) !!}

                        @error('monto_final')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <br>

                <div style="text-align: center">
                    {!! Form::submit('Cerrar Caja', ['class'=>'btn btn-success col-3', 'name' => 'btnCerrar']) !!}
                    <a href="{{route('panel.cajas.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        function calcular()
        {
            try
            {
                var montoinicial = parseFloat(document.getElementById('monto_inicial').value);
                var totalcompras = parseFloat(document.getElementById('total_compras').value);
                var totalventas = parseFloat(document.getElementById('total_ventas').value);
                var faltante = parseFloat(document.getElementById('faltante').value);
                

                document.getElementById('saldo_contable').value = montoinicial + totalventas - totalcompras;
                document.getElementById('monto_final').value = document.getElementById('saldo_contable').value - faltante;
                //document.getElementById('monto_final').value = document.getElementById('saldo_contable').value + sobrante;
            }
            catch(e) {}
        }
           
    </script>
@stop