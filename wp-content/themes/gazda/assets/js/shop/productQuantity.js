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
        currentBuyButton.attr('data-quantity', newQuantity);
    }

    return newQuantity;
};

export const handleQuantity = (e) => {
    const $this = $(e.currentTarget);
    let quantityValue = $this.closest('.quantity').find('.quantity__value');

    if(quantityValue.length === 0){
        quantityValue = $this.closest('.quantity-container').find('.quantity__value');
    }

    const delta = $this.hasClass('increment') ? 1 : -1;

    return updateQuantity(quantityValue, delta, $this);
};

$('.products-items').on("click", ".quantity__button", handleQuantity);
