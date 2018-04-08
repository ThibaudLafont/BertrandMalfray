// After load
$(document).ready(function(){
    handleToggleCat('#project-details');
});
// on resize
var width = $(window).outerWidth();
$(window).resize(function(){
    if($(this).outerWidth() !== width) {
        // Store new width
        width = $(this).outerWidth();

        // Reset Jquery conf
        resetCatDet('#project-details');

        // Handle toggle
        handleToggleCat('#project-details');
    }
});