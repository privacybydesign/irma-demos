'use strict';

const MESSAGES = {
    'lang':               'nl',
    'cancel-issuance-message':     'IRMATube registratie geannuleerd.',
    'error-issuance-message':      'IRMATube registratie mislukt!',
    'cancel-disclosure-message':     'IRMATube premium check geannuleerd.',
    'error-disclosure-message':      'IRMATube premium check mislukt!',
    'no-membership-message':         'Het lijkt erop dat je nog geen YiviTube premium lidmaatschap hebt. Word eerst premium lid en probeer daarna opnieuw op “Toon premium inhoud” te klikken.',
    'become-member-button':          'Word YiviTube premium lid',
    'succeeded-issuance':    (name) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.append('Hey ');
        const nameEl = document.createElement('span');
        nameEl.textContent = name;
        h3.append(nameEl, ' :) Je bent nu een echte VIP!');
        fragment.append(h3);
        const p = document.createElement('p');
        p.textContent = 'Je hebt nu toegang tot het premium materiaal.';
        fragment.append(p);
        return fragment;
    },
    'succeeded-disclosure':    (name) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.append('Hey ');
        const nameEl = document.createElement('span');
        nameEl.textContent = name;
        h3.append(nameEl, '!');
        fragment.append(h3);
        const p = document.createElement('p');
        p.textContent = 'We werken nog aan onze premium content. Maar het wordt sowieso legendary! In de tussentijd geniet je in ieder geval van reclame-vrije standaard contents.';
        fragment.append(p);
        return fragment;
    },
    'back':               'Terug',
};
