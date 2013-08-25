$(document).ready(function() {

    //nav activated menu
    var bodyclass = $("body").attr("class"),
        menuItem = $(".header li");

    menuItem.each(function() {
        if (bodyclass == $(this).data('uri')) {
            $(this).addClass("active");
        }
    });

});
