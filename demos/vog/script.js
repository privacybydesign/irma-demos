// A VOG for volunteering with minors is accepted when it is at most this many months old.
const VOG_MAX_AGE_MONTHS = 6;

// Attribute dates arrive as YYYY-MM-DD (VOG, travel documents) or DD-MM-YYYY (BRP).
// Returns [year, month, day] as numbers, or null when the value is not a date.
let parseDate = (value) => {
    const parts = String(value ?? '').match(/\d+/g);
    if (!parts || parts.length < 3) return null;
    const ordered = parts[0].length === 4 ? parts : [parts[2], parts[1], parts[0]];
    return ordered.slice(0, 3).map(Number);
};

let sameDate = (a, b) => {
    const p = parseDate(a), q = parseDate(b);
    return p !== null && q !== null && p.join('-') === q.join('-');
};

// Lower-case, strip accents and anything that is not a letter, so "De Vries" matches "Vries".
let normaliseName = (value) => String(value ?? '')
    .toLowerCase()
    .normalize('NFD')
    .replace(/[̀-ͯ]/g, '')
    .replace(/[^a-z]/g, '');

let isRecent = (value) => {
    const p = parseDate(value);
    if (p === null) return false;
    const issued = new Date(p[0], p[1] - 1, p[2]);
    const cutoff = new Date();
    cutoff.setMonth(cutoff.getMonth() - VOG_MAX_AGE_MONTHS);
    return issued >= cutoff && issued <= new Date();
};

let verifier = (data) => {
    // First conjunction: identity, either the BRP card (fullname, dateofbirth)
    // or a travel document (firstName, lastName, dateOfBirth).
    const identity = data.disclosed[0];
    let name, dateOfBirth;
    if (identity.length === 2) {
        name = identity[0].rawvalue;
        dateOfBirth = identity[1].rawvalue;
    } else {
        name = `${identity[0].rawvalue} ${identity[1].rawvalue}`;
        dateOfBirth = identity[2].rawvalue;
    }

    // Second conjunction: the VOG card, keyed by attribute name.
    const vog = Object.fromEntries(
        data.disclosed[1].map((attribute) => [attribute.id.split('.').pop(), attribute.rawvalue])
    );

    const checks = {
        'check-identity': sameDate(dateOfBirth, vog.dateOfBirth)
            && normaliseName(name).includes(normaliseName(vog.surname)),
        'check-minors': ['yes', 'ja'].includes(String(vog.aspect84).toLowerCase()),
        'check-recent': isRecent(vog.issueDate),
    };

    document.getElementById('limit').innerText = VOG_MAX_AGE_MONTHS;
    for (let id in checks) {
        document.getElementById(id).classList.add(checks[id] ? 'ok' : 'fail');
    }

    if (Object.values(checks).every(Boolean)) {
        document.getElementById('name').innerText = name;
        document.getElementById('issueDate').innerText = vog.issueDate;
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        document.querySelector('.error').removeAttribute('hidden');
    }

    return false;
};

start_session_inline(slug, lang, verifier);
