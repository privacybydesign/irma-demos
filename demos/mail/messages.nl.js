'use strict';

const MESSAGES = {
    'lang':               'nl',
    'cancel-message':     'Email check geannuleerd.',
    'error-message':      'Email check mislukt!',
    'succeeded-gmail':    () => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.textContent = 'Email controle is geslaagd!';
        fragment.append(h3);
        const p = document.createElement('p');
        p.append('U heeft een ');
        const tt = document.createElement('tt');
        tt.textContent = 'gmail.com';
        p.append(tt, ' adres getoond en kunt daarmee verder, bijvoorbeeld naar ');
        const a = document.createElement('a');
        a.href = 'https://www.google.com/gmail/';
        a.textContent = 'Gmail';
        p.append(a);
        fragment.append(p);
        return fragment;
    },
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
