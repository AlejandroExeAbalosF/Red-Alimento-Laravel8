
@extends('pdf_bs3')
@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-xs-8" >
            <img src="{{public_path('/img/index.jpg')}}" style="width: 100%; max-width: 100px;">
            {{-- <img class="img img-responsive" src="{{asset('imagenes/index.jpg')}}" alt="Logotipo"> --}}
        </div>
        <div class="col-xs-4">
            <h1>Factura</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-8">
            
        </div>
        <div class="col-xs-3 text-center">
            <strong>Fecha y Hora</strong>
            <br>
            <?php echo $cab[0]->fecha_hora ?>
            <br>
            
            <strong>Factura No.</strong>
            <br>
            <?php echo $cab[0]->id ?>
        </div>
    </div>
    <hr>
    <div class="row text-center" style="margin-bottom: 2rem;">
        <div class="col-xs-6">
            <h1 class="h2">Cliente</h1>
            <strong><?php echo $cab[0]->name?></strong>
        </div>
        <div class="col-xs-6">
            <h1 class="h2">Remitente</h1>
            <strong><?php echo 'Red de Aliemntos' ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>SubTotal</th>
                </tr>
                </thead>
                <tbody>
                <?php
                
                foreach ($detalles as $detalle) {
                    
                    ?>
                    <tr>
                        <td><?php echo $detalle->nombre ?></td>
                        <td><?php echo $detalle->cantidad_producto ?></td>
                        <td>$<?php echo $detalle->precio_unitario ?></td>
                        <td>$<?php echo $detalle->sub_total ?></td>
                    </tr>
                <?php }
                // $subtotalConDescuento = $subtotal - $descuento;
                // $impuestos = $subtotalConDescuento * ($porcentajeImpuestos / 100);
                // $total = $subtotalConDescuento + $impuestos;
                ?>
                </tbody>
                <tfoot>
                
                <tr>
                    <td colspan="3" class="text-right">
                        <h4>Total</h4></td>
                    <td>
                        <h4>$<?php echo number_format($cab[0]->total_venta, 2) ?></h4>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <p class="h5"><?php ?></p>
        </div>
    </div>
</div>
@endsection


