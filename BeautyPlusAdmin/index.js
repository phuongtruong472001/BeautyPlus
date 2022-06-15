$(document).ready(function () {
    InitLayout();
    $('.add-emoloyee-form').draggable();
   
})
$(window).resize(function () {
    InitLayout()
})

const InitLayout = () => {
    
    const width = $(window).width() - $('.navbar').outerWidth(true);
    $('.main').css('width', width + "px");
    $('.title-distance').css("width","90%")
    $('.title-distance').css("width",($('.title-distance').width()+50)+"px")
}

