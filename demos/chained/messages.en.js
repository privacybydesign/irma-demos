'use strict';

const MESSAGES = {
    'lang':               'en',
    'cancel-issuance-message':     'IRMATube registration cancelled.',
    'error-issuance-message':      'IRMATube registration failed!',
    'cancel-disclosure-message':     'IRMATube premium check cancelled.',
    'error-disclosure-message':      'IRMATube premium check failed!',
    'no-membership-message':         'It looks like you may not have a YiviTube premium membership yet. Become a premium member first, then try “Show premium contents” again.',
    'become-member-button':          'Become premium member',
    'succeeded-issuance':    (name) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.append('Hey ');
        const nameEl = document.createElement('span');
        nameEl.textContent = name;
        h3.append(nameEl, ' :) You\'re a real VIP now!');
        fragment.append(h3);
        const p = document.createElement('p');
        p.textContent = 'You now have access to the mighty premium material.';
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
        p.textContent = 'We\'re still working on the premium contents. But it\'s going to be legendary! In the meantime you can enjoy our ad-free standard contents.';
        fragment.append(p);
        return fragment;
    },
    'back':               'Back',
};
