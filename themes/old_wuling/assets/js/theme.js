$(document).ready(function () {
    var $carSearch = $("#carSearch");
    var $carModelFilter = $("#carModelFilter");
    var $carTypeFilter = $("#carTypeFilter");
    function filterCars() {
        $.request("onFilterCars", {
            data: {
                search: $carSearch.val(),
                model: $carModelFilter.val(),
                transmission: $carTypeFilter.val(),
                page: 1,
            },
        });
    }
    // Event listeners for search and filter
    $carSearch.on("input", $.debounce(250, filterCars));
    $carTypeFilter.on("change", filterCars);
    $carModelFilter.on("change", filterCars);
});
// Debounce function to limit how often a function can fire
$.debounce = function (wait, func) {
    var timeout;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            func.apply(context, args);
        }, wait);
    };
};

$("#selectDomisili").select2({
    theme: "bootstrap-5",
    width: $(this).data("width")
        ? $(this).data("width")
        : $(this).hasClass("w-100")
        ? "100%"
        : "style",
    placeholder: $(this).data("placeholder"),
});

// var heroCarousel = $("#heroCarousel");
// heroCarousel.on("slide.bs.carousel", function (e) {
//     var $e = $(e.relatedTarget);
//     var idx = $e.index();
//     var itemsPerSlide = 1;
//     var totalItems = $(".carousel-item").length;
//     if (idx >= totalItems - (itemsPerSlide - 1)) {
//         var it = itemsPerSlide - (totalItems - idx);
//         for (var i = 0; i < it; i++) {
//             if (e.direction == "left") {
//                 $(".carousel-item").eq(i).appendTo(".carousel-inner");
//             } else {
//                 $(".carousel-item").eq(0).appendTo(".carousel-inner");
//             }
//         }
//     }
// });
// heroCarousel.carousel({
//     interval: 5000,
// });
