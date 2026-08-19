'use strict';

// De success-builders geven DOM-nodes terug en zetten getoonde waardes met
// textContent, zodat een waarde uit een kaartje nooit als HTML wordt geparsed.
var MESSAGES = {
    'lang':               'nl',
    'cancel-message':     'Geannuleerd',
    'error':              'Fout',
    'errormsg':           'Foutmelding',
    'email-success':      (email) => {
        const div = document.createElement('div');
        div.append('Ondertekening van toestemming is geslaagd! U heeft het volgende bericht ondertekend met e-mailadres ');
        div.append(signatureAttribute('email', email), ':');
        return div;
    },
    'donation-success':   (name, number) => {
        const div = document.createElement('div');
        div.append('Ondertekening van donatie is geslaagd! U heeft het volgende bericht ondertekend met naam ');
        div.append(signatureAttribute('name', name), ' en telefoonnummer ', signatureAttribute('number', number));
        return div;
    },
    'exam-success':       (name, employee, institute, email) => {
        const div = document.createElement('div');
        div.append('Ondertekening van tentamen uitslag is geslaagd! U heeft het volgende bericht ondertekend met naam ');
        div.append(
            signatureAttribute('name', name), ', als ',
            signatureAttribute('employee', employee), ' verbonden aan het instituut ',
            signatureAttribute('institute', institute), ' met e-mailadres ',
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
