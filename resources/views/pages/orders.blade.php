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
                <table class="table table-striped dataTable no-footer" id="services_table">
                <thead>
                    <tr>
                    <th style="width:30%">Cliente</th>
                    <th style="width:15%">Fornitore</th>
                    <th style="width:15%">Tot</th>
                    <th style="width:20%">Data</th>
                    <th style="width:20%">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                    <td class="v-align-middle semi-bold">{!!$order->customer_name!!} - {!!$order->customer_contact!!}</td>
                    <td class="v-align-middle">{!!$order->supplierTotal()!!}</td>
                    <td class="v-align-middle semi-bold">{!!$order->total()!!}</td>
                    <td class="v-align-middle semi-bold">{!!$order->created_at->format('d/m/Y')!!}</td>
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

@stop