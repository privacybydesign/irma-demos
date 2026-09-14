// Attributes of one conjunction keyed by attribute name (the part after the last dot).
let attributes = (conjunction) => Object.fromEntries(
    conjunction.map((attribute) => [attribute.id.split('.').pop(), attribute.rawvalue])
);

// A master's programme is open to holders of a bachelor's (WO or HBO) or master's degree.
// The degree and education fields are free text on the diploma, so match loosely.
let givesMasterAccess = (diploma) => {
    const text = `${diploma.degree ?? ''} ${diploma.education ?? ''}`.toLowerCase();
    return /bachelor|\bb\.?sc\b|\bb\.?a\b|\bllb\b|master|\bm\.?sc\b|\bm\.?a\b|\bllm\b|\bhbo\b|\bwo\b|universit|hogeschool|university|ingenieur|\bir\b|\bdrs\b|doctoraal/.test(text);
};

let verifier = (data) => {
    const diploma = attributes(data.disclosed[0]);

    const holder = [diploma.firstname, diploma.prefix, diploma.familyname].filter(Boolean).join(' ');
    const values = {
        education: diploma.education,
        degree: diploma.degree,
        institute: diploma.institute,
        achieved: diploma.achieved,
        holder: holder,
    };
    for (let id in values) {
        document.getElementById(id).innerText = values[id] ?? '';
    }

    // The signature on the card was already verified by the Yivi server; the level
    // check is the only decision this page makes itself.
    const admissible = givesMasterAccess(diploma);
    document.getElementById('check-level').classList.add(admissible ? 'ok' : 'note');

    if (admissible) {
        document.getElementById('name').innerText = diploma.firstname ?? holder;
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        document.querySelector('.error').removeAttribute('hidden');
    }

    return false;
};

start_session_inline(slug, lang, verifier);
