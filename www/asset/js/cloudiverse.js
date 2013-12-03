/*
 * cloudiverse.js
 */
$(document).ready(function() {
    // setup refresh button and add button
    $('#loginSubmitBtn').click(function() {
		alert($("#loginAccount").val());
		alert($("#loginPassword").val());
    });
});

/* A function used to set the value of the progress bar.
 *
 * value:           a value between 0 and 1.
 * jQueryObj:       the jQueryObj variable identifying that progress bar.
 * afterFunction:   the function that gets called after the animation is complete.
 */
function setProgressBar(value, jQueryObj, afterFunction) {
    jQueryObj.stop();
    width100 = jQueryObj.width();
    jQueryObj.find(".status").animate({width: width100 * value}, 2000, afterFunction);
}