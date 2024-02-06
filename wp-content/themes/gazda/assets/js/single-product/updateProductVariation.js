$(document).ready(function () {
    const selectedOptions = $('option[selected="selected"]');

    selectedOptions.each(function (index, option) {
        const optionValue = $(option).val();
        $(`.variations-list__input[value="${optionValue}"]`).trigger("click");
    });

    const handleVariationChange = (e) => {
        const $this = $(e.target);
        const value = $this.val();

        const variationsOption = $(`option[value="${value}"]`);
        const variationsSelect = variationsOption.closest('select');

        variationsOption.change();
        variationsSelect.val(value);
    }

    $('.variations-list').on('change', '.variations-list__input', handleVariationChange);
})