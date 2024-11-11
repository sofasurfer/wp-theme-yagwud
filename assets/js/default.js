let touchStartX = 0;
let touchEndX = 0;

const swipeElement = document.getElementById('overlay');

if(swipeElement){

    swipeElement.addEventListener('touchstart', (e) => {
      touchStartX = e.touches[0].clientX;
    });
    
    swipeElement.addEventListener('touchmove', (e) => {
      touchEndX = e.touches[0].clientX;
    });
    
    swipeElement.addEventListener('touchend', () => {
      handleSwipe();
    });
    
    function handleSwipe() {
      const swipeDistance = touchStartX - touchEndX;
    
      if (swipeDistance < 50) {
        if(img_active > 1){
            img_active = img_active-1;
        }else{
            img_active = images.length;
        }
        $('#overlay').css('background-image', 'url(' + images[img_active] + ')');
      } else if (swipeDistance > -50) {
        if(img_active < images.length){
            img_active = img_active+1;
        }else{
            img_active = 0;
        }
        $('#overlay').css('background-image', 'url(' + images[img_active] + ')');
      }
    }
}


/**
 * Handel Key navigation for gallery 
 */
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

    $('#y-offcanvas-trigger').change(function(){
        if ($(this).prop('checked')) {
            $('body').addClass('y-offcanvas');
        } else {
            $('body').removeClass('y-offcanvas');
        }
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
                        $('#pradio h2').text('LIVE');
                    }else{
                        $('#pradio').addClass('online');
                        $('#pradio h2').text('RADIO');
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