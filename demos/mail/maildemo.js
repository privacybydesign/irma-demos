let result_status = document.getElementById('result_status');

let successgmail_fun = function (data) {
    let email = data.disclosed[0][0].rawvalue;
    let email_len = email.length;
    let email_tail = email.substr(email_len - 9, email_len);
    if (email_tail === 'gmail.com') {
        document.getElementById("main").innerHTML = MESSAGES['succeeded-gmail'] + '<b><p><a href=\"#\" onclick=\"window.location.reload(true)\">' +
            MESSAGES["back"] + '</a></p>';
    } else {
        document.getElementById("main").innerHTML = MESSAGES['failed-gmail'](email) +
            '<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>';
    }
};

let successemail_fun = function (data) {
    let email = data.disclosed[0][0].rawvalue;
    document.getElementById("main").innerHTML = MESSAGES['succeeded-email'](email) +
        '<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>';
};

let cancel_fun = function() {
    result_status.innerHTML = MESSAGES['cancel-message'];
    result_status.classList.add('alert', 'alert-warning');
};

let error_fun = function() {
    result_status.innerHTML = MESSAGES['error-message'];
    result_status.classList.add('alert', 'alert-danger');
};

document.getElementById('#try_irma_gmailbtn').addEventListener('click', function () {
    start_session('gmail', MESSAGES['lang'], successgmail_fun, cancel_fun, error_fun);
});

document.getElementById('#try_irma_emailbtn').addEventListener('click', function () {
    start_session('email', MESSAGES['lang'], successemail_fun, cancel_fun, error_fun);
});
