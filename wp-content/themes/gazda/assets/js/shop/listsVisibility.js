const orderButton = $('.order-button');
const filterButton = $('.filter-button');
const orderList = $('.order-list');
const filterContainer = $('.filter-container');

const toggleOrderListVisibility = (event) => {
    event.stopPropagation();

    if (orderList.hasClass('is-hidden')) {
        // Keyboard tracking
        $(document).on("keydown", function (e) {
            if (e.key === "Escape") {
                orderList.addClass('is-hidden');
                $(document).off("keydown");
            }
        });

        // Click tracking
        $(document).on("click", function (e) {
            if (!orderList.is(e.target) && orderList.has(e.target).length === 0) {
                orderList.addClass('is-hidden');
                $(document).off("click");
                $(document).off("keydown");
            }
        });
    } else {
        $(document).off("keydown");
        $(document).off("click")
    }

    orderList.toggleClass('is-hidden');
};

const toggleFilterListVisibility = (event) => {
    event.stopPropagation();

    if (filterContainer.hasClass('is-hidden')) {
        // Keyboard tracking
        $(document).on("keydown", function (e) {
            if (e.key === "Escape") {
                filterContainer.addClass('is-hidden');
                $(document).off("keydown");
            }
        });

        // Click tracking
        $(document).on("click", function (e) {
            if (!filterContainer.is(e.target) && filterContainer.has(e.target).length === 0) {
                filterContainer.addClass('is-hidden');
                $(document).off("click");
                $(document).off("keydown");
            }
        });
    } else {
        $(document).off("keydown");
        $(document).off("click")
    }

    filterContainer.toggleClass('is-hidden');
}

orderButton.on("click", toggleOrderListVisibility);
filterButton.on('click', toggleFilterListVisibility)