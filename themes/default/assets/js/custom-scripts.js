$(document).ready(function () {
// blog
    var blog_slider=$(".blog-slider");
    blog_slider.owlCarousel({
        loop:true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            991:{
                items:3
            }
        }
    });
// promotions
    var promotions_latest=$(".why-choose-us-slide");
    promotions_latest.owlCarousel({
        loop:false,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            991:{
                items:4
            }
        }
    });


    var flights=$(".flights");
    flights.owlCarousel({
        stagePadding: 80,
        loop:true,
        margin:10,
        nav:true,
        auto: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

    // promotions
    var promotions_latest=$(".promotions-slider-latest");
    promotions_latest.owlCarousel({
        loop:true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            991:{
                items:3
            }
        }
    });

    // video offeft
    $('#offers-icon-play').click(function () {
        $(this).parent().addClass('play-video');
        document.getElementById("offers-video").play();

    });
    document.getElementById('offers-video').addEventListener('ended', function (ev) {
        $('.offers-image').removeClass('play-video');
    })
});