let messages = {
    'is-student': {
        'en': () => inline_result('Student check succeeded',
            'For special offers, in Dutch, go to ',
            inline_link('https://www.studentenwegwijzer.nl/studentenkorting/', '(web)winkels'), '.'),
        'nl': () => inline_result('Studentcontrole geslaagd',
            'Voor aanbiedingen, ga naar ',
            inline_link('https://www.studentenwegwijzer.nl/studentenkorting/', '(web)winkels'), '.'),
    },
    'not-a-student': {
        'en': (role) => inline_result('Student check not succeeded',
            'You revealed the role ', inline_attribute(role), ', which is not a student.'),
        'nl': (role) => inline_result('Studentcontrole niet geslaagd',
            'Je toonde de rol ', inline_attribute(role), ', en dat is geen student.'),
    },
    'role-and-institution': {
        'en': (role, institute) => inline_result('Attribute check succeeded',
            'You are ', inline_attribute(role), ' at the institution with abbreviation ',
            inline_attribute(institute), '.'),
        'nl': (role, institute) => inline_result('Attribuutcontrole geslaagd',
            'Je bent ', inline_attribute(role), ' aan de instelling met afkorting ',
            inline_attribute(institute), '.'),
    },
};

start_session_choice({
    'student': (data) => {
        let role = data.disclosed[0][0].rawvalue;
        return role === 'student'
            ? messages['is-student'][lang]()
            : messages['not-a-student'][lang](role);
    },
    'school': (data) => {
        let [role, institute] = data.disclosed[0].map(attribute => attribute.rawvalue);
        return messages['role-and-institution'][lang](role, institute);
    },
});
