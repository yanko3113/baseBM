function quantumAlert(options) {
	var ops = jQuery.extend({
		title: 			'', 
		message:       	'Mensaje',
		type:        	'alert',
		timeout: 		0,
		timer: 			10,
		url: null
	}, options);
	var cls = '';
	var msg = '<div class="production_report">';
	if (ops.title) {
		cls = ops.message ? '' : ' class="alone"'
		msg += '<h1'+cls+'>'+ops.title+'</h1>';
	}
	if (ops.message) {
		msg += '<p'+cls+'>'+ops.message+'</p>';
	}
	msg += '</div>';
	growl = $.growl(
		{
			message: msg,
			url: ops.url
		},
		{
			type: 'production '+ops.type,
			// timer: 1000000,
			offset: {
				y:20,
				x:20
			},
			stackup_spacing: 1,
			timer: ops.timer * 1000
		}
	);
}

function showError(title, message) {
	quantumAlert({
		title: title,
		message: message,
		duration: 10
	});
}