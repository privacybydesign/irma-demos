// Attributes of one conjunction keyed by attribute name (the part after the last dot).
let attributes = (conjunction) => Object.fromEntries(
    conjunction.map((attribute) => [attribute.id.split('.').pop(), attribute.rawvalue])
);

// The credential the user chose, e.g. "passport" from "pbdf.pbdf.passport.firstName".
let credentialOf = (conjunction) => conjunction[0].id.split('.')[2];

// Travel document dates arrive as YYYY-MM-DD. Returns a Date, or null when unparseable.
let parseDate = (value) => {
    const parts = String(value ?? '').match(/\d+/g);
    if (!parts || parts.length < 3) return null;
    const [y, m, d] = parts[0].length === 4 ? parts : [parts[2], parts[1], parts[0]];
    return new Date(Number(y), Number(m) - 1, Number(d));
};

// Lower-case, strip accents and anything that is not a letter, so "De Vries" matches "Vries".
let normaliseName = (value) => String(value ?? '')
    .toLowerCase()
    .normalize('NFD')
    .replace(/[̀-ͯ]/g, '')
    .replace(/[^a-z]/g, '');

let verifier = (data) => {
    const identity = attributes(data.disclosed[0]);
    const address = attributes(data.disclosed[1]);
    const bank = attributes(data.disclosed[2]);
    const credential = credentialOf(data.disclosed[0]);

    const expiry = parseDate(identity.dateOfExpiry);

    const checks = {
        'check-document': expiry !== null && expiry >= new Date(),
        // The bank's account holder name is usually "Initials Surname"; require the surname.
        'check-iban': normaliseName(bank.fullname).includes(normaliseName(identity.lastName)),
    };

    // The iDIN address card has a single address line; the municipal cards split it.
    const street = address.address ?? `${address.street ?? ''} ${address.houseNumber ?? ''}`.trim();

    const values = {
        firstnames: identity.firstName,
        familyname: identity.lastName,
        dateofbirth: identity.dateOfBirth,
        nationality: identity.nationality,
        address: `${street}, ${address.zipcode ?? ''} ${address.city ?? ''}`,
        iban: bank.iban,
        document: document_labels[credential] ?? credential,
        documentnumber: identity.documentNumber,
        expiry: identity.dateOfExpiry,
        accountholder: bank.fullname,
    };

    for (let id in values) {
        document.getElementById(id).innerText = values[id] ?? '';
    }
    for (let id in checks) {
        document.getElementById(id).classList.add(checks[id] ? 'ok' : 'fail');
    }

    if (Object.values(checks).every(Boolean)) {
        document.getElementById('name').innerText = identity.firstName ?? '';
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        document.querySelector('.error').removeAttribute('hidden');
    }

    return false;
};

start_session_inline(slug, lang, verifier);
