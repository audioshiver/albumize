// timed interval
var interval;
// keep track of width
var width;
// resize image on browser resize
var resize_on_fly = true;

$(document).ready(function(){
	// show items that are hidden for non-js browsers
	$('.js_show').show();
	
	// do resize logic
	resize_images();
	
	// do resize logic on browser resize
	if(resize_on_fly) {
		$(window).resize(function() {
			// if the interval is not in process
			if(!interval) {
				// start the interval to check the width
				interval = setInterval(check_width, 500);
			}
		});
	}
 });
 
 /**
  * Check Width funtion
  *
  * Checks the width of the browser at regular intervals
  * and only fires the resize_image function when the resizing
  * has finished. Prevents loads of Ajax calls if browser
  * is being dragged
  */
 function check_width() {
	if(width != $(window).width()) {
		width = $(window).width();
		resize_images();
	} else {
		clearInterval(interval);
		interval = null;
	}
 }
 
 /**
  * Resize Images function
  *
  * Loops through all images with a resize class fires off
  * an Ajax call to determine which file to display depending
  * on the browser width
  */
 function resize_images() {
	$('div.resize').each(function(){
		var e = $(this);
		$.ajax({
			type: "POST",
			url: "func/resize.php",
			data: "width="+$(window).width()+"&image="+e.css('background-image').replace('url(','').replace(')','')+"&rel="+e.attr('rel'),
			success: function(t) {
				e.css('background-image',t);
				e.removeClass('loading_image');
				e.featherlight(t);
			}
		});
	});
 }