function toggleDesktop() {
    // Foreach
    $('.project-item-parent').each(function(){
        $(this).off();
        // Store toggle-column
        var toggle = $(this).children('.list-right-column');

        // Set toggle-column position
        $(toggle).css({
            'position' : 'relative',
            'left'     : '50%',
            'top'      : '0%'
        });

        // Create hover event
        $(this).hover(function(){
            // On hover animate left decrease
            $(toggle).animate({
                left: "0%"
            }, 600);
        });
    });
}

function toggleMobile() {
    // Foreach
    $('.project-item-parent').each(function() {
        // Store toggle column
        var toggle = $(this).children('.list-right-column');
        // Set item height to toggle height
        $(this).height($(toggle).outerHeight());

        // Set toggle position
        $(toggle).css({
            'position' : 'relative',
            'top'     : '100%'
        });
        // Set Title position
        $(this).children('.list-left-column').css({
            'position' : 'relative',
            'bottom'   : '0%',
            'left'     : '0%'
        });

        // Set click event
        $(this).click(function(){
            // Hide title
            $(this).children('.list-left-column').animate(
                {bottom:'100%'}, 400, 'swing',
                function(){
                    $(this).hide();
                }
            );
            // Show toggle-column
            $(toggle).animate({top: '0%'}, 600);
        })
    });
}

function reset() {
    // Remove events
    $('.project-item-parent').off();
    // Reset height
    $('.project-item-parent').css('height', 'auto');
    // Reset list-columns jquery styles
    $('.project-item-parent').children('.list-left-column').removeAttr('style');
    $('.project-item-parent').children('.list-right-column').removeAttr('style');
}

function handleToggle() {
    // Check window width
    var width = $(window).outerWidth();

    // Belong to it, do right stuff
    if (width < 780) {
        toggleMobile();
    } else {
        toggleDesktop();
    }
}

$(document).ready(function() {
    handleToggle();
});

$(window).resize(function(){
    // Reset old config
    reset();

    handleToggle();
});