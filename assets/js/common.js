$(document).ready(function(){
	$('form#ajax').submit(function(e){

		e.preventDefault();

		var that = $(this),
			messageBox = $('#validation-messages');

		messageBox.addClass('hidden');

		$('[type=submit]').attr('disabled', 'disabled');

		$.post(that.attr('action'), that.serialize())

		.done(function(response){
			if(!response.result){
				messageBox.removeClass('hidden')
					.find('ul')
					.html('<h4>Please review the following errors:</h4><li>'+response.errors.join('</li><li>')+'</li>');
				$('html, body').animate({scrollTop: 0}, 'slow');
				return;
			}
			window.location.href = $('#back').attr('href');
		})
		.fail(function(){
			alert('An internal error has occured. Please try again in a few moment.');
		})
		.always(function(){
			$('[type=submit]').removeAttr('disabled');
		});

	});

	$('#entries').on('click', '.remove-line', function(){
		if(!confirm('Are you sure?')) return;

		var URL = $('#entries').data('delete-url')
			tr = $(this).closest('tr'),
			id = tr.data('pk'),
			data = {};

		data.id = id;
		data[$('#entries').data('csrf-name')] = $('#entries').data('csrf-hash');

		$.post(URL, data)
		.done(function(response){
			if(response.result){
				tr.remove();
				return;
			}
			alert('Unable to perform action due to an unknown error!');
		})
		.fail(function(response){
			alert('Unable to perform action due to an unknown error!');
		})
	})

	$('.new-line').click(function(){

		var $this = $(this);

		var tr = $this.closest('table').find('tbody tr');

		if(tr.hasClass('hidden')){
			tr.removeClass('hidden').find('input,select').removeAttr('disabled');
			return;
		}

		var clone = $(tr[0]).clone();
		clone.find('[type=hidden]').remove();
		clone.find('input,select').val('');

		clone.appendTo($this.closest('table').find('tbody'));
	});

	$('[data-click=new-line]').click(function(){

		var $this = $(this);

		var tr = $this.closest('table').find('tbody tr');

		if(tr.hasClass('hidden')){
			tr.removeClass('hidden').find('input,select').removeAttr('disabled');
			return;
		}

		var clone = $(tr[0]).clone();
		clone.find('[type=hidden]').remove();
		clone.find('input,select').val('');

		clone.appendTo($this.closest('table').find('tbody'));
	});

	$('.content').on('click', '[data-click=remove-line]', function(){

		var rows = $(this).closest('tbody').find('tr');

		if(rows.length === 1){
			rows.find('input,select').val('').attr('disabled', 'disabled')
			rows.find('[type=hidden]').remove();
			rows.addClass('hidden');
		}else{
			$(this).closest('tr').remove();
		}

	});


	$('.timepicker').timepicker({ disableFocus: false, defaultTime: false });
	
	$('#login_type').change(function(){
		if($(this).val() === 's'){
			$('.timeshifts').slideDown();
		}else{
			$('.timeshifts').slideUp();
		}
	}).trigger('change');

	$('.content').on('blur', '.pformat', function(){
		$(this).val(function(){
			return numeral($(this).val()).format('0,0.00');
		});
	});
	

	$('.content').on('focus', '.pformat', function(){
		$(this).val(function(){
			return numeral().unformat($(this).val());
		}).select();
	});

	$('.has-calculation').on('blur', 'input.variable', function(){
		var total = 0;
		$(this).closest('.has-calculation').find('input.variable')
		.each(function(){
			switch($(this).data('action')){
				case 'add': 
					total += numeral().unformat($(this).val());
					break;
				case 'subtract':
					total -= numeral().unformat($(this).val());
					break;
			}
		})
		$(this).closest('.has-calculation').find('.total').text(numeral(total).format('0,0.00'));
	});

	$('.pformat').trigger('blur');
	$('input.variable').trigger('blur');




})