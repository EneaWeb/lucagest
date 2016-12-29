<?php $__env->startSection('content'); ?>

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
					<div class="panel-title">Modifica Ordine # <?php echo $order->id; ?>

					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
													
							<?php echo Form::open(['url'=>'/orders/new/save', 'method'=>'POST', 'id'=>'form-work', 'role'=>'form', 'autocomplete'=>'off', 'novalidate'=>'novalidate', 'class'=>'form-horizontal']); ?>


							<?php echo Form::hidden('order_id', $order->id); ?>


								<div class="form-group">
									<label for="customer_name" class="col-sm-3 control-label">Nome cliente</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="customer_name" placeholder="Nome e Cognome del cliente" name="customer_name" required="" aria-required="true" value="<?php echo $order->customer_name; ?>">
									</div>
								</div>

								<div class="form-group">
									<label for="customer_contact" class="col-sm-3 control-label">Indirizzo Email Cliente</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" id="customer_email" placeholder="indirizzo email" name="customer_email" required="" aria-required="true" value="<?php echo $order->customer_email; ?>">
									</div>
								</div>

								<div class="form-group">
									<label for="customer_contact" class="col-sm-3 control-label">Altre informazioni cliente</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="customer_contact" placeholder="Indirizzo, n. Telefono, ecc" name="customer_contact" required="" aria-required="true" value="<?php echo $order->customer_contact; ?>">
									</div>
								</div>

								<div class="form-group">
									<label for="customer_contact" class="col-sm-3 control-label">Note</label>
									<div class="col-sm-9">
										<textarea name="notes" class="form-control summernote"><?php echo $order->notes; ?></textarea>
									</div>
								</div>

								<div class="form-group">
									<label for="payed" class="col-sm-3 control-label">Pagato</label>
									<div class="col-sm-9">
										<input type="checkbox" class="checkbox" name="payed" value="1" <?php if($order->payed == 1): ?> checked="checked" <?php endif; ?>/>
									</div>
								</div>

								<br>

								<table class="table table-striped dataTable no-footer">
									<tr>
										<th style="<?php if(\App\Option::showSupplierPrices()): ?>width:50% <?php else: ?> width:70%<?php endif; ?>">Servizio</th>
										<?php if(\App\Option::showSupplierPrices()): ?><th style="width:20%">Costo fornitore</th><?php endif; ?>
										<th style="width:20%">Costo totale</th>
										<th style="width:10%">Opzioni</th>
									<tr>
								</table>
								<br>

								<?php $__currentLoopData = \App\Area::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

									<h6><b><?php echo $area->name; ?></b> &nbsp; &nbsp; <i class="fa fa-plus" style="cursor:pointer" data-area="<?php echo $area->id; ?>"></i>	</h6>
									
									<?php $__currentLoopData = $order->details->where('area_id', $area->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

										<div class="table-responsive">
											<table class="table table-striped dataTable no-footer table-short">
												<tr>
													<td style="<?php if(\App\Option::showSupplierPrices()): ?>width:50% <?php else: ?> width:70%<?php endif; ?>">
														<div class="form-group required" aria-required="true" style="float:left; display:inline-block; margin-left:10px">
															<select name="service[]" class="form-control service-selection">
																<option value="<?php echo $detail->name; ?>&area_id=<?php echo $detail->area_id; ?>" selected><?php echo $detail->name; ?></option>
																<?php $__currentLoopData = \App\Service::where('area_id', $area->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																	<?php if($service->name !== $detail->name): ?>
																		<option value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
																	<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</select>
														</div>
													</td>
													<?php if(\App\Option::showSupplierPrices()): ?>
														<td style="width:20%" class="theprice">
															<div class="form-group required" aria-required="true">
																<input type="number" name="supplier_price[]" step="0.01" class="form-control supplier-price" style="max-width:90%; color: #717171;" value="<?php echo $detail->supplier_price; ?>"/>
															</div>
														</td>
													<?php else: ?>
														<td style="width:0px; padding:0px; margin:0px" class="theprice">
															<input type="number" name="supplier_price[]" step="0.01" value="<?php echo $detail->supplier_price; ?>" style="display:none!important"/>
														</td>
													<?php endif; ?>
													<td style="width:20%" class="totalprice">
														<div class="form-group required" aria-required="true">
															<input type="number" name="total_price[]" step="0.01" value="<?php echo $detail->total_price; ?>" class="form-control totals" style="max-width:90%"/>
														</div>
													</td>
													<td style="width:10%; text-align:center" class="remove-button-container">
														<button class="btn btn-default remove-line" type="button" style="border-radius:100px;"><i class="fa fa-trash"></i></button>
													</td>
												</tr>
											</table>
										</div>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

								<br>

                        <div class="table-responsive" style="background-color:#10CFBD">
                           <table class="table table-striped dataTable no-footer table-short">
                              <tr>
                                 <td style="<?php if(\App\Option::showSupplierPrices()): ?>width:50% <?php else: ?> width:70%<?php endif; ?>">
                                 </td>
											<?php if(\App\Option::showSupplierPrices()): ?>
												<td style="width:20%" id="supplier-total-sum">
												</td>
											<?php endif; ?>
                                 <td style="width:20%" id="total-sum">
                                 </td>
                                 <td style="width:10%">
                                 </td>
                              </tr>
                           </table>
                        </div>

								<br>
								<?php echo Form::submit('SALVA', ['class'=>'btn btn-danger', 'style'=>'float:right; padding-left:30px; padding-right:30px; margin:4px;']); ?>

							<?php echo Form::close(); ?>


							<button type="submit" onclick="window.open('/order/pdf/<?php echo $order->id; ?>')" class="btn btn-info" style="float:right; padding-left:30px; padding-right:30px; margin:4px;">
								PDF &nbsp;<i class="fa fa-file-pdf-o"></i>
							</button>

							<?php echo Form::open(['url'=>'/order/sendmail', 'method'=>'POST']); ?>

								<?php echo Form::hidden('order_id', $order->id); ?>

								<button type="submit" class="btn btn-info" style="float:right; padding-left:30px; padding-right:30px; margin:4px;">
									EMAIl &nbsp;<i class="fa fa-envelope"></i>
								</button>
							<?php echo Form::close(); ?>

						</div>
					</div>
				</div>
			</div>
		  <!-- END PANEL -->
	 	</div>
	 </div>
</div>
<!-- END PAGE CONTENT -->

<?php $__currentLoopData = \App\Area::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	<div id="areaOptions-<?php echo $area->id; ?>" style="display:none">
		<?php $__currentLoopData = $area->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<option value="<?php echo $service->id; ?>"><?php echo $service->name; ?></option>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<?php echo $__env->make('scripts.orders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>