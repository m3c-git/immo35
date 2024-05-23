
$('.responsive').slick({
    dots: true,
    adaptiveHeight: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
{
    breakpoint: 1024,
    settings: {
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    dots: true
    }
},
{
    breakpoint: 600,
    settings: {
    slidesToShow: 2,
    slidesToScroll: 1
    }
},
{
    breakpoint: 480,
    settings: {
    slidesToShow: 1,
    slidesToScroll: 1
    }
}

]


});


$(document).ready(function(){
    $('.responsive').slickLightbox({
        itemSelector: 'figure img',
        navigateByKeyboard: true,
        src: 'src',
        background: 'rgba(0, 0, 0, .7)'
        
    });
});