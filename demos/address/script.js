let verifier = (data) => {

    const values = {
        'adres': data.disclosed[0][0].rawvalue,
        'postcode': data.disclosed[0][2].rawvalue,
        'plaats': data.disclosed[0][3].rawvalue,
    }
    if (data.disclosed[0][1].id.match('.*\.houseNumber')) {
        values['adres'] += " " + data.disclosed[0][1].rawvalue;
        values['postcode'] = data.disclosed[0][2].rawvalue;
        values['plaats'] = data.disclosed[0][3].rawvalue;
    } else {
        values['postcode'] = data.disclosed[0][1].rawvalue;
        values['plaats'] = data.disclosed[0][2].rawvalue;
    }

    for (let item in values) {
        document.getElementById(item).innerText = values[item];
    }

    document.querySelector('.yivi-web-form').remove();
    document.querySelector('.result').removeAttribute('hidden');

    return false;
};

start_session_inline(slug, lang, verifier, (message) => {
    let error = document.createElement('p');
    error.innerText = message;
    document.querySelector('.demo-figure').after(error);
});
