let messages = {
    'welcome': {
        'en': (name) => inline_result(`Hey ${name} :) You're a real VIP now!`,
            'You now have access to the mighty premium material.'),
        'nl': (name) => inline_result(`Hey ${name} :) Je bent nu een echte VIP!`,
            'Je hebt nu toegang tot het machtige premium materiaal.'),
    },
    'premium': {
        'en': (name) => inline_result(`Hey ${name}!`,
            "We're still working on the premium contents. But it's going to be legendary! In the meantime you can enjoy our ad-free standard contents."),
        'nl': (name) => inline_result(`Hey ${name}!`,
            'We werken nog aan de premium inhoud. Maar het wordt legendarisch! Ondertussen kun je genieten van onze reclamevrije standaardinhoud.'),
    },
    'no-membership': {
        'en': 'It looks like you may not have a YiviTube premium membership yet. Become a premium member first, then try “Show premium contents” again.',
        'nl': 'Het lijkt erop dat je nog geen YiviTube premium lidmaatschap hebt. Word eerst premium lid en probeer “Toon premium inhoud” daarna opnieuw.',
    },
    'check-incomplete': {
        'en': 'Premium check not completed',
        'nl': 'Premium controle niet afgerond',
    },
    'become-member': {
        'en': 'Become premium member',
        'nl': 'Word premium lid',
    },
};

// A visitor without the membership has nothing to disclose, so the session ends
// as cancelled and leaves them with a bare "cancelled" message and no way
// forward (see issue #23). Offer this demo's own issuance flow instead.
function membership_guidance(message) {
    let intro = message ? [message, ' '] : [];
    let content = inline_result(messages['check-incomplete'][lang], ...intro, messages['no-membership'][lang]);

    let button = document.createElement('button');
    button.textContent = messages['become-member'][lang];
    button.addEventListener('click', () => choice.start('irmatube_premium'));

    let actions = document.createElement('p');
    actions.append(button);
    content.append(actions);

    return content;
}

let choice = start_session_choice({
    'irmatube_premium': (data) => messages['welcome'][lang](data.disclosed[0][0].rawvalue),
    'watch_premium_contents': {
        verifier: (data) => {
            // The request requires a premium membership, so a fullname is always
            // present. Guard anyway so we never greet "Hey Null" if the attribute
            // is missing or empty (see issue #32).
            let name = data.disclosed[0][0].rawvalue;
            return name ? messages['premium'][lang](name) : membership_guidance('');
        },
        // This flow renders its own cancelled and failed results, so it also has
        // to render the successful one the verifier just built.
        onError: (message, state) => {
            render_inline_result(state, state === 'result' ? message : membership_guidance(message));
        },
    },
});
