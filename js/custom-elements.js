(function ($) {
    $('.latest-news-buttons a').on('click', function(e) {
        e.preventDefault();
        const category = $(this).data('category');
        const container = $('.latest-news');

        const data = {
            action: 'latest_news_homepage',
            cat: category,
            url: tnfb_custom_elements_obj.ajax_url,
        }
        $.ajax({
            type: 'POST',
            data: data,
            url: tnfb_custom_elements_obj.ajax_url,
            dataType: 'html',
            success: function(res){
                if (res) {
                    console.dir(res);
                    container.html(res);
                    // $('.ncff-popular__row').append(res);

                } else {
                    console.log('no dice');
                }
            }
        });
    // populate container 
    });
   
})(jQuery);