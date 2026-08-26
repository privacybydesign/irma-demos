let verifier = (data) => {
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

start_session_inline(slug, lang, verifier);
