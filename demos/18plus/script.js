let messages = {
    'over18': {
        'en': 'Age confirmed. You are old enough for this title, so the store page is yours.',
        'nl': 'Leeftijd bevestigd. Je bent oud genoeg voor deze titel, dus de winkelpagina is van jou.',
    },
    'under18': {
        'en': 'We could not confirm that you are over 18, so we cannot show you this title.',
        'nl': 'We konden niet vaststellen dat je ouder dan 18 bent, dus we kunnen je deze titel niet tonen.',
    },
};

let verifier = (data) => {
    let value = data.disclosed[0][0].rawvalue.toLowerCase();
    let over18 = value === 'yes' || value === 'ja';

    let panel = document.querySelector('.mock-panel');
    panel.querySelector('.age-result').textContent = messages[over18 ? 'over18' : 'under18'][lang];
    panel.hidden = false;
    if (over18) panel.querySelector('p:has(button)').hidden = false;

    document.querySelector('.yivi-form').hidden = true;

    // The store page is the result; there is nothing to add below the demo.
    return false;
};

start_session_inline(session_type, lang, verifier);
