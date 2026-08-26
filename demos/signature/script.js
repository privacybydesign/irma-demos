let verifier = (data) => {
    document.querySelector('.yivi-web-form').remove();
    document.querySelector('.result').removeAttribute('hidden');

    const values = {
        'a': data.disclosed[0][0].rawvalue,
        'b': data.disclosed[0][1].rawvalue,
        'c': data.disclosed[0][2].rawvalue,
        'd': data.disclosed[0][3].rawvalue,
        'signature': data.signature.message
    }

    for (let item in values) {
        document.getElementById(item).innerText = values[item];
    }

    return false;
};

start_session_inline(slug, lang, verifier, (message) => {
    let error = document.createElement('p');
    error.innerText = message;
    document.querySelector('.demo-figure').after(error);
});

