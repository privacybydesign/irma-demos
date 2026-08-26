let verifier = (data) => {

    document.getElementById('email').innerText = data.disclosed[0][0].rawvalue;

    return false;
};

start_session_inline(slug, lang, verifier);
