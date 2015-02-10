$(function(){

	var debug = true;

	$('.trigger-popover').popover({
		//trigger: 'focus'
  	});

	$('th, td').tooltip();

	$('.toggle-checkboxes').on('click', function(){
		var c = $(this).attr('data-class');
		var s = this.checked;
		$('.' + c).each(function(){
			this.checked = s;
		});
	});

	$('.field-date').datepicker({
		format: "dd.mm.yyyy",
		todayBtn: "linked",
		todayHighlight: true,
		calendarWeeks: true,
		language: "et"
	});

	$('.field-month').datepicker({
		format: "mm",
		viewMode: "months",
		minViewMode: "months",
		autoclose: true,
		language: "et"
	});

	$('.field-year').datepicker({
		format: "yyyy",
		viewMode: "years",
		minViewMode: "years",
		autoclose: true,
		language: "et"
	});

	$('#month-picker').datepicker({
		viewMode: "months",
		minViewMode: "months",
		autoclose: true,
		language: "et"
	}).on('changeDate', function(ev) {
		if (ev.date) {
			var month = ev.date.getMonth() + 1;
			var year = ev.date.getFullYear();
			var lastDayDate = new Date(year, month, 0);
			var lastDay = lastDayDate.getDate();

			if (month.toString().length == 1) {
				month = "0" + month.toString();
			}
			$('input[name="date_from"]').val('01.' + month + '.' + year);
			$('input[name="date_to"]').val(lastDay + '.' + month + '.' + year);
		}
	});

	$('#expand-filter').click(function() {
		if ($('#additional-params').hasClass('hidden')) {
			$('#additional-params').removeClass('hidden');
			// Turn arrow around
			$(this).find('.fa-caret-down').addClass('hidden');
			$(this).find('.fa-caret-up').removeClass('hidden');
		} else {
			$('#additional-params').addClass('hidden');
			// Turn arrow around
			$(this).find('.fa-caret-down').removeClass('hidden');
			$(this).find('.fa-caret-up').addClass('hidden');
		}
	});

	$(".field-select").select2({
		width: 110,
		allowClear: true,
		dropdownCssClass : 'bigdrop'
	});
	$(".field-select-bigger").select2({
		width: 190,
		allowClear: true,
		dropdownCssClass : 'bigdrop'
	});
	$(".field-select-large").select2({
		width: 250,
		allowClear: true,
		dropdownCssClass : 'bigdrop'
	});

	$('.ask-confirm').on('click', function(){
		return confirm('Oled kindel?');
	});

	$('body').on('click', '[data-action="filter/submit"]', function(e){
		e.preventDefault();
		$('#page-input').val('1');
		$('#filter-form').submit();
	});
	$('body').on('click', '[data-action="invoice_user/edit"]', function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var user_id = $(this).attr('data-user-id');
		$('#sum-'+id).addClass('hidden');
		$('#sum-edit-'+id).removeClass('hidden');
		$('#user-'+id).addClass('hidden');
		$('#user-edit-'+id).removeClass('hidden');
		$('#edit-id').val(id);
		$('#edit-user-id').val(user_id);
		// $('#sum-field-'+id).select();
	});
	$('body').on('click', '[data-action="invoice_user/edit/cancel"]', function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('#sum-'+id).removeClass('hidden');
		$('#sum-edit-'+id).addClass('hidden');
		$('#user-'+id).removeClass('hidden');
		$('#user-edit-'+id).addClass('hidden');
	});

	$('body').on('click', '[data-action="invoice_row/edit"]', function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// Close other opened edit views
		$('#invoice-row-id').val(null);
		$('.invoice-row-view').removeClass('hidden');
		$('.invoice-row-edit').addClass('hidden');
		// Open edit view
		$('.invoice-row-view-'+id).addClass('hidden');
		$('.invoice-row-edit-'+id).removeClass('hidden');
		$('#invoice-row-id').val(id);

		var invoiceUserId = $(this).attr('data-id');
		console.log(invoiceUserId);
		$('#modal-confirm-comment .invoice-user-id').val(invoiceUserId);
	});
	$('body').on('click', '[data-action="invoice_row/edit/cancel"]', function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('.invoice-row-view-'+id).removeClass('hidden');
		$('.invoice-row-edit-'+id).addClass('hidden');
		$('#invoice-row-id').val(null);
	});

	$('body').on('click', '[data-action="popover/close"]', function(e){
		e.preventDefault();
		$('.trigger-popover').popover('hide');
	});

	$('body').on('click', '[data-action="invoice_user/edit"]', function(){
		var invoiceUserId = $(this).attr('data-id');
		var toUserId = $('#new-user-id').val();
		$('#modal-confirm-comment .invoice-user-id').val(invoiceUserId);
		$('#modal-confirm-comment .to-user-id').val(toUserId);
	});

	$('body').on('click', '[data-action="invoice_row/delete"]', function(){
		var invoiceRowId = $(this).attr('data-id');
		var toUserId = $(this).attr('user-id');
		$('#modal-delete-row-comment .invoice-row-id').val(invoiceRowId);
		$('#modal-delete-row-comment .to-user-id').val(toUserId);
	});

	$('body').on('click', '[data-action="invoice_user/delete"]', function(){
		var invoiceUserId = $(this).attr('data-id');
		var toUserId = $(this).attr('user-id');
		$('#modal-delete-comment .invoice-user-id').val(invoiceUserId);
		$('#modal-delete-comment .to-user-id').val(toUserId);
	});

	$('body').on('submit', '[data-action="mail/send"]', function(e){
		e.preventDefault();
		var form = $(this);
		console.log(form);
		form.find('button[type="submit"]').prop('disabled', true);
		$.ajax({
			type: 'POST',
			url: base_url + 'api/msg/send',
			data: form.serialize()
		})
		.done(function(data) {
			form.not('#message-form').find('textarea').prop('disabled', true);
			form.not('#message-form').find('button[type="submit"]').addClass('hidden');
			form.not('#message-form').find('.msg-error').addClass('hidden');
			form.not('#message-form').find('.msg-success').removeClass('hidden');
			// for msg modal
			$('#messages').modal('hide');
		})
		.fail(function(xhr) {
			var err = eval("(" + xhr.responseText + ")");
			console.log(err.msg);
			if(err.msg) {
				//alert(err.msg);
				form.find('.msg-error').html(err.msg);
				form.find('.msg-error').removeClass('hidden');
			} else {
				alert('Oops... midagi läks valesti. Palun proovi uuesti.');
			}
			if(debug) console.log(xhr.responseText);
		})
		.always(function(){
			form.find('button[type="submit"]').removeAttr('disabled');
		});
	});

	$('body').on('click', '[data-action="msg/panel/open"]', function(e){
		e.preventDefault();
		$.ajax({
			type: 'GET',
			url: base_url + 'api/msg/panel'
		})
		.done(function(data) {
			$('.msgs-content').html(data);
		})
		.fail(function(data) {
			alert('Oops... midagi läks valesti. Palun proovi uuesti.');
			if(debug) console.log(data);
		});
	});

	/**
	 * Filter
	 */
	$('.select-quick-date').on('click', function(e){
		e.preventDefault();
		var form = $(this).closest('form');
		var date_from = $(this).attr('data-from');
		var date_to = $(this).attr('data-to');
		form.find('[name="date_from"]').val(date_from);
		form.find('[name="date_to"]').val(date_to);
	});

	$('.open-confirm-comment-modal').keydown(function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			$('#modal-confirm-comment').modal('show');
		}
	});

	$('#first-page').click(function(e) {
		e.preventDefault();
		$('#page-input').val(1);
		$('#filter-form').submit();
	});

	$('#next-page').click(function(e) {
		e.preventDefault();
		var prevVal = parseFloat($('#page-input').val());
		$('#page-input').val(prevVal + 1);
		$('#filter-form').submit();
	});

	$('#prev-page').click(function(e) {
		e.preventDefault();
		var prevVal = parseFloat($('#page-input').val());
		$('#page-input').val(prevVal - 1);
		$('#filter-form').submit();
	});

	$('#last-page').click(function(e) {
		e.preventDefault();
		var lastPageVal = parseFloat($('#page-last').val());
		$('#page-input').val(lastPageVal);
		$('#filter-form').submit();
	});

	$('#toggle-check').change(function(){
		$('input[name="invoices[]"]').prop('checked', this.checked);
	});

	$('#checkall').click(function() {
		$('.checkall').prop('checked', this.checked);
	});
	$('.user-filter').change(function() {
		var form = $('[data-action="building/filter_by_user"]');
		form.find('input[name="page"]').val('1');
		form.submit();
	});

	$('.delete-file').click(function() {
		$.ajax({
			type: 'GET',
			url: base_url + 'api/deletefile',
			context: this,
			data: {
				'file_id' : $(this).attr('data-file-id')
			}
		})
		.done(function(data) {
			$(this).parent().fadeOut();
		});
	});
});
