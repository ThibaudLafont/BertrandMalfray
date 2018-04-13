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

        // Set click event
        $(this).click(function(){
            var link = $(this).children('.list-column').children("h2").children('a');
            window.location = link.attr('href');
        })
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
            var link = $(this).children('.list-column').children("h2").children('a');
            window.location = link.attr('href');
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

var width = $(window).outerWidth();
$(window).resize(function(){
    if($(this).outerWidth() !== width) {
        // Store new width
        width = $(this).outerWidth();

        // Reset old config
        reset();

        // Handle toggle
        handleToggle();
    }
});