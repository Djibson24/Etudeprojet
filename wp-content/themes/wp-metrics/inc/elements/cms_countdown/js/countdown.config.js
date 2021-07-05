jQuery( document ).ready(function($) {
	var el = document.getElementById('getting-started');
	var count_down = el.getAttribute("data-count-down");

 	$('#getting-started').countdown(count_down, function(event) {
   		var $this = $(this).html(event.strftime(''
     	+ '<div class="col-xs-12 col-sm-6 col-md-3"><div class="countdown-item-container"><h4 class="countdown-amount">%S</h4><div class="countdown-period">Seconds</div></div></div>'
     	+ '<div class="col-xs-12 col-sm-6 col-md-3"><div class="countdown-item-container"><h4 class="countdown-amount">%M</h4><div class="countdown-period">Minutes</div></div></div>'
     	+ '<div class="col-xs-12 col-sm-6 col-md-3"><div class="countdown-item-container"><h4 class="countdown-amount">%H</h4><div class="countdown-period">Hours</div></div></div>'
     	+ '<div class="col-xs-12 col-sm-6 col-md-3"><div class="countdown-item-container"><h4 class="countdown-amount">%D</h4><div class="countdown-period">Days</div></div></div>'));
 	});

});