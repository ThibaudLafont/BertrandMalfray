// Slick config
$('.slick-container').slick({
    arrow: true,
    dots: true,
    infinite: true,
    centerMode: true,
    variableWidth: true,
    nextArrow: "<button type='button' class='slick-next'><img src='/img/arrow-gallery.png'></img></button>",
    prevArrow: "<button type='button' class='slick-prev'><img src='/img/arrow-gallery.png'></img></button>"
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
