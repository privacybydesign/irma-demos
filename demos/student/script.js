let result_status = document.getElementById('result_status');

let successstudent_fun = function (data) {
    let result = data.disclosed[0][0].rawvalue;
    if (result === 'student') {
        document.querySelector('main section').innerHTML = MESSAGES['succeeded-student'] + '<br> <p><a href="#" onclick="window.location.reload(true)">' +
            MESSAGES['back'] + '</a></p>';
    } else {
        document.querySelector('main section').innerHTML = MESSAGES['failed-student'] + '<br> <p><a href="#" onclick="window.location.reload(true)">' +
            MESSAGES['back'] + '</a></p>';
    }
};


let successschool_fun = function (data) {
    let role = data.disclosed[0][0].rawvalue;
    let school = data.disclosed[0][1].rawvalue;
    document.querySelector('main section').innerHTML = '<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>';
    document.querySelector('main section').prepend(MESSAGES['succeeded-school'](role, school));
};

let cancel_fun = function() {
    result_status.innerHTML = MESSAGES['cancel-message'];
    result_status.classList.add('alert', 'alert-warning');
};

let error_fun = function() {
    result_status.innerHTML = MESSAGES['error-message'];
    result_status.classList.add('alert', 'alert-danger');
};

document.getElementById('try_irma_studentbtn').addEventListener('click', function () {
    start_session('student', MESSAGES['lang'], successstudent_fun, cancel_fun, error_fun);
});

document.getElementById('try_irma_studentschoolbtn').addEventListener('click', function () {
    start_session('school', MESSAGES['lang'], successschool_fun, cancel_fun, error_fun);
});
