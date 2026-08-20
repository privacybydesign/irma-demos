let messages = {
    'is-student': {
        'en': () => ['Student price applied',
            'Bitbyte learned only that you are a student — not your name, not where you study. ',
            inline_link('https://www.studentenwegwijzer.nl/studentenkorting/', 'More student offers'), '.'],
        'nl': () => ['Studentenprijs toegepast',
            'Bitbyte heeft alleen geleerd dat je student bent — niet je naam, niet waar je studeert. ',
            inline_link('https://www.studentenwegwijzer.nl/studentenkorting/', 'Meer studentenaanbiedingen'), '.'],
    },
    'not-a-student': {
        'en': (role) => ['No student discount',
            'You revealed the role ', inline_attribute(role), ', so the regular price stands.'],
        'nl': (role) => ['Geen studentenkorting',
            'Je toonde de rol ', inline_attribute(role), ', dus de gewone prijs blijft staan.'],
    },
    'role-and-institution': {
        'en': (role, institute) => ['Welcome in',
            'You are ', inline_attribute(role), ' at ', inline_attribute(institute),
            ', so we opened what that institution licenses.'],
        'nl': (role, institute) => ['Welkom',
            'Je bent ', inline_attribute(role), ' aan ', inline_attribute(institute),
            ', dus we hebben opengezet wat die instelling licentieert.'],
    },
};

// Writes the outcome into the pretend website instead of below the demo.
function site_result(demo, [heading, ...content]) {
    let site = document.querySelector(`[data-demo="${demo}"]`);
    let title = document.createElement('h3');
    title.textContent = heading;
    let body = document.createElement('p');
    body.append(...content);

    let panel = site.querySelector('.mock-panel');
    panel.replaceChildren(title, body);
    panel.hidden = false;
    site.querySelector('.yivi-form').hidden = true;
    return false;
}

start_session_choice({
    'student': (data) => {
        let role = data.disclosed[0][0].rawvalue;
        if (role !== 'student') {
            return site_result('student', messages['not-a-student'][lang](role));
        }
        document.querySelector('.shop-price').hidden = true;
        document.querySelector('.shop-discounted').hidden = false;
        return site_result('student', messages['is-student'][lang]());
    },
    'school': (data) => {
        let [role, institute] = data.disclosed[0].map(attribute => attribute.rawvalue);
        document.getElementById('campus-role').value = role;
        document.getElementById('campus-institute').value = institute;
        return site_result('school', messages['role-and-institution'][lang](role, institute));
    },
});
