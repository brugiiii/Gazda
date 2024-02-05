let currentBuyButton = null;

const updateQuantity = (value, delta, $this) => {
    const buyButton = $this.closest('.product').find('.add_to_cart_button');
    const currentQuantity = Number(value.text());
    const newQuantity = Math.max(1, currentQuantity + delta);

    value.text(newQuantity);

    if (!currentBuyButton) {
        buyButton.attr('data-quantity', newQuantity);
        currentBuyButton = buyButton;
    } else {
        // Використовуйте метод attr() для зміни значення дата-атрибута
        currentBuyButton.attr('data-quantity', newQuantity);
    }
};


export const handleQuantity = (e) => {
    const $this = $(e.currentTarget);
    const quantityValue = $this.closest('.quantity').find('.quantity__value');
    const delta = $this.hasClass('increment') ? 1 : -1;

    updateQuantity(quantityValue, delta, $this);
};

$('.products-items').on("click", ".quantity__button", handleQuantity);
