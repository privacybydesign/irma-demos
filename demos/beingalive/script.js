const MAX_AGE_DAYS = 14;
const MILLISECONDS_PER_DAY = 1000 * 60 * 60 * 24;

let messages = {
    'accepted': {
        'en': (person) => inline_result('Proof of life accepted',
            'The data you revealed, ', person, ', are hereby accepted as proof of being alive.'),
        'nl': (person) => inline_result('Bewijs van in leven zijn geaccepteerd',
            'De gegevens die je toonde, ', person, ', zijn bij deze geaccepteerd als bewijs van in leven zijn.'),
    },
    'too-old': {
        'en': (days) => inline_result('These data are too old',
            `Data for an Attestatio de Vita may be at most ${MAX_AGE_DAYS} days old, but the data you revealed were loaded ${days} days ago. Refresh the BRP data in your Yivi app and try again.`),
        'nl': (days) => inline_result('Deze gegevens zijn te oud',
            `Gegevens voor een Attestatie de Vita mogen hooguit ${MAX_AGE_DAYS} dagen oud zijn, maar de gegevens die je toonde zijn ${days} dagen geleden geladen. Ververs de BRP-gegevens in je Yivi-app en probeer het opnieuw.`),
    },
};

let person = {
    'en': (initials, familyname, dateofbirth) => `${initials} ${familyname}, born on ${dateofbirth}`,
    'nl': (initials, familyname, dateofbirth) => `${initials} ${familyname}, geboren op ${dateofbirth}`,
};

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

start_session_inline(slug, lang, verifier);
