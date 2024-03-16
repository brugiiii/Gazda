import refs from "./refs"
import {showToastMessage} from "./utils"

const {registerForm, loginForm, authModal, formSwitcher} = refs;
const {account_page_link, ajax_url} = settings

const handleRegisterFormSubmit = (e) => {
    e.preventDefault();

    const form = e.target;

    const formData = new FormData(form);

    const login = formData.get('login');
    const password = formData.get('password');
    const email = formData.get('email');

    const query = {
        login,
        password,
        email
    }

    const formButton = $(form).find('.auth-form__button');
    formButton.attr('disabled', true)

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'register_user', ...query},
        success: (res) => {
            formButton.attr('disabled', false);

            if (res.success) {
                showToastMessage(res.data, "success")
                window.location.href = account_page_link;
            } else {
                showToastMessage(res.data, "error")
            }
        },
        error: (error) => console.log("error: ", error)
    });
}

const handleLoginFormSubmit = (e) => {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    const login_or_email = formData.get('login_or_email');
    const password = formData.get('password');

    const query = {
        login_or_email,
        password,
    }

    const formButton = $(form).find('.auth-form__button');
    formButton.attr('disabled', true)

    $.ajax({
        url: ajax_url,
        type: 'post',
        data: {action: 'login_user', ...query},
        success: (res) => {
            formButton.attr('disabled', false);

            if (res.success) {
                showToastMessage(res.data, "success")
                window.location.href = account_page_link;
            } else {
                showToastMessage(res.data, "error")
            }
        },
        error: (error) => console.log("error: ", error)
    });
}


formSwitcher.on('click', () => authModal.toggleClass('login-form'))
registerForm.on('submit', handleRegisterFormSubmit);
loginForm.on('submit', handleLoginFormSubmit)