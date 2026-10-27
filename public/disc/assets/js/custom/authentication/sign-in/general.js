"use strict";

// Class definition
var KTSigninGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleValidation = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'email': {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'The value is not a valid email address',
                            },
                            notEmpty: {
                                message: 'Email address is required'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    },
                    'captcha': {
                        validators: {
                            notEmpty: {
                                message: 'The captcha is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );
    }

    var handleSubmitAjax = function (e) {
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                        if (response) {
                            form.reset();
                            const redirectUrl = form.getAttribute('data-kt-redirect-url');
                            const actSuccess = function () {
                                location.href = redirectUrl;
                            };
                            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            common.showMessageWithAction('Sukses', 'You have successfully logged in!', 'success', 'Ok, got it!', actSuccess);
                        } else {
                            // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            common.showMessage('Gagal', 'Sorry, looks like there are some errors detected, please try again.', 'error', 'Ok, got it!');
                            common.refreshCaptcha();
                        }
                    }).catch(function (error) {
                        common.showMessage('Gagal', error.response.data.message, 'error', 'Ok, got it!');
                        common.refreshCaptcha();
                    }).then(() => {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;
                    });
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    common.showMessage('Gagal', 'Sorry, looks like there are some errors detected, please try again.', 'error', 'Ok, got it!');
                    common.refreshCaptcha();
                }
            });
        });
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');

            handleValidation();

            handleSubmitAjax(); // use for ajax submit
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
