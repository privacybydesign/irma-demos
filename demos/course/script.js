// Attributes of one conjunction keyed by attribute name (the part after the last dot).
let attributes = (conjunction) => Object.fromEntries(
    conjunction.map((attribute) => [attribute.id.split('.').pop(), attribute.rawvalue])
);

// The credential the user chose, e.g. "passport" from "pbdf.pbdf.passport.firstName".
let credentialOf = (conjunction) => conjunction[0].id.split('.')[2];

let verifier = (data) => {
    const identity = attributes(data.disclosed[0]);
    const contact = attributes(data.disclosed[1]);
    const credential = credentialOf(data.disclosed[0]);

    // Travel documents use firstName/lastName, the BRP card firstnames/prefix/familyname.
    const values = {
        firstnames: identity.firstName ?? identity.firstnames,
        familyname: identity.lastName ?? [identity.prefix, identity.familyname].filter(Boolean).join(' '),
        dateofbirth: identity.dateOfBirth ?? identity.dateofbirth,
        nationality: identity.nationality,
        email: contact.email,
    };

    for (let id in values) {
        document.getElementById(id).innerText = values[id] ?? '';
    }
    document.getElementById('source').innerText = source_labels[credential] ?? credential;

    return false;
};

start_session_inline(slug, lang, verifier);
