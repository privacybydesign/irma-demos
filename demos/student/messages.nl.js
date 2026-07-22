'use strict';

const MESSAGES = {
    'lang':               'nl',
    'cancel-message':     'student check geannuleerd.',
    'error-message':      'student check mislukt!',
    'succeeded-student':  '<h3>Student controle geslaagd!</h3><p>Voor aanbiedingen, ga naar: <a href="https://www.studentenwegwijzer.nl/studentenkorting/">(web)winkels</a></p>',
    'failed-student':     '<h3>Student controle niet geslaagd!</h3>',
    'back':               'Terug',
    'succeeded-school':   (role, school) => {
        const fragment = document.createDocumentFragment();
        const h3 = document.createElement('h3');
        h3.textContent = 'Attribuut controle is geslaagd!';
        fragment.append(h3);
        const p = document.createElement('p');
        p.append('U bent ');
        const roleEl = document.createElement('b');
        roleEl.textContent = role;
        p.append(roleEl, ' aan de instelling met afkorting ');
        const schoolEl = document.createElement('b');
        schoolEl.textContent = school;
        p.append(schoolEl);
        fragment.append(p);
        return fragment;
    },
};
