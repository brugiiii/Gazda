import refs from "./refs"

const {cartModal, cartContent} = refs
const {ajax_url} = settings

let timeout

function handleQuantity(e) {
    const $this = $(e.currentTarget)

    const quantityWrapper = $this.closest(".cart-quantity")
    const quantityValueEl = quantityWrapper.find(".cart-quantity__value")
    const quantityValue = Number(quantityValueEl.text())

    if (quantityValue === 1 && $this.hasClass('decrement')) return

    clearTimeout(timeout)

    const delta = $this.hasClass('increment') ? 1 : -1
    const quantity = quantityValue + delta

    quantityValueEl.text(quantity)

    const productItem = quantityWrapper.closest(".cart-products__item")
    const {productId} = productItem.data()

    timeout = setTimeout(() => updateQuantity(productId, quantity), 300)
}

function updateQuantity(productId, quantity) {
    cartModal.addClass("loading")

    const query = {
        productId,
        quantity,
    }

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'update_product_quantity', ...query},
        success: ({data: {cartMarkup}, success}) => {
            if (!success) return
            cartContent.html(cartMarkup)

            cartModal.removeClass("loading")
        },
        error: (error) => console.log("error: ", error),
    })
}

function handleRemove(e){
    const $this = $(e.currentTarget)

    const productItem = $this.closest(".cart-products__item")
    const {productId} = productItem.data()

    removeProduct(productId)
}

function removeProduct(productId) {
    cartModal.addClass("loading")

    const query = {productId}

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'remove_product', ...query},
        success: ({data: {cartMarkup}, success}) => {
            if (!success) return
            cartContent.html(cartMarkup)

            cartModal.removeClass("loading")
        },
        error: (error) => console.log("error: ", error),
    })

}

cartModal.on("click", ".cart-quantity__button", handleQuantity)
cartModal.on("click", ".delete-button", handleRemove)

$(document.body).on('added_to_cart', function (event, fragments, cart_hash, button) {
    cartContent.html(fragments.cartMarkup)
});