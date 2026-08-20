'use strict';

// The messages compose disclosed values with inline_attribute(), so a value from
// a credential is never parsed as HTML.
let messages = {
    'email-signature': {
        'en': (a) => inline_result('Consent signed',
            'You signed the message below with the email address ', inline_attribute(a[0][0].rawvalue), '.'),
        'nl': (a) => inline_result('Toestemming ondertekend',
            'Je ondertekende het bericht hieronder met het e-mailadres ', inline_attribute(a[0][0].rawvalue), '.'),
    },
    'donation-signature': {
        'en': (a) => inline_result('Donation signed',
            'You signed the message below with the name ', inline_attribute(a[0][0].rawvalue),
            ' and the phone number ', inline_attribute(a[1][0].rawvalue), '.'),
        'nl': (a) => inline_result('Donatie ondertekend',
            'Je ondertekende het bericht hieronder met de naam ', inline_attribute(a[0][0].rawvalue),
            ' en het telefoonnummer ', inline_attribute(a[1][0].rawvalue), '.'),
    },
    'exam-signature': {
        'en': (a) => inline_result('Exam result signed',
            'You signed the message below as ', inline_attribute(a[0][3].rawvalue),
            ' with the name ', inline_attribute(a[0][0].rawvalue),
            ' from the institute ', inline_attribute(a[0][1].rawvalue),
            ' with the email address ', inline_attribute(a[0][2].rawvalue), '.'),
        'nl': (a) => inline_result('Tentamenresultaat ondertekend',
            'Je ondertekende het bericht hieronder met de naam ', inline_attribute(a[0][0].rawvalue),
            ', als ', inline_attribute(a[0][3].rawvalue),
            ' verbonden aan het instituut ', inline_attribute(a[0][1].rawvalue),
            ' met het e-mailadres ', inline_attribute(a[0][2].rawvalue), '.'),
    },
};

// Quotes the signed text back below the confirmation, so the visitor can see
// exactly what they put their name under.
function with_signed_text(content, message) {
    let quote = document.createElement('blockquote');
    quote.className = 'signed-text';
    quote.textContent = message;
    content.append(quote);
    return content;
}

let sign = (type) => (data) => with_signed_text(messages[type][lang](data.disclosed), data.signature.message);

start_session_choice({
    'email-signature': sign('email-signature'),
    'donation-signature': sign('donation-signature'),
    'exam-signature': sign('exam-signature'),
});
