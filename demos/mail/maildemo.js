let result_status = $('#result_status');

let successgmail_fun = function (data) {
    let email = data.disclosed[0][0].rawvalue;
    let email_len = email.length;
    let email_tail = email.substr(email_len - 9, email_len);
    if (email_tail === 'gmail.com') {
        $("#main").html(MESSAGES['succeeded-gmail'] + '<b><p><a href=\"#\" onclick=\"window.location.reload(true)\">' +
        MESSAGES["back"] + '</a></p>');
    } else {
        $("#main")
            .empty()
            .append(MESSAGES['failed-gmail'](email))
            .append('<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>');
    }
};

let successemail_fun = function (data) {
    let email = data.disclosed[0][0].rawvalue;
    $("#main")
        .empty()
        .append(MESSAGES['succeeded-email'](email))
        .append('<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>');
};

let cancelled_fun = function() {
    result_status
        .html(MESSAGES['cancel-message'])
        .addClass("alert alert-warning");
};

let error_fun = function () {
    result_status
        .html(MESSAGES['error-message'])
        .addClass('alert alert-danger');
};

$('#try_irma_gmailbtn').click(function () {
    start_session('gmail', MESSAGES['lang'], successgmail_fun, cancelled_fun, error_fun);
});

$('#try_irma_emailbtn').click(function () {
    start_session('email', MESSAGES['lang'], successemail_fun, cancelled_fun, error_fun);
});
