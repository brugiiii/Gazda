let itemList = $("main").offset().left;
let cartPos = $("#cart").offset().left;

export const flyToCart = (button) => {
    let item = button.closest(".product-list__wrapper");

    if(item.length === 0) {
        item = $('.gallery-list__thumb').first();
    }

    let img = item.find("img").attr("src");
    let itemX = item.offset().left - itemList;
    let itemY = item.offset().top;

    TweenMax.killTweensOf('#show');

    $("#show")
        .css({
            left: itemX,
            top: itemY,
            width: 200,
            opacity: 1
        })
        .find("img").attr("src", img);

    TweenMax.to("#show", 0.8, {
        left: cartPos - itemList,
        top: $("#cart").offset().top,
        width: 20,
        onComplete: function () {
        }
    });

    TweenMax.to("#show", 0.3, {
        css: {
            opacity: 0
        },
        delay: 0.7
    });
}
