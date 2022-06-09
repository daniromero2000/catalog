window.addEventListener('load', function () {
    document.querySelector('.glider3').addEventListener('glider-slide-visible', function (event) {
        var glider = Glider(this);
    });
    document.querySelector('.glider3').addEventListener('glider-slide-hidden', function (event) {
    });
    document.querySelector('.glider3').addEventListener('glider-refresh', function (event) {
    });
    document.querySelector('.glider3').addEventListener('glider-loaded', function (event) {
    });

    window._ = new Glider(document.querySelector('.glider3'), {
        slidesToShow: 1, //'auto',
        slidesToScroll: 1,
        itemWidth: 150,
        draggable: true,
        scrollLock: false,
        dots: '#dots',
        rewind: true,
        arrows: {
            prev: '.glider-prev',
            next: '.glider-next'
        },
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToScroll: 'auto',
                    itemWidth: 300,
                    slidesToShow: 'auto',
                    exactWidth: true
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToScroll: 4,
                    slidesToShow: 4,
                    dots: false,
                    arrows: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToScroll: 3,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToScroll: 2,
                    slidesToShow: 2,
                    dots: false,
                    arrows: false,
                    scrollLock: true
                }
            }
        ]
    });
});