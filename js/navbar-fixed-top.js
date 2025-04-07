/**

	HTML Landing Pages Pack

  - Version: 1.0

  - 2021
  
  - Author: fronthemes
  
  - https://fronthemes.com

 */

 /*=====================================================
 =            JAVASCRIPT - NAVBAR FIXED-TOP            =
 =====================================================*/

// Page scroll effect
$(function() {
  $(document).on('click', 'a.page-scroll', function(event) {
    var $anchor = $(this);
    	$('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top-79
    	}, 300, 'easeInOutExpo');
    event.preventDefault();
  });
});