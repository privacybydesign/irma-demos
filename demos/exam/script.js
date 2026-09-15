// The education card is keyed by attribute name; every attribute on it is optional,
// so any of these may be missing.
let attributes = (conjunction) => Object.fromEntries(
    conjunction.map((attribute) => [attribute.id.split('.').pop(), attribute.rawvalue])
);

// Stand-in for a lookup in the exam registration system: the seat is derived from
// the student number so that the same student always gets the same seat.
let seatFor = (studentNumber) => {
    const digits = String(studentNumber ?? '').replace(/\D/g, '');
    const n = digits ? Number(digits.slice(-3)) : 0;
    return `${String.fromCharCode(65 + (n % 8))}${1 + (n % 24)}`;
};

let verifier = (data) => {
    const card = attributes(data.disclosed[0]);

    const checks = {
        'check-student': String(card.type ?? '').toLowerCase() === 'student',
        'check-institute': Boolean(card.institute),
        // In a real deployment this is a lookup of the student number in the exam
        // registration; in this demo every student with a number is enrolled.
        'check-enrolled': Boolean(card.id),
    };

    document.getElementById('institute').innerText = card.institute ?? '—';
    document.getElementById('studentnumber').innerText = card.id ?? '—';
    for (let id in checks) {
        document.getElementById(id).classList.add(checks[id] ? 'ok' : 'fail');
    }

    if (Object.values(checks).every(Boolean)) {
        document.getElementById('name').innerText = card.fullname ?? '';
        document.getElementById('seat').innerText = seatFor(card.id);
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        document.querySelector('.error').removeAttribute('hidden');
    }

    return false;
};

start_session_inline(slug, lang, verifier);
