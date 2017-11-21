var Login = function () {
    var handleLogin = function () {
        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
                email: {
                    required: "Bitte geben Sie eine E-Mail-Adresse ein.",
                    email: "Bitte geben Sie eine gültige E-Mail-Addresse ein."
                },
                password: {
                    required: "Bitte geben Sie ein Passwort ein."
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                $(form).find('input[type="text"]').prop('disabled', true);
                $(form).find('input[type="password"]').prop('disabled', true);
                $(form).find('button[type="submit"]').prop('disabled', true);

                var formData = {};
                formData.csrf_betitbest_securitytoken = $(form).find('input[name="csrf_betitbest_securitytoken"]').val();
                formData.email = $(form).find('input[name="email"]').val();
                formData.password = $(form).find('input[name="password"]').val();

                $.post($(form).attr('action'), formData, function (data) {
                    if (data.status) {
                        window.location.href = $(form).data('dashboard-url');
                    } else {
                        switch (data.error_code) {
                            case 1:
                                $(form).find('.form-group input[name="email"]').parent().after('<span for="email" '
                                + 'class="help-block">Bitte geben Sie eine gültige E-Mail-Adresse ein.</span>');
                                break;

                            case 2:
                                $(form).find('.form-group input[name="email"]').parent().after('<span for="email" '
                                + 'class="help-block">Die Kombination aus E-Mail-Adresse und Passwort ist nicht gültig.</span>');
                                break;
                        }

                        $(form).find('button[type="submit"]').prop('disabled', false);
                        $(form).find('input[type="text"]').prop('disabled', false).removeClass('valid');
                        $(form).find('input[type="password"]').prop('disabled', false).removeClass('valid');
                        $(form).find('.form-group').addClass('has-error');
                    }
                }, 'json');
            }
        });
    }

    var handleForgetPassword = function () {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "E-Mail-Adresse ist erforderlich.",
                    email: "Bitte geben Sie eine gültige E-Mail-Adresse ein."
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },
            submitHandler: function (form) {
                $(form).find('input[type="text"]').prop('disabled', true);
                $(form).find('button[type="submit"]').prop('disabled', true);

                var formData = {};
                formData.csrf_betitbest_securitytoken = $(form).find('input[name="csrf_betitbest_securitytoken"]').val();
                formData.email = $(form).find('input[name="email"]').val();

                $.post($(form).attr('action'), formData, function (data) {
                    if (data.status) {
                        $('.forget-form p').addClass('hidden');
                        $('.forget-form .form-group').addClass('hidden');
                        $('.forget-form .form-actions').addClass('hidden');
                        $('.forget-form .form-success').removeClass('hidden');
                    } else {
                        switch (data.error_code) {
                            case 1:
                                $(form).find('.form-group .input-icon').after('<span for="email" class="help-block">'
                                + 'Bitte geben Sie eine gültige E-Mail-Adresse ein.</span>');
                                break;

                            case 2:
                                $(form).find('.form-group .input-icon').after('<span for="email" class="help-block">Es '
                                + 'ist ein Fehler aufgetreten.</span>');
                                break;
                        }

                        $(form).find('button[type="submit"]').prop('disabled', false);
                        $(form).find('input[type="text"]').prop('disabled', false).removeClass('valid');
                        $(form).find('.form-group').addClass('has-error');
                    }
                }, 'json');
            }
        });

        $('.reset-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                password: {
                    required: true
                },
                confirm: {
                    required: true,
                    equalTo: '.form-group input[name="password"]'
                }
            },
            messages: {
                password: {
                    required: "Bitte geben Sie ein Passwort ein."
                },
                confirm: {
                    required: "Bitte bestätigen Sie das Passwort.",
                    equalTo: "Passwort und Bestätigung sind nicht gleich."
                }
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },
            submitHandler: function (form) {
                $(form).find('input[type="password"]').prop('disabled', true);
                $(form).find('button[type="submit"]').prop('disabled', true);

                var formData = {};
                formData.csrf_betitbest_securitytoken = $(form).find('input[name="csrf_betitbest_securitytoken"]').val();
                formData.code = $(form).find('input[name="code"]').val();
                formData.password = $(form).find('input[name="password"]').val();
                formData.confirm = $(form).find('input[name="confirm"]').val();

                $.post($(form).attr('action'), formData, function (data) {
                    if (data.status) {
                        $('.reset-form p').addClass('hidden');
                        $('.reset-form .form-group').addClass('hidden');
                        $('.reset-form .form-actions').addClass('hidden');
                        $('.reset-form .form-success').removeClass('hidden');

                        setTimeout(function () {
                            window.location.href = $('.reset-form .form-success a').attr('href');
                        }, 3000)
                    } else {
                        switch (data.error_code) {
                            case 1:
                                $(form).find('.form-group input[name="confirm"]').after('<span for="email" '
                                + 'class="help-block">Bitte versuchen Sie es später erneut.</span>');
                                break;

                            case 2:
                                $(form).find('.form-group input[name="confirm"]').after('<span for="email" '
                                + 'class="help-block">Es ist ein Fehler aufgetreten.</span>');
                                break;

                            case 3:
                                $(form).find('.form-group input[name="confirm"]').after('<span for="email" '
                                + 'class="help-block">Bitte geben Sie ein gültiges Passwort ein und bestätigen Sie dieses.</span>');
                                break;

                            case 3:
                                $(form).find('.form-group input[name="confirm"]').after('<span for="email" '
                                + 'class="help-block">Es ist ein Fehler aufgetreten.</span>');
                                break;
                        }

                        $(form).find('button[type="submit"]').prop('disabled', false);
                        $(form).find('input[type="text"]').prop('disabled', false).removeClass('valid');
                        $(form).find('.form-group').addClass('has-error');
                    }
                }, 'json');
            }
        });

        $('div.forget-password a').click(function (event) {
            event.preventDefault();
            $('form.forget-form').removeClass('hidden');
            $('div.content .login-form, div.content div.forget-password').addClass('hidden');
        });

        jQuery('#back-btn').click(function () {
            jQuery('.login-form').removeClass('hidden');
            jQuery('.forget-password').removeClass('hidden');
            jQuery('.forget-form').addClass('hidden');
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleLogin();
            handleForgetPassword();
        }

    };

}();