<script>

	function sumSupplierTotal()
	{
		var sum = 0;
		$('.supplier-price').each(function(){
			if ($(this).val() != '' && $(this).val() != NaN)
				sum += parseFloat($(this).val());
		});
		$('#supplier-total-sum').html(sum.toFixed(2));
	}

	function sumTotal()
	{
		var sum = 0;
		$('.totals').each(function(){
			if (this.value != '' && this.value != NaN)
				sum += parseFloat(this.value);
		});
		$('#total-sum').html(sum.toFixed(2));
	}

	$(document).on('input', '.totals', function() { 
		sumSupplierTotal();
		sumTotal();
	});

	$(document).on('change', '.service-selection', function(){

		var elem = $(this);
		serviceId = elem.val();
		var price = elem.parent().parent().parent().find('.theprice').find('input');
		var totalPrice = elem.parent().parent().parent().find('.totalprice').find('input');

		if (serviceId !== '-'.trim()) {

			$.ajax({
				method: "GET",
				url: "/api/get-servce-supplier-price",
				data: { serviceId: serviceId }
			})
			.done(function( msg ) {
				price.val(msg);
				totalPrice.val('0.00');
				sumSupplierTotal();
				sumTotal();
			})
			.error(function(){
				alert('ajax error');
			});
		} else {
			price.html('');
		}

	})

	$(document).on('click', '.clear-line', function(){
		var line = $(this).parent().parent();
		line.find('input').val('');
		line.find('.supplier-price').html('');
		line.find('select').val('');

		sumSupplierTotal();
		sumTotal();
	});

	$(document).on('click', '.remove-line', function(){
		var line = $(this).parent().parent();
		line.empty()

		sumSupplierTotal();
		sumTotal();

	});

	$(document).ready(function(){
		$('.fa-plus').click(function(){
			var table = $(this).parent().next('div.table-responsive').find('table');
			var areaId = $(this).attr('data-area');
			var options = $('#areaOptions-'+areaId).html();
			@if(\App\Option::showSupplierPrices())
				var newTR = '<tr>\
						<td style="width:50%">\
							<div class="form-group required" aria-required="true" style="float:left; display:inline-block; margin-left:10px">\
								<select name="service[]" class="form-control service-selection">\
									<option selected=""> - </option> '+ options +'\
								</select>\
							</div>\
						</td>\
						<td style="width:20%" class="theprice">\
							<div class="form-group required" aria-required="true">\
								<input type="number" name="supplier_price[]" step="0.01" value="" class="form-control supplier-price" style="max-width:90%; color: #717171;" />\
							</div>\
						</td>\
						<td style="width:20%" class="totalprice">\
							<div class="form-group required" aria-required="true">\
								<input type="number" name="total_price[]" step="0.01" value="" class="form-control totals" style="max-width:90%">\
							</div>\
						</td>\
						<td style="width:10%; text-align:center" class="remove-button-container">\
							<button class="btn btn-default remove-line" type="button" style="border-radius:100px"><i class="fa fa-trash"></i></button>\
						</td>\
						</tr>';
			@else
				var newTR = '<tr>\
						<td style="width:70%">\
							<div class="form-group required" aria-required="true" style="float:left; display:inline-block; margin-left:10px">\
								<select name="service[]" class="form-control service-selection">\
									<option selected=""> - </option> '+ options +'\
								</select>\
							</div>\
						</td>\
						<td style="width:0px; padding:0px; margin:0px" class="theprice">\
							<input type="number" name="supplier_price[]" step="0.01" value="" style="display:none!important"/>\
						</td>\
						<td style="width:20%" class="totalprice">\
							<div class="form-group required" aria-required="true">\
								<input type="number" name="total_price[]" step="0.01" value="" class="form-control totals" style="max-width:90%">\
							</div>\
						</td>\
						<td style="width:10%; text-align:center" class="remove-button-container">\
							<button class="btn btn-default remove-line" type="button" style="border-radius:100px"><i class="fa fa-trash"></i></button>\
						</td>\
						</tr>';
			@endif
			table.append(newTR);
		});

		sumSupplierTotal();
		sumTotal();

	})
	
</script>