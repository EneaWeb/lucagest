<div class="modal-dialog animated zoomIn">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="smallModalHead">Modifica servizio</h4>
        </div>
        <div class="modal-body">
            <br><br>

            {!!Form::open(['url'=>'/service/edit', 'method'=>'POST'])!!}
                {!!Form::hidden('service_id', $service->id)!!}
                
                <div class="form-group form-group-default required ">
                    <label>Macro Area</label>
                    {!!Form::select('area_id', \App\Area::pluck('name', 'id'), $service->area_id, ['class'=>'form-control'])!!}
                </div>
                <div class="form-group form-group-default required ">
                    <label>Nome</label>
                    {!!Form::input('text', 'name', $service->name, ['class'=>'form-control'])!!}
                </div>
                <div class="form-group form-group-default required ">
                    <label>Prezzo</label>
                    {!!Form::input('number', 'price', $service->price, ['class'=>'form-control', 'step'=>'0.01'])!!}
                </div>
                {!!Form::submit('Salva', ['class'=>'btn btn-danger'])!!}
            {!!Form::close()!!}

        </div>
    </div>
</div>