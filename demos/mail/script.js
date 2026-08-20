const GMAIL_DOMAIN = 'gmail.com';

let messages = {
    'domain-match': {
        'en': (domain) => inline_result('Email check succeeded',
            'You revealed an address at ', inline_attribute(domain),
            ', which is enough to let you through, for instance to ',
            inline_link('https://www.google.com/gmail/', 'Gmail'), '.'),
        'nl': (domain) => inline_result('E-mailcontrole geslaagd',
            'Je toonde een adres bij ', inline_attribute(domain),
            ', en daarmee kun je verder, bijvoorbeeld naar ',
            inline_link('https://www.google.com/gmail/', 'Gmail'), '.'),
    },
    'domain-other': {
        'en': (domain) => inline_result('Email check not succeeded',
            `Your address is not at ${GMAIL_DOMAIN}, but at `, inline_attribute(domain), '.'),
        'nl': (domain) => inline_result('E-mailcontrole niet geslaagd',
            `Je adres is niet van ${GMAIL_DOMAIN}, maar van `, inline_attribute(domain), '.'),
    },
    'address': {
        'en': (address) => inline_result('Email address revealed',
            'You revealed the email address ', inline_attribute(address), '.'),
        'nl': (address) => inline_result('E-mailadres getoond',
            'Je toonde het e-mailadres ', inline_attribute(address), '.'),
    },
};

start_session_choice({
    // This request asks for the domain attribute only, so the address itself
    // never leaves the wallet.
    'gmail': (data) => {
        let domain = data.disclosed[0][0].rawvalue;
        let message = domain === GMAIL_DOMAIN ? 'domain-match' : 'domain-other';
        return messages[message][lang](domain);
    },
    'email': (data) => messages['address'][lang](data.disclosed[0][0].rawvalue),
});
