$.getScript('/start_session.js', function() {
    let success_fun = function(data) {
        let attr = data.disclosed[0][0].rawvalue.toLowerCase();
        if(attr === 'yes' || attr === 'ja') {
            $('#main').html(MESSAGES['age-check-succeeded'] +
                '<div style="text-align: center"><img src=\"gtavi.png\" alt="GTA VI image"></div> <br> <p><a href=\"#\" ' +
                'onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>');
        }
        else {
            $('#main').html(MESSAGES['age-check-not-succeeded'] +
                '<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>');
        }
    };

    let cancel_fun = function() {
        $('#result_status')
            .html(MESSAGES['cancel-message'])
            .addClass('alert alert-warning')
            .css('font-weight', 'bold');
    };

    let error_fun = function() {
        $('#result_status')
            .html(MESSAGES['error-message'])
            .addClass('alert alert-danger')
            .css('font-weight', 'bold');
    };

    $('#try_irma_18btn').click(function() {
        $('#result_status').removeClass().html();
        start_session('18plus', MESSAGES['lang'], success_fun, cancel_fun, error_fun);
    });

});
