import refs from "../main/refs"
import {showBackdrop, hideBackdrop} from "../main/utils"

const {vacanciesButtons, formModalForm, formModal, formModalTitle, hideFormModalButton} = refs

const handleVacancyButtonClick = (e) => {
    const $this = $(e.currentTarget);

    const title = $this.data('title').trim();
    const position = $this.data('position').trim()

    formModalForm.data("title", title)
    formModalTitle.text(position)

    showBackdrop(formModal)
}

vacanciesButtons.on('click', handleVacancyButtonClick)
hideFormModalButton.on('click', () => hideBackdrop(formModal))