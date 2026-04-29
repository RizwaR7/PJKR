$(".cl-item:not(.cl-item-no-sub) > .cl-label-wrap .cl-label-title").click(
    function () {
        $(this).parent().parent().toggleClass("cl-item-open");
    }
);
$(".cl-item:not(.cl-item-no-sub) > .cl-label-wrap .cl-label-icon").click(
    function () {
        $(this).parent().parent().toggleClass("cl-item-open");
    }
);

$(".cl-item").each(function () {
    console.log($(this).find("> ul").length);
    if ($(this).find("> ul").length === 0) {
        $(this).addClass("cl-item-no-sub");
    }
});
