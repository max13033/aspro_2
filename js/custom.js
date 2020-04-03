/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/
$(document).ready(function () {
    $(function() {
        $('.js-lazy__static').lazy();

        $('.js-lazyload-second-slider').lazy();

        $('.js-lazyload-popular-catalog').lazy();
    });
})

BX.addCustomEvent("onFrameDataReceived" , function(json) {

    $('.js-lazy__static').lazy();

}); 