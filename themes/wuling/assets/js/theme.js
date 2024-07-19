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
    $carSearch.on("input", $.debounce(256, filterCars));
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
function formatCurrency(amount, locale = "id-ID", currency = "IDR") {
    const formatter = new Intl.NumberFormat(locale, {
        style: "currency",
        currency: currency,
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    });
    return formatter.format(amount);
}