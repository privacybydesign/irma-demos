$.getScript('/start_session.js', function() {
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

    $('#try_irma_ibanbtn').click(function() {
        $("#result_status").removeClass().html();
        start_session('iban', MESSAGES['lang'], success_fun, cancel_fun, error_fun);
    });
});
