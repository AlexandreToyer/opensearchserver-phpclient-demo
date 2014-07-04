

$(document).ready(function() {
	$('body').on('submit', 'form', function(e) {
		e.preventDefault();
		console.log($(this));
		$.post($(this).attr('action'), $(this).serialize(), function(data, textStatus) { 
			//dump result
			console.log(data);
			if(data.success) {
				var success = '<span class="label label-success">Success</span>'
			} else { 
				var success = '<span class="label label-danger">Error</span>'
			}
			$('.results:visible').append('<div class="results-call">'+success+'<pre class="prettify lang-json">'+JSON.stringify(data, undefined, 2)+'</pre></div');
		}, "json");
		
		
	});
}); 



