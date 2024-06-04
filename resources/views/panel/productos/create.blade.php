@extends('adminlte::page')
@section('title', 'Nueva Producto')
@section('content_header')
    <h1>Nueva Producto</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('panel.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label name="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="" placeholder="Nombre del producto">

                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror

                        <br>
                        <label name="imagen">Seleccione una imagen</label>

                        @if(isset($producto->imagen))
                            <img src="{{ asset('storage').'/'.$producto->imagen }}" class="img-thumbnail img-fluid" width="10%" alt="">
                        @endif

                        <br>
                        <input type="file" class="form-control" name="imagen" accept="image/*">

                        @error('imagen')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label name="descripcion">Descripcion</label>
                        <textarea class="form-control" name="descripcion" placeholder="Descripcion" width="100%"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label name="categoria_id">Seleccione la Categoria</label>

                        <select id="categoria_id" name="categoria_id" class="form-control">
                            @foreach ($categoria as $cate)
                                <option value="{{ $cate->id }}"> 
                                    {{ $cate->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('categoria_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div style="text-align: center">
                    <input type="submit" class="btn btn-success col-3" value="Guardar">
                    <a href="{{route('panel.productos.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop
