// Attributes of one conjunction keyed by attribute name (the part after the last dot).
let attributes = (conjunction) => Object.fromEntries(
    conjunction.map((attribute) => [attribute.id.split('.').pop(), attribute.rawvalue])
);

let verifier = (data) => {
    const card = attributes(data.disclosed[0]);
    const type = String(card.type ?? '').toLowerCase();

    if (type in role_labels) {
        document.getElementById('role').innerText = role_labels[type];
        document.getElementById('institute').innerText = card.institute ?? '—';
        document.getElementById('sports-rate').innerText = sports_rates[type];
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        document.getElementById('type').innerText = card.type ?? '—';
        document.querySelector('.error').removeAttribute('hidden');
    }

    return false;
};

start_session_inline(slug, lang, verifier);
