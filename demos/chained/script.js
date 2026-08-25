let verifier = (data) => {
    document.querySelector('.yivi-web-form').remove();
    document.querySelector('.result').removeAttribute('hidden');

    return false;
};

start_session_inline(slug, lang, verifier, (message) => {
    let error = document.createElement('p');
    error.innerText = message;
    document.querySelector('.demo-figure').after(error);
});
