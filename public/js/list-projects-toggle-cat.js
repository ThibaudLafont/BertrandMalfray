// After load
$(document).ready(function(){
    handleToggleCat('#right-cat-col');
});

// on resize
var oldWidth = $(window).outerWidth();
$(window).resize(function(){
    if($(this).outerWidth() !== oldWidth) {
        // Store new width
        oldWidth = $(this).outerWidth();

        // Reset Jquery conf
        resetCatDet('#right-cat-col');

        // Handle toggle
        handleToggleCat('#right-cat-col');
    }
});