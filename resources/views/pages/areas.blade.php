@extends('layout.main')
@section('content')

    <div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-6">
        <!-- START PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
            <div class="panel-title">
                Nuova area
            </div>
            </div>
            <div class="panel-body">
            <h5></h5>
            {!!Form::open(['url'=>'area/save', 'method'=>'POST'])!!}

                <div class="form-group form-group-default required ">
                    <label>Nome Area</label>
                    <input type="text" name="area_name" class="form-control" required>
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
                <div class="panel-title">Inserimento Aree
                </div>
                </div>
                <div class="panel-body">
                <h3>
                    In questa sezione puoi creare nuove aree di lavoro con cui raggruppare i servizi.
                </h3>
                <p>E' possibile ma sconsigliato richiedere la cancellazione delle aree di lavoro. 
                <br>Al momento della cancellazione vengono cancellati anche tutti i servizi inclusi in quell'area. 
                <br>Se sono già stati effettuati ordini con servizi relativi all'area che si desidera cancellare, l'area sarà disattivata e nascosta ma rimarrà nel database.</p>
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
            <div class="panel-title">Aree di lavoro
            </div>
            </div>
            <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="areas_table">
                <thead>
                    <tr>
                    <th style="width:30%">Area</th>
                    <th style="width:15%">Servizi collegati</th>
                    <th style="width:20%">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($areas as $area)
                    <tr>
                        <td class="v-align-middle semi-bold">{!!$area->name!!}</td>
                        <td class="v-align-middle">{!!$area->servicesCount()!!}</td>
                        <td class="v-align-middle semi-bold">
                            <a class="gallery-item" href="#" data-toggle="modal" data-target="#modal_edit_area" data-area_id="{!!$area->id!!}" class="tile tile-primary">
                                <button class="btn btn-default" style="border-radius:50%; float:left;">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </a>
                            {!!Form::open(['url'=>'/area/delete', 'method'=>'POST', 'style'=>'display: inline-block; margin-top: 4px;', 'id'=>'deleteareaform', 'onsubmit'=>"return confirm('Cancellando questa area cancellerai anche tutti i servizi collegati ad essa. Procedere?');"])!!}
                                {!!Form::hidden('area_id', $area->id)!!}
                                {!!Form::submit('&#xf1f8;', ['class'=>'btn btn-default', 'style'=>'border-radius:50%; margin-top:-4px; float:left; font-family:"FontAwesome"'])!!}
                            {!!Form::close()!!}
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
    id="modal_edit_area" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="smallModalHead" 
    aria-hidden="true" 
    style="display: none;">
</div>
{{-- END MODAL ADD LINES --}}


<script>

    $('#modal_edit_area').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var area_id = button.data('area_id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
              
        modal.empty();
        
        $.ajax({
          type: 'GET',
          url: '/area/modal/edit',
          data: { '_token' : '{!!csrf_token()!!}', area_id: area_id },
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

    $(document).ready(function() {
        
        //var lastColumn = $('#sold-by-item').find('th:last').index();
        //var lastColumnMinusOne = lastColumn-1;
        
        $('#areas_table').DataTable( {
            //"order": [[ lastColumnMinusOne, "desc" ]],
            "language": { "url": "/assets/plugins/jquery-datatable/it.json" },
            sScrollX: "100%",
            paginate: false,
            bSort: true,
            deferRender: true,
            dom: 'Bfrtip'

        });

    });
</script>

@stop