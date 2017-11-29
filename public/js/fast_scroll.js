// Changing menu dependent on section
var it = 0; //iterata
var previousScroll = 0;
var animationComplete = true;
var size = $(".pageSection").length - 2;
$(window).scroll(function(e) {
    
    var windowTop = Math.max($('body').scrollTop(), $('html').scrollTop());
    var currentScroll = $(this).scrollTop();
    if(animationComplete == true){
       if (currentScroll > previousScroll){
          
    $('.pageSection').each(function (index) {
        if (windowTop > ($(this).position().top) && (index == it))
        {
            animationComplete = false;
            if(it > size){
                animationComplete = true;
                return ;
            }
            it = it+1;
            $('html,body').animate({scrollTop: $('#section' +(it)).offset().top}, 500,
            function () {
                setTimeout(function() { animationComplete = true;
                                        previousScroll = $(this).scrollTop();
                                                }, 250);
                });
        }
    });
    } else {

        $('.pageSection').each(function (index) {
            if (windowTop > ($(this).position().top) && (index == (it-1)))
            {
                animationComplete = false;
                it = index;
                $('html,body').animate({scrollTop: $('#section' +(it)).offset().top-1}, 500,
                    function () {
                        setTimeout(function() { animationComplete = true;
                                                previousScroll = $(this).scrollTop();
                                                 }, 250);
                        });
            }
        }); 
       }
   }
    
});
