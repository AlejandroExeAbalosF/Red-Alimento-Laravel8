@extends('adminlte::page')
@section('title', 'Admin')

@section('content_header')
    <h1>Estado y Remito Nodo D</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <div class="row">

                <div class="col-sm-5">

                    <div class="form-group">
                        <label>Seleciona Ciclo</label>
                        <select class="form-control input-sm" id="_ciclo" name="clienteVenta">
                            <option value="nada">Selecciona</option>
                            @foreach ($ciclo as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Seleciona Nodo Distribuidor</label>
                        <select class="form-control input-sm" id="_nodoD" name="clienteVenta">
                            <option value="nada">Selecciona</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Recaudacion del Nodo Distribuidor Esperado </label>
                        <input readonly="" type="text" id="_esperado" name="descripcionV"
                            class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label>Dinero a Rendir Faltante</label>
                        <input readonly="" type="number" class="form-control input-sm" id="_faltante" name="cantidadV"
                            value="">
                    </div>

                    <span class="btn btn-primary" id="_btnGenerarRemito">Generar Remito</span>

                </div>
                <div class="col-sm-5">
                    <label>Estado del Ciclo </label>
                    <input readonly="" type="text" id="_esperado" name="descripcionV" class="form-control input-sm">
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        window.addEventListener('load', function() {
            // console.log(document.getElementById("_productoVenta").value);
            if (document.getElementById("_ciclo").value != "nada") {
                $("#_btnGenerarRemito").show();
            } else {

                $("#_btnGenerarRemito").hide();
            }
            // $("#_btnGenerarRemito").hide();
            // $("#cantidadV").prop("disabled", true);
        });
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            //select de cicloXnodoD
            document.getElementById('_ciclo').addEventListener('change', (e) => {
                fetch('getPedidosCiclo', {
                    method: 'POST',
                    body: JSON.stringify({
                        texto: e.target.value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    let opciones = "<option value='nada'>Seleccionar</option>";
                    opciones += '<option value="nada" id="_clienteP">Cliente Publico</option>';
                    for (let i in data.lista) {
                        opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].nombre +
                            '</option>';
                    }
                    // console.log(opciones);
                    document.getElementById("_clienteVenta").innerHTML = opciones;
                    cargaTabla()
                }).catch(error => console.error(error));
            })
    </script>
@stop
