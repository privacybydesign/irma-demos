let verifier = (data) => {
    document.querySelector('.yivi-web-form').remove();
    document.querySelector('.result').removeAttribute('hidden');
    let proof = data.disclosed[0][0].rawvalue;

    if (proof === 'student') {
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        const error = document.querySelector('.error');
        error.removeAttribute('hidden');
        document.getElementById('proof').innerText = proof;

    }


    return false;
};

start_session_inline(slug, lang, verifier, (message) => {
    let error = document.createElement('p');
    error.innerText = message;
    document.querySelector('.demo-figure').after(error);
});
