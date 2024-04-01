import refs from "../main/refs"
import {showToastMessage} from "../main/utils"

const {personalForm, passwordForm} = refs;
const {ajax_url} = settings;

const handlePersonalFormSubmit = (e) => {
    e.preventDefault();

    const form = e.currentTarget;
    const formData = new FormData(form)

    const name = formData.get('name');
    const surname = formData.get('surname');
    const email = formData.get('email');
    const phone = formData.get('phone');

    const query = {
        name,
        surname,
        email,
        phone
    }

    const formButton = $(form).find('button[type="submit"]')

    formButton.attr('disabled', true);

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'update_personal_data', ...query},
        success: (res) => {
            formButton.attr('disabled', false);

            if (res.success) {
                showToastMessage(res.data, "success")
            } else {
                showToastMessage(res.data, "error")
            }
        },
        error: (error) => console.log("error: ", error)
    });
}

const handlePasswordFormSubmit = (e) => {
    e.preventDefault();

    const form = e.currentTarget;
    const formData = new FormData(form)

    const oldPassword = formData.get('old-password');
    const newPassword = formData.get('new-password');
    const repeatNewPassword = formData.get('repeat-new-password');

    if (newPassword !== repeatNewPassword) return showToastMessage("Паролі не співпадають. Будь ласка, спробуйте ще раз.", "error")

    const query = {
        old_password: oldPassword,
        new_password: newPassword,
    }

    const formButton = $(form).find('button[type="submit"]')

    formButton.attr('disabled', true);

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'change_password', ...query},
        success: (res) => {
            formButton.attr('disabled', false);

            if (res.success) {
                showToastMessage(res.data, "success")
            } else {
                showToastMessage(res.data, "error")
            }
        },
        error: (error) => console.log("error: ", error)
    });
}

personalForm.on('submit', handlePersonalFormSubmit)
passwordForm.on('submit', handlePasswordFormSubmit)