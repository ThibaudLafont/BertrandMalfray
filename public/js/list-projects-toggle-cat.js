// After load
$(document).ready(function(){
    handleToggleCat('#right-cat-col');
});
// on resize
var width = $(window).outerWidth();
$(window).resize(function(){
    if($(this).outerWidth() !== width) {
        // Store new width
        width = $(this).outerWidth();
        handleToggleCat('#right-cat-col');
    }
});