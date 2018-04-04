function adaptSlashTitle(parent) {
    // Loop on every node found
    $(parent).each(function(){
        // Store h2 height
        var height = $(this).children('h2').outerHeight();
        // Set h2 height to slash
        $(this).children('img').height(height);
        // Now check if slash appear break title line
        if(height !== $(this).children('h2').outerHeight()){
            // Set new height
            var height = $(this).children('h2').outerHeight();
            // Set h2 height to slash
            $(this).children('img').height(height);
        }
        // Show slash
        $(this).children('img').css('opacity', 1);
    });
}

$(document).ready(function(){
    adaptSlashTitle('.list-left-column');
    adaptSlashTitle('.category-title');
});
$(window).resize(function(){
    adaptSlashTitle('.list-left-column');
    adaptSlashTitle('.category-title');
})