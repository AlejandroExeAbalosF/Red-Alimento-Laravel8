{{-- Modal Crear Pedido --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos Requeridos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('crearPedidoCompra') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Ingrese Fecha de llegada del Producto</label>
                        <input  type="date" class="form-control input-sm" id="fchll"
                            name="fchll" value="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                    {{-- <button id="button" class="btn btn-sm btn-info text-white text-uppercase me-1">Row count</button> --}}
                    <input type="hidden" id="pv" name="productos" value="">
                    {{-- <input type="hidden" id="fh" name="fch" value="{{$fechaH}}"> --}}
                    <input type="submit" class="btn btn-primary" id="button"
                        value="Terminar">
                </form>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
