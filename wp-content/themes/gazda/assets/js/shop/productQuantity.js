const updateQuantity = (value, delta) => {
    const currentQuantity = Number(value.text());
    const newQuantity = Math.max(1, currentQuantity + delta);
    value.text(newQuantity);
}

export const handleQuantity = (e) => {
    const $this = $(e.currentTarget);
    const quantityValue = $this.closest('.quantity').find('.quantity__value');
    const delta = $this.hasClass('increment') ? 1 : -1;

    updateQuantity(quantityValue, delta);
}

$('.products-items').on("click", ".quantity__button", handleQuantity);
