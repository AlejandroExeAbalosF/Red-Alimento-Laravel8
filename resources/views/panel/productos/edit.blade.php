@extends('adminlte::page')
@section('title', 'Editar Producto')
@section('content_header')
    <h1>Editar Producto</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">

            {!! Form::model($producto,['route' => ['panel.productos.update',$producto], 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label name="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" placeholder="Nombre del producto">

                        @error('nombre')
                            <span class="text-danger">{{$message}}</span>
                        @enderror

                        <br>
                        <label name="imagen">Seleccione una imagen</label>

                        @if(isset($producto->imagen))
                            <img src="{{ asset('storage').'/'.$producto->imagen }}" class="img-thumbnail img-fluid" width="10%" alt="">
                        @endif

                        <br>
                        <input type="file" class="form-control" name="imagen" value="{{ old('imagen', optional($producto)->imagen) }}" accept="image/*">
                        <img src="{{ old('imagen', optional($producto)->imagen) }}" width="20%">

                        @error('imagen')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label name="descripcion">Descripcion</label>
                        <textarea class="form-control" name="descripcion" placeholder="Descripcion" width="100%">{{ old('descripcion', optional($producto)->descripcion) }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label name="categoria_id">Seleccione la Categoria</label>

                        <select id="categoria_id" name="categoria_id" class="form-control">
                            @foreach ($categoria as $cate)
                                <option {{ $producto->categoria_id && $producto->categoria_id == $cate->id ? 'selected': ''}} value="{{ $cate->id }}"> 
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
                    <input type="submit" class="btn btn-success col-3" value="Actualizar">
                    <a href="{{route('panel.productos.index')}}" class="btn btn-danger col-3">Cancelar</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop