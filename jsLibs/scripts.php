<script src="jsLibs/jquery.js"></script>
<script src="jsLibs/modernizr.js"></script>
<script type="text/javascript" src="jsLibs/slider.js"></script>

<script>
    $(document).ready(function(){
        // Events for responsive button
        $("#btn-responsive-menu").click(function(){
            $(this).toggleClass("btn-responsive-menu-active");
            $("#main-nav").slideToggle();
        });
        
        // Flexible Slider
        $('#slider').slider({
            content: '.sliderContent',
            children: 'div',
            transition: 'fade',
            animationSpeed: 800,
            autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: true,
            bullets: true,
            arrows: true,
            arrowsHide: true,
            prev: 'prev',
            next: 'next',
            animationStart: function(){},
            animationComplete: function(){}
        });
    });
    
    $(window).resize(function(){
        sliderSize()
    });
    
    function sliderSize(){
        var r = 0;
        for(r=1; r<=5; r++){
            var image = ".img_"+r;
            var newHeight = $(image).height();
            if(newHeight!=0){ 
                $('#slider').css('height',newHeight+37);
                $('.sliderContent').css('height',newHeight);
                $('.sliderBullets').css('top',newHeight+10); 
            }
        }
        
        var newHeight = $('.flexy-gird li').height();
        if(newHeight!=0){
            $('..flexy-gird li').css('height',newHeight);
        }
        
    };
</script>