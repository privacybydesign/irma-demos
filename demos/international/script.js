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

let isYes = (value) => ['yes', 'ja', 'true'].includes(String(value ?? '').toLowerCase());

let verifier = (data) => {
    const travelDocument = attributes(data.disclosed[0]);
    const address = attributes(data.disclosed[1]);
    const credential = credentialOf(data.disclosed[0]);

    const expiry = parseDate(travelDocument.dateOfExpiry);
    const euCitizen = isYes(travelDocument.isEuCitizen);

    const checks = {
        'check-document': expiry !== null && expiry >= new Date(),
        'check-municipality': Boolean(address.city),
    };

    document.getElementById('document').innerText = document_labels[credential] ?? credential;
    document.getElementById('expiry').innerText = travelDocument.dateOfExpiry ?? '—';
    document.getElementById('address').innerText =
        `${address.street ?? ''} ${address.houseNumber ?? ''}, ${address.zipcode ?? ''} ${address.city ?? ''}`.trim();
    document.getElementById('nationality').innerText = travelDocument.nationality ?? '—';
    document.getElementById('eu-text').innerText = eu_text[euCitizen ? 'yes' : 'no'];

    for (let id in checks) {
        document.getElementById(id).classList.add(checks[id] ? 'ok' : 'fail');
    }
    // EU citizenship is not pass/fail: it decides the next step for the student.
    document.getElementById('check-eu').classList.add(euCitizen ? 'ok' : 'note');

    if (Object.values(checks).every(Boolean)) {
        document.getElementById('name').innerText =
            `${travelDocument.firstName ?? ''} ${travelDocument.lastName ?? ''}`.trim();
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        document.querySelector('.error').removeAttribute('hidden');
    }

    return false;
};

start_session_inline(slug, lang, verifier);
