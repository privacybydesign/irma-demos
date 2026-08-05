'use strict';

function setupSignButton(button, resultStatus, reqName, successMessageFunc) {
    let onSuccess = function(data) {
        resultStatus.innerHTML = '<div class="alert alert-success"><div class="prefix">' +
            successMessageFunc(data.disclosed) +
            '</div><blockquote class="blockquote signedText">' +
            data.signature.message +
            '</blockquote></div>';
    };
    let onCancel = function() {
        resultStatus.innerHTML = '<div class="alert alert-warning">' +
            MESSAGES['cancel-message'] +
            '</div>';
    };
    let onError = function(data) {
        resultStatus.innerHTML = '<div class="alert alert-danger"><p><strong class="header">' +
            MESSAGES['error'] +
            '</strong></p><p><small><span class="errormsg">' +
            MESSAGES['errormsg'] +
            '</span>: <span class="data">' +
            data +
            '</span></small></div>';
    };

    button.addEventListener('click', function() {
        start_session(reqName, MESSAGES['lang'], onSuccess, onCancel, onError);
    });
}

// Email
setupSignButton(document.getElementById('btn_email_consent'), document.getElementById('email_consent_result_status'), 'email-signature', function (attributes) {
    return MESSAGES['email-success'](attributes[0][0].rawvalue);
});

// Donation
setupSignButton(document.getElementById('btn_donation'), document.getElementById('donation_result_status'), 'donation-signature', function(attributes) {
    return MESSAGES['donation-success'](
        attributes[0][0].rawvalue,
        attributes[1][0].rawvalue
    )
});

// Exam
setupSignButton(document.getElementById('btn_exam'), document.getElementById('exam_result_status'), 'exam-signature', function(attributes) {
    return MESSAGES['exam-success'](
        attributes[0][0].rawvalue,
        attributes[0][3].rawvalue,
        attributes[0][1].rawvalue,
        attributes[0][2].rawvalue);
});
