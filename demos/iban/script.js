let result_status = document.getElementById('result_status');

let success_fun = function(data) {
    let i = 0;
    let fullname = data.disclosed[0][0].rawvalue;
    let iban = data.disclosed[0][1].rawvalue;
    let bic = data.disclosed[0][2].rawvalue;

    document.getElementById('iban').value = iban;
    document.getElementById('bic').value = bic;
    document.getElementById('fullname').value = fullname;
};

let cancel_fun = function() {
    result_status.innerHTML = MESSAGES['cancel-message'];
    result_status.classList.add('alert', 'alert-warning');
};

let error_fun = function() {
    result_status.innerHTML = MESSAGES['error-message'];
    result_status.classList.add('alert', 'alert-danger');
};

document.getElementById('try_irma_ibanbtn').addEventListener('click', function() {
    result_status.innerHTML = "";
    result_status.className = "";
    start_session('iban', MESSAGES['lang'], success_fun, cancel_fun, error_fun);
});
