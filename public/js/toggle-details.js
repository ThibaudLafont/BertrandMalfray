function toggleCatDetails(ulParent) {
    // Store details ul
    var ul = $(ulParent + ' ul');

    // Hide ul
    $(ul).hide();

    // Add event
    $(ulParent).click(function(){
        if($(ul).css('display') === 'none') $(ul).show(300);
        else $(ul).hide(300)
    });
}

function resetCatDet(ulParent) {
    // Show ul
    $(ulParent + ' ul').css('display', 'block');

    // Remove event
    $(ulParent).off();
}

function handleToggleCat(ulParent) {
    // Check window width
    var width = $(window).outerWidth();

    // Belong to it, do right stuff
    if (width < 780) {
        toggleCatDetails(ulParent);
    }
}