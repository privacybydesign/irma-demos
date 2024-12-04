'use strict';

const MESSAGES = {
    'lang':               'en',
    'cancel-message':     'Email verification cancelled.',
    'error-message':      'Email verification failed!',
    'succeeded-gmail':    '<h3>Email verification succeeded!</h3><p>You have revealed a <tt>gmail.com</tt> address, which allows you to proceed, for instance to <a href=\"https://www.google.com/gmail/\">Gmail</a>',
    'failed-gmail':       (email) => '<h3>Email verification failed!</h3><p>You do <em>not</em> have a <tt>gmail.com</tt> address, but:&nbsp;<b>' + email + '</b></p>',
    'succeeded-email':    (email) => '<h3>Email disclosure succeeded!</h3><p>You have revealed email address:&nbsp;<b>' + email + '</b></p>',
    'back':               'Back',
};
