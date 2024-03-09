import refs from "../main/refs"
import {showBackdrop, hideBackdrop} from "../main/utils"

const {vacanciesButtons, formModalInput, formModal, formModalTitle, hideFormModalButton} = refs

const handleVacancyButtonClick = (e) => {
    const $this = $(e.currentTarget);

    const title = $this.data('title').trim();
    const position = $this.data('position').trim()

    formModalInput.val(title)
    formModalTitle.text(position)

    showBackdrop(formModal)
}

vacanciesButtons.on('click', handleVacancyButtonClick)
hideFormModalButton.on('click', () => hideBackdrop(formModal))
