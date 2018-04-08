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
        handleToggleCat('#project-details');
    }
});