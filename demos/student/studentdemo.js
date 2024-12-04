$.getScript('/start_session.js', function() {
    let successstudent_fun = function (data) {
        let result = data.disclosed[0][0].rawvalue;
        if (result === 'student') {
            $('#main').html(MESSAGES['succeeded-student'] + '<br> <p><a href="#" onclick="window.location.reload(true)">' +
                MESSAGES['back'] + '</a></p>');
        } else {
            $('#main').html(MESSAGES['failed-student'] + '<br> <p><a href="#" onclick="window.location.reload(true)">' +
                MESSAGES['back'] + '</a></p>');
        }
    };


    let successschool_fun = function (data) {
        let role = data.disclosed[0][0].rawvalue;
        let school = data.disclosed[0][1].rawvalue;
        $('#main').html(MESSAGES['succeeded-school'](role, school) + '<br>' +
            '<p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>');
    };

    let cancel_fun = function () {
        $('#result_status')
            .html(MESSAGES['cancel-message'])
            .addClass('alert alert-warning')
            .css('font-weight', 'bold');
    };

    let error_fun = function () {
        $('#result_status')
            .html(MESSAGES['error-message'])
            .addClass('alert alert-danger')
            .css('font-weight', 'bold');
    };

    $('#try_irma_studentbtn').click(function () {
        start_session('student', MESSAGES['lang'], successstudent_fun, cancel_fun, error_fun);
    });

    $('#try_irma_studentschoolbtn').click(function () {
        start_session('school', MESSAGES['lang'], successschool_fun, cancel_fun, error_fun);
    });
});
