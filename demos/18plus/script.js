let result_status = document.getElementById('result_status');

let success_fun = function(data) {
    let attr = data.disclosed[0][0].rawvalue.toLowerCase();
    if(attr === 'yes' || attr === 'ja') {
        document.querySelector('main').innerHTML = MESSAGES['age-check-succeeded'] +
            '<div style="text-align: center"><img src=\"GTAVI.png\" alt="GTA VI image"></div> <br> <p><a href=\"#\" ' +
            'onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>';
    }
    else {
        document.querySelector('main').innerHTML = MESSAGES['age-check-not-succeeded'] +
            '<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>';
    }
};

let cancel_fun = function() {
    result_status.innerHTML = MESSAGES['cancel-message'];
    result_status.classList.add('alert', 'alert-warning');
};

let error_fun = function() {
    result_status.innerHTML = MESSAGES['error-message'];
    result_status.classList.add('alert', 'alert-danger');
};

start_session('18plus', MESSAGES['lang'], success_fun, cancel_fun, error_fun);
