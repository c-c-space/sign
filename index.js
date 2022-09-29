$(function () {
    $('.change').hide();

    $('.tab').on('click', function () {
        $('.change').not($($(this).attr('href'))).hide();
        $($(this).attr('href')).fadeToggle(1000);
    });
});

$('a[href^="#"]').click(function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    return false;
});