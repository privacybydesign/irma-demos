let messages = {
    'age-check-succeeded': {
        'en': '<h3>18+ Age check succeeded!</h3><p>You are over 18.</p>',
        'nl': '<h3>18+ leeftijdscontrole geslaagd!</h3><p>Je bent ouder dan 18.</p>',
    },
    'age-check-failed': {
        'en': '<h3>18+ Age check not succeeded!</h3><p>Unfortunately, we identified you as being a minor. Therefore we cannot show you the content.</p>',
        'nl': '<h3>18+ leeftijdscontrole is niet geslaagd</h3><p>Helaas, u bent nog geen 18 jaar. Daarom kunnen we u de inhoud niet laten zien.</p>',
    }
}

let verifier = (data) => {
    let attr = data.disclosed[0][0].rawvalue.toLowerCase();
    if(attr === 'yes' || attr === 'ja') {
        return messages['age-check-succeeded'][lang];
    }
    else {
        return messages['age-check-failed'][lang];
    }
};

start_session_inline(slug, lang, verifier);
