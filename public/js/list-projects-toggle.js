function handleListToggle() {
    // Keep right-column height as project-item height
    $('.project-item-parent').each(
        function(){
            $(this).height(
                $(this).outerHeight()
            );
        }
    )

    // Close all toggles
    $('.list-right-column').hide();

    // Case of desktop display
    if(window.outerWidth > 780) {
        $('.project-item-parent').hover(
            function() {
                $( this ).children('.list-right-column')
                    .show("slide", { direction: "right" }, 500);
            }
        );

    // Case of mobile display
    } else {
        $('.project-item-parent').click(
            function() {
                // Store right-column
                var div = $( this ).children('.list-right-column');

                // Case of non showed
                if($(div).css('display') === 'none') {
                    $(div)
                        .show("slide", {direction: "down"}, 500);

                    // Case of showed
                } else {
                    $(div)
                        .hide("slide", {direction: "down"}, 500);
                }
            }
        );
    }
}

handleListToggle();
