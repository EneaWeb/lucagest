<?php $__env->startSection('content'); ?>

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
            <?php echo Form::open(['url'=>'service/save', 'method'=>'POST']); ?>


                <div class="form-group form-group-default required ">
                    <label>Macro Area</label>
                    <?php echo Form::select('area_id', \App\Area::pluck('name', 'id'), '', ['class'=>'form-control']); ?>

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
                <?php echo Form::submit('SALVA', ['class'=>'btn btn-danger']); ?>

            <?php echo Form::close(); ?>

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
                        <th>Nome Servizio</th>
                        <th>Area</th>
                        <th>Prezzo</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                        <td class="v-align-middle semi-bold"><?php echo $service->name; ?></td>
                        <td class="v-align-middle semi-bold"><?php echo $service->area->name; ?></td>
                        <td class="v-align-middle semi-bold"><?php echo number_format($service->price, 2, ',', '.'); ?></td>
                        <td class="v-align-middle semi-bold">
                            <a class="gallery-item" href="#" data-toggle="modal" data-target="#modal_edit_service" data-service_id="<?php echo $service->id; ?>" class="tile tile-primary">
                                <button class="btn btn-default" style="border-radius:50%; float:left;">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </a>
                            <?php echo Form::open(['url'=>'/service/delete', 'method'=>'POST', 'style'=>'display: inline-block; margin-top: 4px;']); ?>

                                <?php echo Form::hidden('service_id', $service->id); ?>

                                <?php echo Form::submit('&#xf1f8;', ['class'=>'btn btn-default', 'style'=>'border-radius:50%; margin-top:-4px; float:left; font-family:"FontAwesome"']); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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


<div class="modal animated fadeIn" 
    id="modal_edit_service" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="smallModalHead" 
    aria-hidden="true" 
    style="display: none;">
</div>



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
          data: { '_token' : '<?php echo csrf_token(); ?>', service_id: service_id },
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
        
        $('#services_table').DataTable( {
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>