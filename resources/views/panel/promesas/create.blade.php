@extends('adminlte::page')
@section('title', 'Promesa')
@section('content_header')
    <h1>Nueva Promesa</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('panel.promesas.store') }}" method="post">
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
                    <label for="">Stock (cajones)</label>
                    <input type="number" id="stock" name="stock" class="form-control">
                    @error('stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-4">
                    <label for="">Precio x cajon</label>
                    <input type="number" id="precio_x_cajon" name="precio_x_cajon" step="0.01" oninput="calcular()" class="form-control">

                    @error('precio_x_cajon')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-4">
                    <label for="">Kg x cajon</label>
                    <input type="number" id="kg_x_cajon" name="kg_x_cajon" step="0.01" oninput="calcular()" class="form-control">

                    @error('kg_x_cajon')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="">Merma</label>
                    <input type="number" id="merma" name="merma" step="0.01" oninput="calcular()" class="form-control">
                    @error('merma')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
            
                <div class="form-group col-md-4">
                    <label for="">Precio x kg</label>
                    <input type="number" id="precio_x_kg" name="precio_x_kg" step="0.01" class="form-control">
                    @error('precio_x_kg')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
        
                <div class="form-group col-md-4">
                    <label for="">Flete</label>
                    <input type="number" id="flete" name="flete" step="0.01" oninput="calcular()" class="form-control">
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
                    <input type="number" id="porcentaje_red" name="porcentaje_red" step="0.01" oninput="calcular()" class="form-control">
                    @error('porcentaje_red')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>

                <div class="form-group col-md-4">
                    <label for="">% Nodo D</label>
                    <input type="number" id="porcentaje_nodoD" name="porcentaje_nodoD" step="0.01" oninput="calcular()" class="form-control">
                    @error('porcentaje_nodoD')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="">Precio final</label>
                    <input type="number" id="precio_final" name="precio_final" step="0.01" class="form-control">
                    @error('precio_final')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
            
                <div class="form-group col-md-4">
                    <label for="">Precio FLete 2</label>
                    <input type="number" id="precio_flete2" name="precio_flete2" step="0.01" class="form-control">
                    @error('precio_flete2')
                        <span class="text-danger">{{$message}}</span>
                    @enderror 
                </div>
                
                <div class="form-group col-md-4">
                    <label for="">Precio x cajon</label>
                    <input type="number" id="precio_final2" name="precio_final2" step="0.01" class="form-control">
                    @error('precio_final2')
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
        function calcular()
        {
            try
            {
                var precio_cajon = document.getElementById('precio_x_cajon').value;
                var kg_cajon = document.getElementById('kg_x_cajon').value;
                var merma = document.getElementById('merma').value;

                var flete = parseFloat(document.getElementById('flete').value);

                var porcent_red = document.getElementById('porcentaje_red').value;
                var porcent_nodoD = document.getElementById('porcentaje_nodoD').value;

                //Precio x KG
                document.getElementById('precio_x_kg').value = (precio_cajon / (kg_cajon - (kg_cajon * (merma / 100)))).toFixed(2);
                console.log(document.getElementById('precio_x_kg').value);

                //Precio con flete
                let precio_kg = parseFloat(precio_cajon / (kg_cajon - (kg_cajon * (merma / 100)))+flete);
                document.getElementById('precio_flete').value = (precio_kg).toFixed(2);
                console.log(document.getElementById('precio_flete').value);

                //Precio final x kg para la venta
                let precio_flete = precio_kg + (precio_kg * (porcent_red / 100)) + (precio_kg * (porcent_nodoD / 100));
                document.getElementById('precio_final').value = Math.round(precio_flete);
                console.log(document.getElementById('precio_final').value);

                //Precio x cajon
                let precio_flete2 = precio_flete * ( kg_cajon - (kg_cajon * (merma / 100)))
                document.getElementById('precio_flete2').value = (precio_flete2).toFixed(2);
                document.getElementById('precio_final2').value = Math.round(precio_flete2);

            }
            catch (e){}
        }
    </script>
@stop
