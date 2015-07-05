// idleTimer = null;
// idleState = true;
// idleWait = 5000;
(function ($) {
	$(document).ready(function () {

		// setTimeout(function () {
		// 	$(".stb").data('trigger-percentage', 10);
		// }, 1000 );

		// $('*').bind('mousemove keydown scroll', function () {
			
		// 	clearTimeout(idleTimer);

		// 	idleTimer = setTimeout(function () { 
		// 		if( idleState ){
		// 			$(".stb").slideToggle( 'slow' );
		// 			// $(".stb").data('trigger', 'percentage');
		// 			// console.info('ON');
		// 		}
		// 		idleState = false;
		// 	}, idleWait);

		// });

		// $("body").trigger("mousemove");

		// $(".stb-close").click(function(){
		// 	$(".stb").slideToggle( 'slow' );
		// });


		// Mobile thumbnails slider
    // $('.product-in-mobile').iosSlider({
    //   autoSlide: false
    // });

$('.product-in-mobile').flexslider({
	animation: 'slide',
	slideshow: false,
	controlNav: false,
	directionNav: true,
	slideshowSpeed: 7000,
	animationSpeed: 600,
	initDelay: 0,
	touch: true,
    start: function(slider) { // Fires when the slider loads the first slide
    	var slide_count = slider.count - 1;

    	$(slider)
    	.find('img.flazy:eq(0)')
    	.each(function() {
    		var src = $(this).attr('data-src');
    		$(this).attr('src', src).removeAttr('data-src');
    	});
    },
    before: function(slider) { // Fires asynchronously with each slider animation
    	var slides     = slider.slides,
    	index      = slider.animatingTo,
    	$slide     = $(slides[index]),
    	$img       = $slide.find('img[data-src]'),
    	current    = index,
    	nxt_slide  = current + 1,
    	prev_slide = current - 1;

    	$slide
    	.parent()
    	.find('img.flazy:eq(' + current + '), img.flazy:eq(' + prev_slide + '), img.flazy:eq(' + nxt_slide + ')')
    	.each(function() {
    		var src = $(this).attr('data-src');
    		$(this).attr('src', src).removeAttr('data-src');
    	});
    }
  });



// EVENT SLIDER

$(".ps-right").click(function(){
  var i = $(this).siblings('.events-wrap');
  if( i.position().left > -1896 ){
    i.animate({ left: "-=300" }, 1000);
  }
});
$(".ps-left").click(function(){
  var i = $(this).siblings('.events-wrap');
  if( i.position().left < -397 ){
    i.animate({ left: "+=300" }, 1000);
  }
});

$('.events-nav span').click(function(){
  $('.events-nav span').removeClass('active');
  $(this).addClass('active');

  var lf = $(this).data('left');
  $('.events-wrap').animate({ left: lf }, 1000);
});

// $('#events').flexslider({
//   animation: "slide",
//   reverse: true,
//   slideshow: false,
//   controlNav: true,
//   directionNav: true,
//   animationLoop: false,
//   itemWidth: 320,
//   itemMargin: 0,
//   maxItems: 2,
//   minItems: 1
// });



// Turn off all dependent fields
$('#pfbc-element-2-0, #pfbc-element-3, #pfbc-element-4-0, #pfbc-element-5, #pfbc-element-6-0, #pfbc-element-7, #pfbc-element-8, #pfbc-element-9').closest('.control-group').hide('500');

// Instagram
$("#pfbc-element-1-0").change(function() {
  $(this).closest('.controls').find('.checkbox').toggle(500);
  $(this).parent().toggle(500);
  $('#pfbc-element-2-0').closest('.control-group').toggle(500);
});
// Instagram - Other
$("#pfbc-element-2-1").change(function() {
  $('#pfbc-element-3').closest('.control-group').toggle(500);
});


// Facebook
$("#pfbc-element-1-1").change(function() {
  $(this).closest('.controls').find('.checkbox').toggle(500);
  $(this).parent().toggle(500);
  $('#pfbc-element-4-0').closest('.control-group').toggle(500);
});
// Facebook - Other
$("#pfbc-element-4-1").change(function() {
  $('#pfbc-element-5').closest('.control-group').toggle(500);
});


// Blog Post
$("#pfbc-element-1-4").change(function() {
  $(this).closest('.controls').find('.checkbox').toggle(500);
  $(this).parent().toggle(500);
  $('#pfbc-element-6-0').closest('.control-group').toggle(500);
});
// Blog Post - Other
$("#pfbc-element-6-1").change(function() {
  $('#pfbc-element-7').closest('.control-group').toggle(500);
});


// Recommendation
$("#pfbc-element-1-6").change(function() {
  $(this).closest('.controls').find('.checkbox').toggle(500);
  $(this).parent().toggle(500);
  $('#pfbc-element-8').closest('.control-group').toggle(500);
});


// Other
$("#pfbc-element-1-7").change(function() {
  $(this).closest('.controls').find('.checkbox').toggle(500);
  $(this).parent().toggle(500);
  $('#pfbc-element-9').closest('.control-group').toggle(500);
});

}); // document.ready

})(jQuery);