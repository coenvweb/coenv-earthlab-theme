$(document).ready(function() {
    var sticky = new Foundation.Sticky($('.sticky'));

    $('.top-bar-wrapper').on('sticky.zf.stuckto:top', function(){
        $(this).addClass('shrink');
    }).on('sticky.zf.unstuckfrom:top', function(){
        $(this).removeClass('shrink');
    })
});
