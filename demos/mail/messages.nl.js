'use strict';

const MESSAGES = {
    'lang':               'nl',
    'cancel-message':     'Email check geannuleerd.',
    'error-message':      'Email check mislukt!',
    'succeeded-gmail':    '<h3>Email controle is geslaagd!</h3><p>U heeft een <tt>gmail.com</tt> adres getoond en kunt daarmee verder, bijvoorbeeld naar <a href=\"https://www.google.com/gmail/\">Gmail</a>',
    'failed-gmail':       (email) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.textContent = 'Email controle is niet geslaagd!';
        fragment.append(h3);
        const p = document.createElement('p');
        p.append('U heeft ');
        const em = document.createElement('em');
        em.textContent = 'geen';
        p.append(em, ' ');
        const tt = document.createElement('tt');
        tt.textContent = 'gmail.com';
        p.append(tt, ' adres, maar wel: ');
        const b = document.createElement('b');
        b.textContent = email;
        p.append(b);
        fragment.append(p);
        return fragment;
    },
    'succeeded-email':    (email) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.textContent = 'Het opvragen van het mailadres is geslaagd!';
        fragment.append(h3);
        const p = document.createElement('p');
        p.append('U heeft het email adres: ');
        const b = document.createElement('b');
        b.textContent = email;
        p.append(b);
        fragment.append(p);
        return fragment;
    },
    'back':               'Terug',
};
