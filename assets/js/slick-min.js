$(".responsive").slick({dots:!0,adaptiveHeight:!1,slidesToShow:3,slidesToScroll:1,autoplay:!0,autoplaySpeed:3e3,responsive:[{breakpoint:1024,settings:{slidesToShow:3,slidesToScroll:1,infinite:!0,dots:!0}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:1}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}]}),$(document).ready((function(){$(".responsive").slickLightbox({itemSelector:"figure a img",navigateByKeyboard:!0,src:"src",background:"rgba(28, 40, 46, 1)"})}));