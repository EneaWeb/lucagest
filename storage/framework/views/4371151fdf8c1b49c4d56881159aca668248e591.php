<?php $__env->startSection('content'); ?>

    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg">
    <div class="row">
        <!-- START PANEL -->
        <div class="panel panel-transparent">
            <div class="panel-heading">
            <div class="panel-title">Ordini salvati
            </div>
            </div>
            <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="orders_table">
                <thead>
                    <tr>
                    <th style="width:5%">ID</th>
                    <th style="width:30%">Cliente</th>
                    <th style="width:10%">Fornitore</th>
                    <th style="width:10%">Tot</th>
                    <th style="width:20%">Data</th>
                    <th style="width:10%">Pagato</th>
                    <th style="width:15%">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
                    <td class="v-align-middle"><?php echo $order->id; ?></td>
                    <td class="v-align-middle semi-bold"><?php echo $order->customer_name; ?> <?php echo $order->customer_contact != '' ? '- '.$order->customer_contact : ''; ?></td>
                    <td class="v-align-middle"><?php echo $order->supplierTotal(); ?></td>
                    <td class="v-align-middle semi-bold"><?php echo $order->total(); ?></td>
                    <td class="v-align-middle semi-bold"><?php echo $order->created_at->format('d/m/Y'); ?></td>
                    <td class="v-align-middle semi-bold"><?php if($order->payed == 1): ?> <i class="fa fa-check"></i> <?php endif; ?></td>
                    <td class="v-align-middle semi-bold">
                        <?php echo Form::open(['url'=>'/order/delete', 'method'=>'POST']); ?>

                        <?php echo Form::hidden('order_id', $order->id); ?>

                        <button type="submit" class="btn btn-default" style="border-radius:50%; float:left"><i class="fa fa-trash"></i></button>
                        <?php echo Form::close(); ?>

                        <a href="/order/edit/<?php echo $order->id; ?>" class="btn btn-default" style="border-radius:50%; float:left"><i class="fa fa-pencil"></i></a>
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
<script>
     $(document).ready(function() {
        
        //var lastColumn = $('#sold-by-item').find('th:last').index();
        //var lastColumnMinusOne = lastColumn-1;
        
        $('#orders_table').DataTable( {
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