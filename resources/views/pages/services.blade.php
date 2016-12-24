@extends('layout.main')
@section('content')

    <div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-6">
        <!-- START PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
            <div class="panel-title">
                Nuovo servizio
            </div>
            </div>
            <div class="panel-body">
            <h5></h5>
            {!!Form::open(['url'=>'service/save', 'method'=>'POST'])!!}

                <div class="form-group form-group-default required ">
                    <label>Macro Area</label>
                    {!!Form::select('area_id', \App\Area::pluck('name', 'id'), '', ['class'=>'form-control'])!!}
                </div>
                <div class="form-group form-group-default required ">
                    <label>Nome Servizio</label>
                    <input type="text" name="service_name" class="form-control" required>
                </div>
                <div class="form-group form-group-default required ">
                    <label>Prezzo in EURO</label>
                    <input type="number" step="0.01" class="form-control" name="price" required>
                </div>
                <br>
                {!!Form::submit('SALVA', ['class'=>'btn btn-danger'])!!}
            {!!Form::close()!!}
            </div>
        </div>
        <!-- END PANEL -->
        </div>
        <div class="col-md-6">
        <!-- START PANEL -->
            <div class="panel panel-transparent">
                <div class="panel-heading">
                <div class="panel-title">Inserimento Servizi
                </div>
                </div>
                <div class="panel-body">
                <h3>
                    In questa sezione puoi creare nuovi servizi o gestire i servizi già esistenti
                </h3>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END CONTAINER FLUID -->
    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg">
    <div class="row">
        <!-- START PANEL -->
        <div class="panel panel-transparent">
            <div class="panel-heading">
            <div class="panel-title">Servizi esistenti
            </div>
            </div>
            <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="services_table">
                <thead>
                    <tr>
                    <th style="width:30%">Nome Servizio</th>
                    <th style="width:30%">Area</th>
                    <th style="width:15%">Prezzo</th>
                    <th style="width:15%">Usato in n. ordini</th>
                    <th style="width:20%">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td class="v-align-middle semi-bold">{!!$service->name!!}</td>
                        <td class="v-align-middle semi-bold">{!!$service->area->name!!}</td>
                        <td class="v-align-middle semi-bold">{!!number_format($service->price, 2, ',', '.')!!}</td>
                        <td class="v-align-middle">{!!$service->ordersCount()!!}</td>
                        <td class="v-align-middle semi-bold">
                            {!!Form::open(['url'=>'/service/delete', 'method'=>'POST', 'style'=>'display: inline-block; margin-top: 4px;'])!!}
                                {!!Form::hidden('service_id', $service->id)!!}
                                {!!Form::submit('&#xf1f8;', ['class'=>'', 'style'=>'font-family:"FontAwesome"'])!!}
                            {!!Form::close()!!}
                            <a class="gallery-item" href="#" data-toggle="modal" data-target="#modal_edit_service" data-service_id="{!!$service->id!!}" class="tile tile-primary">
                                <button class="">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
        <!-- END PANEL -->
    </div>
    </div>
</div>
<!-- END PAGE CONTENT -->

{{-- MODAL ADD LINES --}}
<div class="modal animated fadeIn" 
    id="modal_edit_service" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="smallModalHead" 
    aria-hidden="true" 
    style="display: none;">
</div>
{{-- END MODAL ADD LINES --}}


<script>
    $('#modal_edit_service').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var service_id = button.data('service_id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
              
        modal.empty();
        
        $.ajax({
          type: 'GET',
          url: '/service/modal/edit',
          data: { '_token' : '{!!csrf_token()!!}', service_id: service_id },
          success:function(data){
            // successful request; do something with the data
            modal.append(data);
          },
          error:function(){
            // failed request; give feedback to user
            alert('ajax error');
          }
        });

    })
</script>

@stop