@extends('layout.main')
@section('content')

<style>

 .form-horizontal .table-short .form-group {
	padding:0px!important;
}

</style>

	 <!-- START CONTAINER FLUID -->
	 <div class="container-fluid container-fixed-lg">
	 <div class="row">
		  <!-- START PANEL -->
		  <div class="panel panel-transparent">
				<div class="panel-heading">
					<div class="panel-title">Modifica Ordine # {!!$order->id!!}
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
													
							{!!Form::open(['url'=>'/orders/new/save', 'method'=>'POST', 'id'=>'form-work', 'role'=>'form', 'autocomplete'=>'off', 'novalidate'=>'novalidate', 'class'=>'form-horizontal'])!!}

							{!!Form::hidden('order_id', $order->id)!!}

								<div class="form-group">
									<label for="customer_name" class="col-sm-3 control-label">Nome cliente</label>
									<div class="col-sm-9">
                              {!!Form::text('customer_name', $order->customer_name, ['id'=>'customer_name', 'class'=>'form-control'])!!}
									</div>
								</div>

								<div class="form-group">
									<label for="customer_contact" class="col-sm-3 control-label">Contatto Cliente</label>
									<div class="col-sm-9">
										{!!Form::text('customer_contact', $order->customer_contact, ['id'=>'customer_contact', 'class'=>'form-control'])!!}
									</div>
								</div>

								<div class="form-group">
									<label for="payed" class="col-sm-3 control-label">Pagato</label>
									<div class="col-sm-9">
                              @if ($order->payed == 1)
										   <input type="checkbox" class="checkbox" name="payed" checked="checked" value="1" />
                              @else
										   <input type="checkbox" class="checkbox" name="payed" value="1" />
                              @endif
									</div>
								</div>

								<br>

								<table class="table table-striped dataTable no-footer">
									<tr>
										<th style="width:50%">Servizio</th>
										<th style="width:25%">Costo fornitore</th>
										<th style="width:25%">Costo totale</th>
										<th style="width:10%"></th>
									<tr>
								</table>
								<br>

								@foreach(\App\Area::all() as $area)

									<h6><b>{!!$area->name!!}</b> &nbsp; &nbsp; <i class="fa fa-plus" style="cursor:pointer" data-area="{!!$area->id!!}"></i></h6>
															
									<div class="table-responsive">
										<table class="table table-striped dataTable no-footer table-short">

											@foreach(\App\OrderDetail::where('order_id', $order->id)->whereHas('service', function($q) use ($area) {
                                    $q->where('area_id', $area->id);
                                 })->get() as $detail)

												<tr>
													<td style="width:50%">
														<div class="form-group required" aria-required="true" style="float:left; display:inline-block; margin-left:10px">
															<select name="service[]" class="form-control service-selection">
																<option><i> - </i></option>
																<option selected value="{!!$detail->service_id!!}">{!!$detail->service->name!!}</option>
																@foreach(\App\Service::where('area_id', $area->id)->get() as $service)
																	@if ($service->id != $detail->service_id)
																		<option value="{{ $service->id }}">{{ $service->name }}</option>
																	@endif
																@endforeach
															</select>
														</div>
													</td>
													<td style="width:20%" class="theprice">
														<div class="form-group required" aria-required="true">
															<p class="form-control supplier-price" style="color:#666">{!!$detail->service->price!!}</p>
														</div>
													</td>
													<td style="width:20%">
														<div class="form-group required" aria-required="true">
															<input type="number" name="total[]" step="0.01" value="{!!$detail->price!!}" class="form-control totals"/>
														</div>
													</td>
													<td style="width:10%" class="remove-button-container">
														<button class="btn btn-default remove-line" type="button" style="border-radius:100px"><i class="fa fa-trash"></i></button>
													</td>
												</tr>

                                 @endforeach

										</table>
									</div>

								@endforeach

                        <br>

                        <div class="table-responsive" style="background-color:#10CFBD">
                           <table class="table table-striped dataTable no-footer table-short">
                              <tr>
                                 <td style="width:50%">
                                 </td>
                                 <td style="width:20%" id="supplier-total-sum">
                                    {!!$order->supplierTotal()!!}
                                 </td>
                                 <td style="width:20%" id="total-sum">
                                    {!!$order->total()!!}
                                 </td>
                                 <td style="width:10%">
                                 </td>
                              </tr>
                           </table>
                        </div>

									<br>
									{!!Form::submit('SALVA', ['class'=>'btn btn-danger', 'style'=>'float:right; padding-left:30px; padding-right:30px'])!!}
									<a href="{!!URL::previous()!!}" class="btn btn-warning" style="float:right; margin-right:10px"> Indietro </a> 
							{!!Form::close()!!}
						</div>
					</div>
				</div>
			</div>
		  <!-- END PANEL -->
	 	</div>
	 </div>
</div>
<!-- END PAGE CONTENT -->

@foreach (\App\Area::all() as $area)
	<div id="areaOptions-{!!$area->id!!}" style="display:none">
		@foreach ($area->services as $service)
			<option value="{!!$service->id!!}">{!!$service->name!!}</option>
		@endforeach
	</div>
@endforeach

@include('scripts.orders')

@stop