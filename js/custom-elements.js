(function ($) {
    $('.latest-news-buttons a').on('click', function(e) {
        e.preventDefault();
        const btn = $(this);
        if (btn.hasClass('active-news-button')) {
            return;
        } else {
            btn.parent().siblings().find('a').removeClass('active-news-button');
            btn.addClass('active-news-button')
        }
        const category = btn.data('category');
        const container = $('.latest-news');

        const data = {
            action: 'latest_news_homepage',
            cat: category,
            // url: tnfb_custom_elements_obj.ajax_url,
        }
        $.ajax({
            type: 'POST',
            data: data,
            url: tnfb_custom_elements_obj.ajax_url,
            dataType: 'html',
            success: function(res){
                if (res) {
                    container.html(res);

                } else {
                    console.log('no dice');
                }
            }
        });
    // populate container 
    });
   
})(jQuery);