


function checkKey(e) {
    var event = window.event ? window.event : e;
    if( event.keyCode == 37 ){
        if(img_active > 1){
            img_active = img_active-1;
        }else{
            img_active = images.length;
        }
        $('#overlay').css('background-image', 'url(' + images[img_active] + ')');
    }else if( event.keyCode == 39 ){
        if(img_active < images.length){
            img_active = img_active+1;
        }else{
            img_active = 0;
        }
        $('#overlay').css('background-image', 'url(' + images[img_active] + ')');
    }else if( event.key == "Escape" ){
        $('body').removeClass('overlay');
    }
}
document.addEventListener('keyup', checkKey);

/*
    When page is loaded
*/
var scrollPos = 0;
$(function() {

    $("#pgallery").justifiedGallery({
        margins: 10,
        rowHeight: 500
    });

    $('a.gallery_item').click(function(e) {
        e.preventDefault();
        $('body').addClass('overlay');
        $('#overlay').css('background-image', 'url(' + $(this).attr('href') + ')');
        img_active = $(this).data('index');
    });

    $('.close').click(function(e) {
        e.preventDefault();
        $('body').removeClass('overlay');
    });
    $('#overlay').click(function(e) {
        e.preventDefault();
        $('body').removeClass('overlay');
    });


    $('#pradio').each(function(){
        // AJAX request
        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                action: 'get_radio', // Action name registered in wp_ajax_ hooks
            },
            success: function (response) {
                if (response.success) {
                    // Update HTML content
                    if(response.data && response.data.server_name){
                        $('#pradio').addClass('online');
                        $('#pradio h2').text('RADIO: YES');
                    }else{
                        $('#pradio').removeClass('online');
                        $('#pradio h2').text('RADIO: not now');
                    }
                    
                } else {
                    // Handle errors
                    console.log('Error:', response.data);
                }
            },
            error: function (errorThrown) {
                console.log('AJAX Error:', errorThrown);
            },
        });
    });


});