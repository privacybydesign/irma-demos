let verifier = (data) => {
    let [fullname, iban, bic] = data.disclosed[0].map(attribute => attribute.rawvalue);

    document.getElementById('iban-fullname').value = fullname;
    document.getElementById('iban-number').value = iban;
    document.getElementById('iban-bic').value = bic;

    document.querySelector('.yivi-web-form').remove();
    document.querySelector('.iban-confirmation').removeAttribute('hidden');

    // The filled-in form is the result; there is nothing to add below the demo.
    return false;
};

start_session_inline(slug, lang, verifier);
