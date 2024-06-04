@extends('pdf_bs3')
@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-xs-8" >
            <img src="{{public_path('/img/index.jpg')}}" style="width: 100%; max-width: 100px;">
            {{-- <img class="img img-responsive" src="{{asset('imagenes/index.jpg')}}" alt="Logotipo"> --}}
        </div>
        <div class="col-xs-4">
            <h1>Orden de Pedido</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-8">
            
        </div>
        <div class="col-xs-3 text-center">
            <strong>Fecha y Hora</strong>
            <br>
            
            <br>
            
            <strong>Factura No.</strong>
            <br>
            
        </div>
    </div>
    <hr>
    <div class="row text-center" style="margin-bottom: 2rem;">
        <div class="col-xs-4">
            <h1 class="h2">Proveedor</h1>
            <strong><?php echo $request->proveedor?></strong>
        </div>
        <div class="col-xs-4">
            <h1 class="h2">Ciclo</h1>
            <strong><?php echo $request->ciclo?></strong>
        </div>
        <div class="col-xs-4">
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
                    <th>Unidad al x Mayor</th>
                    <th>Precio al x Mayor</th>
                    <th>SubTotal</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i=0;$i<count($request->nombre);$i++) {     ?>
                    <tr>
                        <td><?php echo $request->nombre[$i] ?></td>
                        <td><?php echo $request->stock_pedido_mayor[$i] ?></td>
                        <td>$<?php echo $request->precio_conjunto_promesa[$i] ?></td>
                        <td>$<?php echo $request->sub_total[$i] ?></td>
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
                        <h4>$<?php echo number_format($request->total, 2) ?></h4>
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
