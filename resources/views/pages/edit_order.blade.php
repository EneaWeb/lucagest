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
										<input type="text" class="form-control" id="customer_name" placeholder="Nome e Cognome del cliente" name="customer_name" required="" aria-required="true" value="{!!$order->customer_name!!}">
									</div>
								</div>

								<div class="form-group">
									<label for="customer_contact" class="col-sm-3 control-label">Indirizzo Email Cliente</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" id="customer_email" placeholder="indirizzo email" name="customer_email" required="" aria-required="true" value="{!!$order->customer_email!!}">
									</div>
								</div>

								<div class="form-group">
									<label for="customer_contact" class="col-sm-3 control-label">Altre informazioni cliente</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="customer_contact" placeholder="Indirizzo, n. Telefono, ecc" name="customer_contact" required="" aria-required="true" value="{!!$order->customer_contact!!}">
									</div>
								</div>

								<div class="form-group">
									<label for="customer_contact" class="col-sm-3 control-label">Note</label>
									<div class="col-sm-9">
										<textarea name="notes" class="form-control summernote">{!!$order->notes!!}</textarea>
									</div>
								</div>

								<div class="form-group">
									<label for="payed" class="col-sm-3 control-label">Pagato</label>
									<div class="col-sm-9">
										<input type="checkbox" class="checkbox" name="payed" value="1" @if($order->payed == 1) checked="checked" @endif/>
									</div>
								</div>

								<br>

								<table class="table table-striped dataTable no-footer">
									<tr>
										<th style="@if(\App\Option::showSupplierPrices())width:50% @else width:70%@endif">Servizio</th>
										@if(\App\Option::showSupplierPrices())<th style="width:20%">Costo fornitore</th>@endif
										<th style="width:20%">Costo totale</th>
										<th style="width:10%">Opzioni</th>
									<tr>
								</table>
								<br>

								@foreach(\App\Area::all() as $area)

									<h6><b>{!!$area->name!!}</b> &nbsp; &nbsp; <i class="fa fa-plus" style="cursor:pointer" data-area="{!!$area->id!!}"></i>	</h6>
									
									@foreach($order->details->where('area_id', $area->id) as $detail)

										<div class="table-responsive">
											<table class="table table-striped dataTable no-footer table-short">
												<tr>
													<td style="@if(\App\Option::showSupplierPrices())width:50% @else width:70%@endif">
														<div class="form-group required" aria-required="true" style="float:left; display:inline-block; margin-left:10px">
															<select name="service[]" class="form-control service-selection">
																<option value="{!!$detail->name!!}&area_id={!!$detail->area_id!!}" selected>{!!$detail->name!!}</option>
																@foreach(\App\Service::where('area_id', $area->id)->get() as $service)
																	@if ($service->name !== $detail->name)
																		<option value="{{ $service->id }}">{{ $service->name }}</option>
																	@endif
																@endforeach
															</select>
														</div>
													</td>
													@if(\App\Option::showSupplierPrices())
														<td style="width:20%" class="theprice">
															<div class="form-group required" aria-required="true">
																<input type="number" name="supplier_price[]" step="0.01" class="form-control supplier-price" style="max-width:90%; color: #717171;" value="{!!$detail->supplier_price!!}"/>
															</div>
														</td>
													@else
														<td style="width:0px; padding:0px; margin:0px" class="theprice">
															<input type="number" name="supplier_price[]" step="0.01" value="{!!$detail->supplier_price!!}" style="display:none!important"/>
														</td>
													@endif
													<td style="width:20%" class="totalprice">
														<div class="form-group required" aria-required="true">
															<input type="number" name="total_price[]" step="0.01" value="{!!$detail->total_price!!}" class="form-control totals" style="max-width:90%"/>
														</div>
													</td>
													<td style="width:10%; text-align:center" class="remove-button-container">
														<button class="btn btn-default remove-line" type="button" style="border-radius:100px;"><i class="fa fa-trash"></i></button>
													</td>
												</tr>
											</table>
										</div>

									@endforeach

								@endforeach

								<br>

                        <div class="table-responsive" style="background-color:#10CFBD">
                           <table class="table table-striped dataTable no-footer table-short">
                              <tr>
                                 <td style="@if(\App\Option::showSupplierPrices())width:50% @else width:70%@endif">
                                 </td>
											@if(\App\Option::showSupplierPrices())
												<td style="width:20%" id="supplier-total-sum">
												</td>
											@endif
                                 <td style="width:20%" id="total-sum">
                                 </td>
                                 <td style="width:10%">
                                 </td>
                              </tr>
                           </table>
                        </div>

								<br>
								{!!Form::submit('SALVA', ['class'=>'btn btn-danger', 'style'=>'float:right; padding-left:30px; padding-right:30px; margin:4px;'])!!}
							{!!Form::close()!!}

							<button type="submit" onclick="window.open('/order/pdf/{!!$order->id!!}')" class="btn btn-info" style="float:right; padding-left:30px; padding-right:30px; margin:4px;">
								PDF &nbsp;<i class="fa fa-file-pdf-o"></i>
							</button>

							{!!Form::open(['url'=>'/order/sendmail', 'method'=>'POST'])!!}
								{!!Form::hidden('order_id', $order->id)!!}
								<button type="submit" class="btn btn-info" style="float:right; padding-left:30px; padding-right:30px; margin:4px;">
									EMAIl &nbsp;<i class="fa fa-envelope"></i>
								</button>
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