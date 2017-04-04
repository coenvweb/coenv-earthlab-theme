jQuery(function ($) {
	'use strict';

	$(document).ready(function() {
		var sticky = new Foundation.Sticky($('.sticky'));

        var masonry = $('.two-col').masonry({
            itemSelector: 'li',
        });

		if($('.feature-image').length) {
            //how often to rotate img in milliseconds
            var imageTime = 8000;

			function slideSwitch() {
                $('.progress-meter').stop();
                $('.progress-meter').animate({width: '0%'}, 1, 'linear');
                $('.progress-meter').animate({width: '100%'}, imageTime, 'linear');
				var active = $('.homepage-features .active');
				var images = $('.homepage-features .feature-image');
				var next =  active.next('.feature-image').length ? active.next('.feature-image') : $('.feature-image:first');
				next.addClass('active');
				active.removeClass('active');
			}


			$('.playpause').find('i').click(function () {
                if($(this).hasClass('fa-play')) {
                    $('.progress-meter').stop();
                    $('.progress-meter').animate({width: '100%'}, imageTime, 'linear');
					t = setInterval(slideSwitch, imageTime);
                    $(this).removeClass('fa-play');
                    $(this).addClass('fa-pause');
                } else {
					t = window.clearInterval(t);
                    $('.progress-meter').stop();
                    $('.progress-meter').animate({width: '0%'}, 1, 'linear');
                    $(this).addClass('fa-play');
                    $(this).removeClass('fa-pause');
				}
			});

			var t = setInterval(slideSwitch, imageTime );
            $('.progress-meter').stop();
            $('.progress-meter').animate({width: '100%'}, imageTime, 'linear');

		}

        
	});

    // share buttons
    $('.share').coenvshare();
    
    // lightbox
    $('a').each(function() {
        if (!this.href.match('/.*youtube.com/channel/.*')) {
            $(this).nivoLightbox();
        }
    });

    // lightbox captions
    $('figure a img').each(function () {
        var $this = $(this);
        $this.parent().attr('title', $this.attr('alt'));
    });
    $('div.gallery img').each(function () {
        var $this = $(this);
        $this.parent().attr('title', $this.attr('alt'));
    });

    //$(".wp-caption-text.gallery-caption").hide();
    //$("div.gallery dl:gt(0)").hide();

    // split galleries using parent id 
    $('div.gallery a').each(function () {
        var $this = $(this);
        $this.attr('data-lightbox-gallery', $this.closest('div').attr('id'));
    });

    // Category filter for custom post type indicies
    $("select.select-category").on( 'change', function () {
        //alert('This changed!');
        //var url = $(this).parent('div').attr('data-url');
        var cat = $(this).parent('div').attr('data-url');
        var catval = $(this).val();
        window.location.href = cat + catval;
    } );
});



jQuery(function ($) {
    'use strict';

    // handle blog header form
    $('#blog-header').blogHeader();

});

$.fn.blogHeader = function () {
    'use strict';

    var $header = $(this),
            $selectCategory = $header.find('.select-category select'),
            $selectMonth = $header.find('.select-month select');

    $selectCategory.on( 'change', function () {
        var term_id = $(this).val(),
                url = $(this).parent('div').attr('data-url');
        window.location.href = url + term_id;
    } );

    $selectMonth.on( 'change', function () {
        var url = $(this).val();
        window.location.href = url;
    } );



};
