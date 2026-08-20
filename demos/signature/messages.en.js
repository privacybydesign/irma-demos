'use strict';

// The success builders return DOM nodes and set disclosed values with
// textContent, so a value from a credential can never be parsed as HTML.
var MESSAGES = {
    'lang':               'en',
    'cancel-message':     'Cancelled',
    'error':              'Error',
    'errormsg':           'Error message',
    'email-success':      (email) => {
        const div = document.createElement('div');
        div.append('Consent signing succeeded! You have signed the following message with email address ');
        div.append(signatureAttribute('email', email), ':');
        return div;
    },
    'donation-success':   (name, number) => {
        const div = document.createElement('div');
        div.append('Signing of the donation succeeded! You have signed the following message with name ');
        div.append(signatureAttribute('name', name), ' and phone number ', signatureAttribute('number', number));
        return div;
    },
    'exam-success':       (name, employee, institute, email) => {
        const div = document.createElement('div');
        div.append('Signing of the exam outcome succeeded! You have signed the following message as ');
        div.append(
            signatureAttribute('employee', employee), ' with name ',
            signatureAttribute('name', name), ' from the institute ',
            signatureAttribute('institute', institute), ' with email address ',
            signatureAttribute('email', email),
        );
        return div;
    },
};

function signatureAttribute(name, value) {
    const em = document.createElement('em');
    em.className = 'attribute ' + name;
    em.textContent = value;
    return em;
}
