/* Demo Purpose file */
/* Can be remove from your live project */

function generateNoty(content, type) {


        var n = noty({
            text        : '<div class="alert alert-'+type+' media fade in"><p><strong>Well done!</strong>  '+content+'</p></div>',
            type: type,
            dismissQueue: true,
            layout      : 'topRight',
            closeWith   : ['click'],
            theme       : 'made',
            maxVisible  : 10,
            animation   : {
                open  : 'animated bounceIn',
                close : 'animated bounceOut',
                easing: 'swing',
                speed : 100
            },
            timeout: 3000,
            buttons     : ''
        });

  
}

