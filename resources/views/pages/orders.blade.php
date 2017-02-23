@extends('layout.main')
@section('content')

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
                    @if(\App\Option::showSupplierPrices())
                        <th style="width:10%">Fornitore</th>
                    @endif
                    <th style="width:10%">Tot</th>
                    <th style="width:15%">Data</th>
                    <th style="width:13%">Pagato</th>
                    <th style="width:12%">Status</th>
                    <th style="width:15%">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                    <td class="v-align-middle">{!!$order->id!!}</td>
                    <td class="v-align-middle semi-bold">{!!$order->customer_name!!} {!!$order->customer_contact != '' ? '- '.$order->customer_contact : ''!!}</td>
                    @if(\App\Option::showSupplierPrices())
                        <td class="v-align-middle">{!!$order->supplierTotal()!!}</td>
                    @endif
                    <td class="v-align-middle semi-bold">{!!$order->total()!!}</td>
                    <td class="v-align-middle semi-bold">{!!$order->created_at->format('d/m/Y')!!}</td>
                    <td class="v-align-middle semi-bold">@if ($order->payed == 1) <i class="fa fa-check"></i> @endif</td>
                    <td class="v-align-middle semi-bold">{{ucfirst($order->status)}}</td>
                    <td class="v-align-middle semi-bold">
                        {!!Form::open(['url'=>'/order/delete', 'method'=>'POST'])!!}
                        {!!Form::hidden('order_id', $order->id)!!}
                        <button type="submit" class="btn btn-default" style="border-radius:50%; float:left"><i class="fa fa-trash"></i></button>
                        {!!Form::close()!!}
                        <a href="/order/edit/{!!$order->id!!}" class="btn btn-default" style="border-radius:50%; float:left"><i class="fa fa-pencil"></i></a>
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
@stop