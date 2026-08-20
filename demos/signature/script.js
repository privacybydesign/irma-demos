'use strict';

// The messages compose disclosed values with inline_attribute(), so a value from
// a credential is never parsed as HTML.
let messages = {
    'email-signature': {
        'en': (a) => ['Consent recorded',
            'You signed the message below with the email address ', inline_attribute(a[0][0].rawvalue),
            '. Novara can hand this signature to a partner company, or show it to the regulator, and either can check it.'],
        'nl': (a) => ['Toestemming vastgelegd',
            'Je ondertekende het bericht hieronder met het e-mailadres ', inline_attribute(a[0][0].rawvalue),
            '. Novara kan deze handtekening doorgeven aan een partnerbedrijf of tonen aan de toezichthouder, en beide kunnen hem controleren.'],
    },
    'donation-signature': {
        'en': (a) => ['Pledge signed',
            'You signed the message below with the name ', inline_attribute(a[0][0].rawvalue),
            ' and the phone number ', inline_attribute(a[1][0].rawvalue), '. No money moved — this is a demo.'],
        'nl': (a) => ['Toezegging ondertekend',
            'Je ondertekende het bericht hieronder met de naam ', inline_attribute(a[0][0].rawvalue),
            ' en het telefoonnummer ', inline_attribute(a[1][0].rawvalue), '. Er is geen geld overgemaakt — dit is een demo.'],
    },
    'exam-signature': {
        'en': (a) => ['Result sheet signed',
            'You signed the message below as ', inline_attribute(a[0][3].rawvalue),
            ' with the name ', inline_attribute(a[0][0].rawvalue),
            ' from the institute ', inline_attribute(a[0][1].rawvalue),
            ' with the email address ', inline_attribute(a[0][2].rawvalue), '.'],
        'nl': (a) => ['Cijferlijst ondertekend',
            'Je ondertekende het bericht hieronder met de naam ', inline_attribute(a[0][0].rawvalue),
            ', als ', inline_attribute(a[0][3].rawvalue),
            ' verbonden aan het instituut ', inline_attribute(a[0][1].rawvalue),
            ' met het e-mailadres ', inline_attribute(a[0][2].rawvalue), '.'],
    },
};

// Writes the confirmation into the pretend website, and quotes the signed text
// back below it so the visitor can see exactly what they put their name under.
function site_result(demo, [heading, ...content], signed) {
    let site = document.querySelector(`[data-demo="${demo}"]`);
    let title = document.createElement('h3');
    title.textContent = heading;
    let body = document.createElement('p');
    body.append(...content);
    let quote = document.createElement('blockquote');
    quote.className = 'signed-text';
    quote.textContent = signed;

    let panel = site.querySelector('.site-panel');
    panel.replaceChildren(title, body, quote);
    panel.hidden = false;
    site.querySelector('.yivi-form').hidden = true;
    return false;
}

let sign = (type) => (data) => site_result(type, messages[type][lang](data.disclosed), data.signature.message);

start_session_choice({
    'email-signature': sign('email-signature'),
    'donation-signature': sign('donation-signature'),
    'exam-signature': sign('exam-signature'),
});
