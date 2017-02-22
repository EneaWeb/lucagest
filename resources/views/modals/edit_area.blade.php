<div class="modal-dialog animated zoomIn">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="smallModalHead">Modifica area</h4>
        </div>
        <div class="modal-body">
            <br><br>

            {!!Form::open(['url'=>'/area/edit', 'method'=>'POST'])!!}
                {!!Form::hidden('area_id', $service->id)!!}
                
                <div class="form-group form-group-default required ">
                    <label>Nome</label>
                    {!!Form::input('text', 'name', $service->name, ['class'=>'form-control'])!!}
                </div>

                {!!Form::submit('Salva', ['class'=>'btn btn-danger'])!!}
            {!!Form::close()!!}

        </div>
    </div>
</div>