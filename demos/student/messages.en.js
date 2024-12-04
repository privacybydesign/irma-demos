'use strict';

const MESSAGES = {
    'lang':               'en',
    'cancel-message':     'student verification cancelled.',
    'error-message':      'student verification failed!',
    'succeeded-student':  '<h3>Student verification succeeded!</h3><p>For special offers, in Dutch, go to: <a href="https://www.studentenwegwijzer.nl/studentenkorting/">(web)winkels</a></p>',
    'failed-student':     '<h3>Student verification failed!</h3>',
    'back':               'Back',
    'succeeded-school':   (role, school) => '<h3>Attribute verification succeeded!</h3><p>You are <b>' + role + '</b> at the institution with abbreviation: <b>' + school + '</b></p>',
};
