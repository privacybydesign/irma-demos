let verifier = (data) => {
    let issuanceTime = data.disclosed[0][0].issuancetime;
    const values = {
        'initials': data.disclosed[0][0].rawvalue,
        'familyName': data.disclosed[0][1].rawvalue,
        'dateOfBirth': data.disclosed[0][2].rawvalue,
    }

    const limit = 14;
    const now = new Date();
    console.log(issuanceTime);
    const dataAge = Math.floor((now.getTime() - 1000 * issuanceTime) / (1000 * 60 * 60 * 24));

    document.querySelector('.yivi-web-form').remove();
    document.querySelector('.result').removeAttribute('hidden');

    document.getElementById('dataAge').innerText = dataAge;

    if (dataAge < limit) {
        const success = document.querySelector('.success');
        success.removeAttribute('hidden');
        for (let item in values) {
            document.getElementById(item).innerText = values[item];
        }

    } else {
        const error = document.querySelector('.error');
        error.removeAttribute('hidden');
        document.getElementById('limit').innerText = limit;

    }

    return false;
};

start_session_inline(slug, lang, verifier, (message) => {
    let error = document.createElement('p');
    error.innerText = message;
    document.querySelector('.demo-figure').after(error);
});
