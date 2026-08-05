'use strict';

var MESSAGES = {
    'lang':               'nl',
    'cancel-message':     'Geannuleerd',
    'error':              'Fout',
    'errormsg':           'Foutmelding',
    'email-success':      (email) => {
        return `<div>Ondertekening van toestemming is geslaagd! U heeft het volgende bericht ondertekend met e-mailadres <em class="attribute email">${email}</em>:</div>`
    },
    'donation-success':   (name, number) => {
        return `<div>Ondertekening van donatie is geslaagd! U heeft het volgende bericht ondertekend met naam <em class="attribute name">${name}</em> en telefoonnummer <em class="attribute number">${number}</em></div>`
    },
    'exam-success':       (name, employee, institute, email) => {
        return `<div>Ondertekening van tentamen uitslag is geslaagd! U heeft het volgende bericht ondertekend met naam <em class="attribute name">${name}</em>, als <em class="attribute employee">${employee}</em> verbonden aan het instituut <em class="attribute institute">${institute}</em> met e-mailadres <em class="attribute email">${email}</em></div>`
    },
};
