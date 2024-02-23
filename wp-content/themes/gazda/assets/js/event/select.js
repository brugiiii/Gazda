import refs from "../main/refs"

const {selectButton, optionsList, optionsButtons, eventInput} = refs;

const handleSelectClick = (e) => {
    toggleSelectVisibility()
}

const handleOptionClick = (e) => {
    const $this = $(e.currentTarget);

    if ($this.hasClass('is-active')) {
        toggleSelectVisibility();

        return;
    }

    const activeOption = $('.options-list__button.is-active')
    const value = $this.text();

    selectButton.text(value)
    eventInput.val(value);

    activeOption.removeClass('is-active')
    $this.addClass('is-active')

    toggleSelectVisibility();
}

const toggleSelectVisibility = () => {
    optionsList.toggleClass('is-hidden');
}

selectButton.on('click', handleSelectClick)
optionsButtons.on('click', handleOptionClick)