	<link rel="stylesheet" href="public/lib/jquery-ui-1.10.3.custom/development-bundle/themes/base/jquery.ui.all.css">
	<script src="public/lib/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script>
	$(function() {
		$( "#from" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
		$( "#from" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#to" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	});
	</script>
