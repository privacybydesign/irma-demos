'use strict';

const MESSAGES = {
    'lang':               'en',
    'cancel-message':     'Email verification cancelled.',
    'error-message':      'Email verification failed!',
    'succeeded-gmail':    '<h3>Email verification succeeded!</h3><p>You have revealed a <tt>gmail.com</tt> address, which allows you to proceed, for instance to <a href=\"https://www.google.com/gmail/\">Gmail</a>',
    'failed-gmail':       (email) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.textContent = 'Email verification failed!';
        fragment.append(h3);
        const p = document.createElement('p');
        p.append('You do ');
        const em = document.createElement('em');
        em.textContent = 'not';
        p.append(em, ' have a ');
        const tt = document.createElement('tt');
        tt.textContent = 'gmail.com';
        p.append(tt, ' address, but: ');
        const b = document.createElement('b');
        b.textContent = email;
        p.append(b);
        fragment.append(p);
        return fragment;
    },
    'succeeded-email':    (email) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.textContent = 'Email disclosure succeeded!';
        fragment.append(h3);
        const p = document.createElement('p');
        p.append('You have revealed email address: ');
        const b = document.createElement('b');
        b.textContent = email;
        p.append(b);
        fragment.append(p);
        return fragment;
    },
    'back':               'Back',
};
