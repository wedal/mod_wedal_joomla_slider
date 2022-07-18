(function($) {
$(document).ready(function() {

    $('.wedaljoomlaslider').on('click', '.tabs li', function(event) {
        event.preventDefault();
        $(this).siblings('li').removeClass('active');
        $(this).addClass('active');
        $('body').append('<div id="wedaljoomlaslider-loader"></div>');

        let slider = $(this).closest(".wedaljoomlaslider");
        let module_id = slider.attr('data-id');
        let itemid = slider.attr('data-itemid');
        let tagid = $(this).attr('data-tagid');

        if (!itemid || !module_id || !tagid) {
            console.log('Одного из параметров для запроса не существует');
            return false;
        }

        $.getJSON('/index.php?option=com_ajax&module=wedal_joomla_slider&format=json&method=getSlidesByTag&id='+module_id+'&Itemid='+itemid+'&tagid='+tagid, function(response) {
            let slides = response.data.data;
            if (slider.find('.slick-track').length) {
                slider.find('.slick-track').empty();
                $.each(slides, function(key, slide) {
                    slider.find('.slider').slick('slickAdd', slide);
                });
            } else {
                $.each(slides, function(key, slide) {
                    slider.find('.slider').empty().append(slide);
                });
            }
        });
    });

    $('.wedaljoomlaslider').on('click', '.readmore-link', function(event) {
        event.preventDefault();
        if (!$(this).hasClass('open')) {
            $(this).addClass('open');
            $(this).closest('.wedaljoomlaslider').find('.slider').addClass('open');
        } else {
            $(this).removeClass('open');
            $(this).closest('.wedaljoomlaslider').find('.slider').removeClass('open');
        }
        let alttitle = $(this).attr('data-alttitle');
        $(this).attr('data-alttitle', $(this).text()).text(alttitle);
    });

});
})(jQuery)
