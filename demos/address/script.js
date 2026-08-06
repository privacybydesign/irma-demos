let result_status = document.getElementById('result_status');

let success_fun = function(data) {
    let i = 0;
    let adres = data.disclosed[0][i++].rawvalue;
    if (data.disclosed[0][i].id.match('.*\.houseNumber')) {
        adres += " " + data.disclosed[0][i++].rawvalue;
    }
    let postcode = data.disclosed[0][i++].rawvalue;
    let plaats = data.disclosed[0][i].rawvalue;
    document.getElementById('adres_regel').value = adres;
    document.getElementById('postcode_regel').value = postcode;
    document.getElementById('plaats_regel').value = plaats;
};

let cancel_fun = function() {
    result_status.innerHTML = MESSAGES['cancel-message'];
    result_status.classList.add('alert', 'alert-warning');
};

let error_fun = function() {
    result_status.innerHTML = MESSAGES['error-message'];
    result_status.classList.add('alert', 'alert-danger');
};

document.getElementById('try_irma_adresbtn').addEventListener('click', function() {
    result_status.innerHTML = "";
    result_status.className = "";
    start_session('adres', MESSAGES['lang'], success_fun, cancel_fun, error_fun);
});
