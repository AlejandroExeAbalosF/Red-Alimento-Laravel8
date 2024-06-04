@extends('adminlte::page')
@section('title', 'Lista de Usuarios')
@section('content_header')
    <h1>Datatables con Ajax</h1>
@stop
@section('content')
<table id="usuarios_id" class="table table-striped w-100">
    <thead class="bg-primary text-center">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('usuarios.css') }}">
@stop
@section('js')
    <script src="{{ asset('usuarios.js') }}"></script>
@stop