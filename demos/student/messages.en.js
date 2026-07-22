'use strict';

const MESSAGES = {
    'lang':               'en',
    'cancel-message':     'student verification cancelled.',
    'error-message':      'student verification failed!',
    'succeeded-student':  '<h3>Student verification succeeded!</h3><p>For special offers, in Dutch, go to: <a href="https://www.studentenwegwijzer.nl/studentenkorting/">(web)winkels</a></p>',
    'failed-student':     '<h3>Student verification failed!</h3>',
    'back':               'Back',
    'succeeded-school':   (role, school) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.textContent = 'Attribute verification succeeded!';
        fragment.append(h3);
        const p = document.createElement('p');
        p.append('You are ');
        const roleEl = document.createElement('b');
        roleEl.textContent = role;
        p.append(roleEl, ' at the institution with abbreviation: ');
        const schoolEl = document.createElement('b');
        schoolEl.textContent = school;
        p.append(schoolEl);
        fragment.append(p);
        return fragment;
    },
};
