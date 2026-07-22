$.getScript('/start_session.js', function() {
    let success_issuance_fun = function (data) {
        let name = data.disclosed[0][0].rawvalue;
        $("#main")
            .empty()
            .append(MESSAGES['succeeded-issuance'](name))
            .append('<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>');
    };

    let success_disclosure_fun = function (data) {
        // The disclosure request requires a premium membership, so a fullname is
        // always present. Guard anyway so we never greet "Hey Null" if the
        // attribute is missing or empty (see issue #32).
        let name = data.disclosed[0][0].rawvalue;
        if (!name) {
            error_disclosure_fun();
            return;
        }
        $("#main")
            .empty()
            .append(MESSAGES['succeeded-disclosure'](name))
            .append('<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>');
    };

    let cancelled_issuance_fun = function() {
        $("#result_status")
            .html(MESSAGES['cancel-issuance-message'])
            .addClass("alert alert-warning")
            .css("font-weight", "bold");
    };

    let error_issuance_fun = function () {
        $("#result_status")
            .html(MESSAGES['error-issuance-message'])
            .addClass('alert alert-danger')
            .css('font-weight', 'bold');
    };

    let cancelled_disclosure_fun = function() {
        $("#result_status")
            .html(MESSAGES['cancel-disclosure-message'])
            .addClass("alert alert-warning")
            .css("font-weight", "bold");
    };

    let error_disclosure_fun = function () {
        $("#result_status")
            .html(MESSAGES['error-disclosure-message'])
            .addClass('alert alert-danger')
            .css('font-weight', 'bold');
    };

    $('#irmatube_premium').click(function () {
        start_session('irmatube_premium', MESSAGES['lang'], success_issuance_fun, cancelled_issuance_fun, error_issuance_fun);
    });
    
    $('#watch_premium_contents').click(function () {
        start_session('watch_premium_contents', MESSAGES['lang'], success_disclosure_fun, cancelled_disclosure_fun, error_disclosure_fun);
    });
});
