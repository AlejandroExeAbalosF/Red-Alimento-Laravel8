@extends('adminlte::page')
@section('title', 'Promesa')
@section('content_header')
    <h1>Nueva Promesa 2</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('panel.promesas.prome2.store') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="">Seleccione Nodo Base</label>
                    <select id="nodo_base_id" name="nodo_base_id" class="form-control">
                        @foreach ($nodoBase as $nodoB)
                            <option value="{{ $nodoB->id }}"> 
                                {{ $nodoB->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('nodo_base_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-3">
                    <label for="">Seleccione Nodo Distribuidor</label>
                    <select id="nodo_distribuidor_id" name="nodo_distribuidor_id" class="form-control">
                        @foreach ($nodoDistribuidor as $nodoD)
                            <option value="{{ $nodoD->id }}"> 
                                {{ $nodoD->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('nodo_distribuidor_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-3">
                    <label for="">Seleccione Producto</label>
                    <select id="producto_id" name="producto_id" class="form-control">
                        @foreach ($producto as $produ)
                            <option value="{{ $produ->id }}"> 
                                {{ $produ->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('producto_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="">Seleccione Proveedor</label>
                    <select id="proveedor_id" name="proveedor_id" class="form-control">
                        @foreach ($proveedore as $prove)
                            <option value="{{ $prove->id }}"> 
                                {{ $prove->nombre." ". $prove->apellido }}
                            </option>
                        @endforeach
                    </select>

                    @error('proveedor_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="">Fecha Limite</label>
                    <input type="date" id="fecha_limite_promesa" name="fecha_limite_promesa" class="form-control">
                    @error('fecha_limite_promesa')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="">Stock (cajones o fardos)</label>
                    <input type="number" id="stock" name="stock" class="form-control">
                    @error('stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-4">
                    <label for="">Precio x kg</label>
                    <input type="number" id="precio_kg" name="precio_kg" step="0.01" oninput="calcular2()" class="form-control">
                    @error('precio_kg')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-4">
                    <label for="">Flete</label>
                    <input type="number" id="flete" name="flete" step="0.01" oninput="calcular2()" class="form-control">
                    @error('flete')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
            </div>  

            <div class="form-row">  
                <div class="form-group col-md-4">
                    <label for="">Precio con Flete</label>
                    <input type="number" id="precio_flete" name="precio_flete" step="0.01" class="form-control">
                    @error('precio_flete')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
           
                <div class="form-group col-md-4">
                    <label for="">% red</label>
                    <input type="number" id="porcen_red" name="porcen_red" step="0.01" oninput="calcular2()" class="form-control">
                    @error('porcentaje_red')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-4">
                    <label for="">% Nodo D</label>
                    <input type="number" id="porcen_nodoD" name="porcen_nodoD" step="0.01" oninput="calcular2()" class="form-control">
                    @error('porcentaje_nodoD')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
            </div>

            <div class="form-row"> 
                <div class="form-group col-md-4">
                    <label for="">Precio final</label>
                    <input type="number" id="prec_final" name="prec_final" step="0.01" class="form-control">
                    @error('precio_final')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
            </div>

            <div style="text-align: center">
                <input type="submit" class="btn btn-success col-3" value="Guardar">
                <a href="{{route('panel.promesas.index')}}" class="btn btn-danger col-3">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
    <script>
        function calcular2()
        {
            try
            {
                var precio_kg = parseFloat(document.getElementById('precio_kg').value);

                var flete = parseFloat(document.getElementById('flete').value);

                var porcen_red = parseFloat(document.getElementById('porcen_red').value);
                var porcen_nodoD = parseFloat(document.getElementById('porcen_nodoD').value);

                //Precio con flete
                let precio_flete = precio_kg + (precio_kg * (flete /100));
                document.getElementById('precio_flete').value = precio_flete;

                //Precio final
                let prec_final = precio_flete + (precio_flete * (porcen_red / 100)) + (precio_flete * (porcen_nodoD / 100));
                document.getElementById('prec_final').value = Math.round(prec_final);
                console.log(prec_final);


            }
            catch (e){}
        }
    </script>
@stop
