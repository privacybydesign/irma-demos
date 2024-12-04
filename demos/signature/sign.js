'use strict';

$.getScript('/start_session.js', function() {
    function setupSignButton(button, resultStatus, reqName, successMessageFunc) {
        let onSuccess = function(data) {
            resultStatus.html('<div class="alert alert-success"><div class="prefix"></div><blockquote class="blockquote signedText"></blockquote></div>');
            $('.prefix', resultStatus).html(successMessageFunc(data.disclosed).html());
            $('.signedText', resultStatus).html(data.signature.message);
        };
        let onCancel = function() {
            resultStatus.html('<div class="alert alert-warning"></div>');
            $('div', resultStatus).text(MESSAGES['cancel-message']);
        };
        let onError = function(data) {
            resultStatus.html('<div class="alert alert-danger"><p><strong class="header"></strong></p><p><small><span class="errormsg"></span>: <span class="data"></span></small></div>');
            $('.error', resultStatus).text(MESSAGES['error']);
            $('.errormsg', resultStatus).text(MESSAGES['errormsg']);
            $('.data', resultStatus).text(data);
        };

        button.click(function() {
            start_session(reqName, MESSAGES['lang'], onSuccess, onCancel, onError);
        });
    }

    // Email
    setupSignButton($('#btn_email_consent'), $('#email_consent_result_status'), 'email-signature', function (attributes) {
        let message = $(MESSAGES['email-success']);
        $('.attribute.email', message).text(attributes[0][0].rawvalue);
        return message;
    });

    // Donation
    setupSignButton($('#btn_donation'), $('#donation_result_status'), 'donation-signature', function(attributes) {
        let name = attributes[0][0].rawvalue;
        let number = attributes[1][0].rawvalue;
        let el = $(MESSAGES['donation-success']);
        $('.attribute.name', el).text(name);
        $('.attribute.number', el).text(number);
        return el;
    });

    // Exam
    setupSignButton($('#btn_exam'), $('#exam_result_status'), 'exam-signature', function(attributes) {
        let el = $(MESSAGES['exam-success']);
        $('.attribute.name', el).text(attributes[0][0].rawvalue);
        $('.attribute.institute', el).text(attributes[0][1].rawvalue);
        $('.attribute.email', el).text(attributes[0][2].rawvalue);
        $('.attribute.employee', el).text(attributes[0][3].rawvalue);
        return el;
    });
});
