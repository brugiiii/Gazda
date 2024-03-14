import refs from "../main/refs"

const {submitForm} = refs
const {ajax_url} = settings

const handleFormSubmit = (e) => {
    // Зупинити стандартну поведінку форми
    e.preventDefault();

    // Звернення до форми
    const $this = $(e.currentTarget);
    const formId = e.currentTarget.id

    // Зібрати дані з форми
    const formData = $this.serializeArray();
    formData.id = formId;

    const data = {
        action: 'send_mail',
        id: formId,
        formData
    }

    $.ajax({
        type: 'POST',
        url: ajax_url,
        data,
        success: function(response) {
            console.log(response)
        },
        error: function(error) {
            console.error('Error submitting form', error);
        }
    });
}

// Додаємо обробник події для події submit форми
submitForm.on('submit', handleFormSubmit);
