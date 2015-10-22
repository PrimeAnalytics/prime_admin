
    /****  Initiation of Main Functions  ****/
    $(document).ready(function () {
        windowWidth = $(window).width();
        $('.go-back-list').on('click', function(){
            $('.email-details').fadeOut(200, function(){
                $('.emails-list').fadeIn();
            });
        });

        if(windowWidth < 800){
            $('.emails-list .tab-content .message-item').on('click', function(){
                $('.emails-list').fadeOut(200, function(){
                    $('.email-details').fadeIn();
                    customScroll();
                });
            });
        }

        $('.nav-tabs a').on('click', function(){
            setTimeout(function(){
                customScroll();
            },200);
        });

    });

    $(window).resize(function(){
        windowWidth = $(window).width();
        if(windowWidth > 800){
            $('.emails-list, .email-details').css('display', 'table-cell');
        }
        else {
            $('.email-details').css('display', 'none');
            $('.emails-list .tab-content .message-item').on('click', function(){
                $('.emails-list').fadeOut(200, function(){
                    $('.email-details').fadeIn();
                    customScroll();
                });
            });
        }


    });


    /* Display selected email */

