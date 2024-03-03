import refs from "../main/refs"
import Toastify from "toastify-js";

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
                Toastify({
                    text: res.data,
                    duration: 4000,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    className: 'success'
                }).showToast();

            } else {
                Toastify({
                    text: res.data,
                    duration: 4000,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    className: 'error'
                }).showToast();
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

    if(newPassword !== repeatNewPassword){
        Toastify({
            text: 'Паролі не співпадають. Будь ласка, спробуйте ще раз.',
            duration: 4000,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            className: 'error'
        }).showToast();
        return
    }

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
                Toastify({
                    text: res.data,
                    duration: 4000,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    className: 'success'
                }).showToast();

            } else {
                Toastify({
                    text: res.data,
                    duration: 4000,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    className: 'error'
                }).showToast();
            }
        },
        error: (error) => console.log("error: ", error)
    });
}

personalForm.on('submit', handlePersonalFormSubmit)
passwordForm.on('submit', handlePasswordFormSubmit)