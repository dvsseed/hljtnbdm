/**
 * Created by purplebleed on 2015/9/22.
 */

$( document ).ready(function() {
    $(".menuLink").on('click', function (e) {
        $(this).parent().parent().find('.active').removeClass('active');
        $('.nav').find('.active').removeClass('active');
        $(this).parent().addClass('active');
        e.preventDefault();
        $('.content').hide();
        $($(this).attr('href')).show();
    });
});