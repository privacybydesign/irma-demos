const GMAIL_DOMAIN = 'gmail.com';

let messages = {
    'domain-match': {
        'en': (domain) => ['You are signed in', 'Forum Nova saw that you have an address at ', inline_attribute(domain),
            ' — enough to let you in, and it never learned which address it is.'],
        'nl': (domain) => ['Je bent ingelogd', 'Forum Nova zag dat je een adres bij ', inline_attribute(domain),
            ' hebt — genoeg om je binnen te laten, en het heeft nooit geleerd wélk adres dat is.'],
    },
    'domain-other': {
        'en': (domain) => ['Not signed in', `This board is open to ${GMAIL_DOMAIN} members, and your address is at `,
            inline_attribute(domain), '.'],
        'nl': (domain) => ['Niet ingelogd', `Dit forum is open voor leden van ${GMAIL_DOMAIN}, en jouw adres is van `,
            inline_attribute(domain), '.'],
    },
    'address': {
        'en': (address) => ['You are registered', 'We filled your address in above. Forum Nova knows it is really yours, so there is no confirmation mail on the way.'],
        'nl': (address) => ['Je bent geregistreerd', 'We hebben je adres hierboven ingevuld. Forum Nova weet dat het echt van jou is, dus er komt geen bevestigingsmail aan.'],
    },
};

// Writes the outcome into the forum's own page instead of below the demo.
function site_result([heading, ...content]) {
    let panel = document.querySelector('.mail-result');
    let title = document.createElement('h3');
    title.textContent = heading;
    let body = document.createElement('p');
    body.append(...content);
    panel.replaceChildren(title, body);
    panel.hidden = false;
    document.querySelector('.yivi-form').hidden = true;
    return false;
}

start_session_choice({
    // This request asks for the domain attribute only, so the address itself
    // never leaves the wallet — which is why the field only shows the domain.
    'gmail': (data) => {
        let domain = data.disclosed[0][0].rawvalue;
        let matches = domain === GMAIL_DOMAIN;
        document.getElementById('mail-address').value = `••••••@${domain}`;
        return site_result(messages[matches ? 'domain-match' : 'domain-other'][lang](domain));
    },
    'email': (data) => {
        let address = data.disclosed[0][0].rawvalue;
        document.getElementById('mail-address').value = address;
        return site_result(messages['address'][lang](address));
    },
});
