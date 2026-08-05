'use strict';

var MESSAGES = {
    'lang':               'en',
    'cancel-message':     'Cancelled',
    'error':              'Error',
    'errormsg':           'Error message',
    'email-success':      (email) => {
        return `<div>Consent signing succeeded! You have signed the following message with email address <em class="attribute email">${email}</em>:</div>`
    },
    'donation-success':   (name, number) => {
        return `<div>Signing of the donation succeeded! You have signed the following message with name <em class="attribute name">${name}</em> and phone number <em class="attribute number">${number}</em></div>`
    },
    'exam-success':       (name, employee, institute, email) => {
        return `<div>Signing of the exam outcome succeeded! You have signed the following message as <em class="attribute employee">${employee}</em> with name <em class="attribute name">${name}</em> from the institute <em class="attribute institute">${institute}</em> with email address <em class="attribute email">${email}</em></div>`
    },
};
