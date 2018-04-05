function adaptSlashTitle(parent, children) {
    // Loop on every node found
    $(parent).each(function(){
        // Store h2 height
        var height = $(this).children(children).outerHeight();
        // Set h2 height to slash
        $(this).children('.slash').height(height);
        // Now check if slash appear break title line
        if(height !== $(this).children(children).outerHeight()){
            // Set new height
            var height = $(this).children(children).outerHeight();
            // Set h2 height to slash
            $(this).children('.slash').height(height);
        }
        // Show slash
        $(this).children('.slash').css('opacity', 1);
    });
}

$(document).ready(function(){
    adaptSlashTitle('.list-left-column', 'h2');
    adaptSlashTitle('.category-title', 'h2');
});
$(window).resize(function(){
    adaptSlashTitle('.list-left-column', 'h2');
    adaptSlashTitle('.category-title', 'h2');
})