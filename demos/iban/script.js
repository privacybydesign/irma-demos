let verifier = (data) => {
    const values = {
        'fullName': data.disclosed[0][0].rawvalue,
        'iban': data.disclosed[0][1].rawvalue,
        'bic': data.disclosed[0][2].rawvalue,
    }

    for (let item in values) {
        document.getElementById(item).innerText = values[item];
    }

    return false;
};

start_session_inline(slug, lang, verifier);
