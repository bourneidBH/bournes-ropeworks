$(document).ready(function(){
    $('.sidenav').sidenav();

    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true,
    });
    autoplay();
    function autoplay() {
        $('.carousel').carousel('next');
        setTimeout(autoplay, 5000);
    }

    //auto resize text area on conact form
    // $('#request').val('New Text');
    // M.textareaAutoResize($('#request'));

  });
