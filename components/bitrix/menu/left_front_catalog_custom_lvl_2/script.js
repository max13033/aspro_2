$(document).ready(function(){

var $slider = $('#track .courusel');

$slider.on('init', () => {
		mouseWheel($slider)
	}).slick({
  	infinite: false, 
	adaptiveHeight: true,
	  vertical:true,
	  verticalSwiping:false,
	  slidesToShow: 12,
	  slidesToScroll: 6,
	  prevArrow: $('#track .prev'),
	  nextArrow: $('#track .next')
});

function mouseWheel($slider) {
	$slider.off('wheel').on('wheel', { $slider: $slider }, mouseWheelHandler);
}
function mouseWheelHandler(event) {
	event.preventDefault()
	const $slider = event.data.$slider
	const delta = event.originalEvent.deltaY
	if(delta < 0) {
		$slider.slick('slickPrev')
	}
	else {
		$slider.slick('slickNext')
	}
}


})