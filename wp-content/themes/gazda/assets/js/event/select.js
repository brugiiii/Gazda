import refs from "../main/refs"

const {selectButton, optionsButtons} = refs;

const handleSelectClick = (e) => {
    const $this = $(e.currentTarget)
    const previousActiveButton = $('.select-button-js.is-active')

    if ($this.hasClass('is-active')) return $this.removeClass('is-active')

    previousActiveButton.removeClass('is-active')
    $this.toggleClass("is-active");
}

const handleOptionClick = (e) => {
    const $this = $(e.currentTarget);
    const activeButton = $('.select-button-js.is-active');

    if ($this.hasClass('is-active')) {
        return activeButton.removeClass('is-active')
    }

    const closestWrapper = $this.closest('.options-list__item');
    const siblingsWrappers = closestWrapper.siblings();
    const previousActiveOption = siblingsWrappers.find('.options-list__button.is-active');

    previousActiveOption.removeClass('is-active');
    $this.addClass('is-active');

    const value = $this.text().trim();
    const closestField = $this.closest('.cta-form__field');
    const fieldItem = closestField.find('.cta-form__item')
    const fieldInput = closestField.find('input')

    fieldItem.text(value)
    fieldInput.val(value);

    activeButton.removeClass('is-active')
}

selectButton.on('click', handleSelectClick)
optionsButtons.on('click', handleOptionClick)