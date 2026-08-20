const MAX_AGE_DAYS = 14;
const MILLISECONDS_PER_DAY = 1000 * 60 * 60 * 24;

let messages = {
    'accepted': {
        'en': (person) => site_result('Received, thank you',
            'We have recorded ', person, ' as this year’s proof of life. Your payments continue as usual.'),
        'nl': (person) => site_result('Ontvangen, dank je wel',
            'We hebben ', person, ' vastgelegd als het bewijs van in leven zijn voor dit jaar. Je uitkering loopt gewoon door.'),
    },
    'too-old': {
        'en': (days) => site_result('These data are too old',
            `We can only accept data that are at most ${MAX_AGE_DAYS} days old, and yours were loaded ${days} days ago. Refresh the BRP data in your Yivi app and try again.`),
        'nl': (days) => site_result('Deze gegevens zijn te oud',
            `We kunnen alleen gegevens accepteren die hooguit ${MAX_AGE_DAYS} dagen oud zijn, en die van jou zijn ${days} dagen geleden geladen. Ververs de BRP-gegevens in je Yivi-app en probeer het opnieuw.`),
    },
};

let person = {
    'en': (initials, familyname, dateofbirth) => `${initials} ${familyname}, born on ${dateofbirth}`,
    'nl': (initials, familyname, dateofbirth) => `${initials} ${familyname}, geboren op ${dateofbirth}`,
};

// Writes the outcome into the insurer's page instead of below the demo.
function site_result(heading, ...content) {
    let panel = document.querySelector('.alive-result');
    let title = document.createElement('h3');
    title.textContent = heading;
    let body = document.createElement('p');
    body.append(...content);
    panel.replaceChildren(title, body);
    panel.hidden = false;
    document.querySelector('.yivi-form').hidden = true;
    return false;
}

let verifier = (data) => {
    let attributes = data.disclosed[0].map(attribute => attribute.rawvalue);
    // issuancetime is in seconds since the epoch. A card records when it was
    // loaded, and that is what makes this freshness check possible at all.
    let age = Date.now() - 1000 * data.disclosed[0][0].issuancetime;
    let days = Math.floor(age / MILLISECONDS_PER_DAY);

    if (days > MAX_AGE_DAYS) {
        return messages['too-old'][lang](days);
    }
    return messages['accepted'][lang](inline_attribute(person[lang](...attributes)));
};

start_session_inline(session_type, lang, verifier);
