import refs from "../main/refs"
import {showToastMessage} from "../main/utils";

const {submitForm} = refs
const {ajax_url} = settings

const handleFormSubmit = (e) => {
    e.preventDefault();

    const $this = $(e.currentTarget);
    const formTitle = $this.data("title")
    const formInputs = $this.find("input")
    const formButton = $this.find("button[type='submit']")

    const formData = formInputs.map(function () {
        const $this = $(this);
        const name = $this.data("title")
        const value = $this.val();

        return {name, value};
    }).get();

    const data = {
        action: 'send_mail',
        formTitle,
        formData
    }

    formButton.attr("disabled", true)

    $.ajax({
        type: 'POST',
        url: ajax_url,
        data,
        success: function (res) {
            formButton.attr("disabled", false)
            $this.trigger("reset");

            if (res.success) {
                console.log(res.data)
                showToastMessage(res.data, "success")
            } else {
                showToastMessage(res.data, "error")
            }
        },
        error: function (error) {
            console.error('Error submitting form', error);
        }
    });
}

// Додаємо обробник події для події submit форми
submitForm.on('submit', handleFormSubmit);
