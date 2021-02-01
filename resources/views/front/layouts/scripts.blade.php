<script src="{{asset('front/js/popper.js')}}"></script>
<script src="{{asset('front/js/jquery.js')}}"></script>
<script src="{{asset('front/js/carousel.js')}}"></script>
<script src="{{asset('front/js/bootstrap.js')}}"></script>
<script src="{{asset('front/js/covid-alert.js')}}"></script>
<script>
    $(document).ready(function (){
        //Slider
        var video = $('.video-slider');
        video.owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
        var posts = $('.post-slider');
        posts.owlCarousel({
            items: 4,
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                768:{
                    items:2,
                    nav:true
                },
                992:{
                    items:3,
                    nav:true
                },
                1200:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        });
        //Youtube Video Modal
        $(".video-modal").click(function () {
            var theModal = $(this).data("bs-target"),
                videoSRC = $(this).attr("data-bs-video"),
                videoSRCauto = videoSRC + "?modestbranding=1&rel=0&showinfo=0&html5=1&autoplay=1";
            console.log(videoSRCauto)
            $(theModal + ' iframe').attr('src', videoSRCauto);
            $(theModal).on('hidden.bs.modal', function () {
                $(theModal + ' iframe').attr('src', videoSRC);
            });
        });
    });
</script>
