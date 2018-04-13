// Slick config
$('.slick-container').slick({
    arrow: true,
    dots: true,
    infinite: true,
    centerMode: true,
    variableWidth: true
});

// Fancy Box config
$('[data-fancybox="images"]').fancybox({
    protect: true,
    loop: true,
    buttons : [
        'zoom',
        'thumbs',
        'share',
        'close',
    ]
});
