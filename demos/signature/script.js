'use strict';

function setupSignButton(button, resultStatus, reqName, successMessageFunc) {
    let showResult = function (className, ...content) {
        let alert = document.createElement('div');
        alert.className = 'alert ' + className;
        alert.append(...content);
        resultStatus.replaceChildren(alert);
    };

    let onSuccess = function(data) {
        let prefix = document.createElement('div');
        prefix.className = 'prefix';
        prefix.append(successMessageFunc(data.disclosed));

        let signedText = document.createElement('blockquote');
        signedText.className = 'blockquote signedText';
        signedText.textContent = data.signature.message;

        showResult('alert-success', prefix, signedText);
    };

    let onCancel = function() {
        showResult('alert-warning', MESSAGES['cancel-message']);
    };

    let onError = function(data) {
        let heading = document.createElement('p');
        let strong = document.createElement('strong');
        strong.className = 'header';
        strong.textContent = MESSAGES['error'];
        heading.append(strong);

        let detail = document.createElement('p');
        let small = document.createElement('small');
        let label = document.createElement('span');
        label.className = 'errormsg';
        label.textContent = MESSAGES['errormsg'];
        let value = document.createElement('span');
        value.className = 'data';
        value.textContent = data;
        small.append(label, ': ', value);
        detail.append(small);

        showResult('alert-danger', heading, detail);
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
