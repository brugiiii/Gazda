import refs from "../main/refs"

const {optionsButtons} = refs;
const handleOptionClick = (e) => {
    const $this = $(e.currentTarget);

    const closestWrapper = $this.closest('.options-list__item');
    const siblingsWrappers = closestWrapper.siblings();
    const previousActiveOption = siblingsWrappers.find('.options-list__button.is-active');

    previousActiveOption.removeClass('is-active');
    $this.addClass('is-active');

    const value = $this.text().trim();
    const closestField = $this.closest('.cta-form__field');
    const fieldInput = closestField.find('input')
console.log(fieldInput)
    fieldInput.val(value);
}

optionsButtons.on('click', handleOptionClick)