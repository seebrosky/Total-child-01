jQuery(function( $ ){
    
	function fade_home_top() {
		if ( $(window).width() > 800 ) {
        window_scroll = $(this).scrollTop();
	   		$(".rev_slider_text").css({
				  'opacity' : 1-(window_scroll/350)
	    	});
		}
	}
	$(window).scroll(function() { fade_home_top(); });
	
});
