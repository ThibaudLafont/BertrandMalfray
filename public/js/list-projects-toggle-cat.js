function toggleCatDetails() {
    // Store details ul
    var ul = $('#right-cat-col ul');

    // Hide ul
    $(ul).hide();

    // Add event
    $('#right-cat-col').click(function(){
        if($(ul).css('display') === 'none') $(ul).show(300);
        else $(ul).hide(300)
    });
}

function resetCatDet() {
    // Show ul
    $('#right-cat-col ul').css('display', 'block');

    // Remove event
    $('#right-cat-col').off();
}

function handleToggleCat() {
    // Check window width
    var width = $(window).outerWidth();

    // Reset Jquery conf
    resetCatDet();

    // Belong to it, do right stuff
    if (width < 780) {
        toggleCatDetails();
    }
}

// After load
$(document).ready(function(){
    handleToggleCat();
});
// on resize
$(window).resize(function(){
    handleToggleCat();
});