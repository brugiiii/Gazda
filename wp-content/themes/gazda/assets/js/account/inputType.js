import refs from "../main/refs"

const {passVisibilityButton} = refs

const handlePassVisiblityButtonClick = (e) => {
    const $this = $(e.currentTarget);
    const targetInput = $this.next('input');

    $this.toggleClass('is-active');

    targetInput.attr('type') === 'text' ? targetInput.attr('type', 'password') : targetInput.attr('type', 'text')
}

passVisibilityButton.on("click", handlePassVisiblityButtonClick)