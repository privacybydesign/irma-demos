'use strict';

const MESSAGES = {
    'lang':               'nl',
    'cancel-message':     'student check geannuleerd.',
    'error-message':      'student check mislukt!',
    'succeeded-student':  '<h3>Student controle geslaagd!</h3><p>Voor aanbiedingen, ga naar: <a href="https://www.studentenwegwijzer.nl/studentenkorting/">(web)winkels</a></p>',
    'failed-student':     '<h3>Student controle niet geslaagd!</h3>',
    'back':               'Terug',
    'succeeded-school':   (role, school) => '<h3>Attribuut controle is geslaagd!</h3><p>U bent <b>' + role  + '</b> aan de instelling met afkorting <b>' + school + '</b></p>',
};
