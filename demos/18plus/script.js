let verifier = (data) => {

    let proof = data.disclosed[0][0].rawvalue.toLowerCase();
    if(proof === 'yes' || proof === 'ja') {
        document.querySelector('.success').removeAttribute('hidden');
    } else {
        const error = document.querySelector('.error');
        error.removeAttribute('hidden');

    }

    return false;
};

start_session_inline(slug, lang, verifier);
