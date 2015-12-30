$(document).ready(function() {

    $('.grid').magnificPopup({
        delegate: 'a.grid-item-link, a.catalog-item-link',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        }
    });

});
