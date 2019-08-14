$.getScript('../start_session.js', function() {
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
        $("#result_status")
            .html(MESSAGES['cancel-message'])
            .addClass('alert alert-warning')
            .css('font-weight', 'bold');
    };

    let error_fun = function() {
        $("#result_status")
            .html(MESSAGES['error-message'])
            .addClass('alert alert-danger')
            .css('font-weight', 'bold');
    };

    $('#try_irma_adresbtn').click(function() {
        $("#result_status").removeClass().html();
        start_session('adres', MESSAGES['lang'], success_fun, cancel_fun, error_fun);
    });
});
