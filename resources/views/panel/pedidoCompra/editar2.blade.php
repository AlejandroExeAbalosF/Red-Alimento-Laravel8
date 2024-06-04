{{-- Modal Crear Pedido --}}
{{-- <div class="modal fade" id="editar{{$fila->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos Requeridos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($fila, ['methhod' => 'put' , 'route' =>['filaU' , $fila->id]]) !!}
                <div class="mb-3">
                    {!! Form::label('nombre', 'nombreproducto') !!} 
                    {!! Form::text('nombresx', $fila->estado_pedido_compra, ['class' => 'form-control']) !!} 
                </div>
                {!! Form::submit('guardar', ['class'=>'btn btn-primary mt-2'] ) !!}
                {!! Form::close() !!}--}}
        
                
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          {{--  </div>
        </div>
    </div>
</div>--}}
