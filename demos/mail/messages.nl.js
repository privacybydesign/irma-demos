'use strict';

const MESSAGES = {
    'lang':               'nl',
    'cancel-message':     'Email check geannuleerd.',
    'error-message':      'Email check mislukt!',
    'succeeded-gmail':    '<h3>Email controle is geslaagd!</h3><p>U heeft een <tt>gmail.com</tt> adres getoond en kunt daarmee verder, bijvoorbeeld naar <a href=\"https://www.google.com/gmail/\">Gmail</a>',
    'failed-gmail':       (email) => '<h3>Email controle is niet geslaagd!</h3><p>U heeft <em>geen</em> <tt>gmail.com</tt> adres, maar wel:&nbsp;<b>' + email + '</b></p>',
    'succeeded-email':    (email) => '<h3>Het opvragen van het mailadres is geslaagd!</h3><p>U heeft het email adres:&nbsp;<b>' + email + '</b></p>',
    'back':               'Terug',
};
