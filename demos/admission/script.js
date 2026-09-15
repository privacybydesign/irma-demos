// Attributes of one conjunction keyed by attribute name (the part after the last dot).
let attributes = (conjunction) => Object.fromEntries(
    conjunction.map((attribute) => [attribute.id.split('.').pop(), attribute.rawvalue])
);

// A master's programme is open to holders of a bachelor's (NLQF 6) or higher. The NLQF
// level is optional on the card: DUO does not print it on every extract. Without a level
// we fall back to the wording of the qualification.
const MASTER_ACCESS_LEVEL = 6;

let givesMasterAccess = (diploma) => {
    const level = parseInt(diploma.nlqfLevel, 10);
    if (!Number.isNaN(level)) return level >= MASTER_ACCESS_LEVEL;
    return /bachelor|master|\bb\.?sc\b|\bm\.?sc\b|\bb\.?a\b|\bm\.?a\b|\bllb\b|\bllm\b|doctor/i
        .test(diploma.qualification ?? '');
};

let verifier = (data) => {
    const diploma = attributes(data.disclosed[0]);

    const values = {
        qualification: diploma.qualification,
        level: diploma.nlqfLevel,
        institution: diploma.institution,
        awarded: diploma.dateAwarded,
        holder: diploma.fullName,
        documenttype: String(diploma.documentType ?? '').toLowerCase(),
    };
    for (let id in values) {
        document.getElementById(id).innerText = values[id] ?? '';
    }

    document.getElementById('level-text').innerHTML = diploma.nlqfLevel
        ? level_text.known.replace('%s', String(diploma.nlqfLevel).replace(/[<>&]/g, ''))
        : level_text.unknown;

    // DUO's signature on the extract and the identity binding were checked at issuance;
    // the Yivi server verified the card's signature. The level check is the only
    // decision this page makes itself.
    const admissible = givesMasterAccess(diploma);
    document.getElementById('check-level').classList.add(admissible ? 'ok' : 'note');

    if (admissible) {
        document.getElementById('name').innerText = diploma.fullName ?? '';
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        document.querySelector('.error').removeAttribute('hidden');
    }

    return false;
};

start_session_inline(slug, lang, verifier);
