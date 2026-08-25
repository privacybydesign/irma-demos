let verifier = (data) => {
    let i = 0;
    let adres = data.disclosed[0][i++].rawvalue;
    if (data.disclosed[0][i].id.match('.*\.houseNumber')) {
        adres += " " + data.disclosed[0][i++].rawvalue;
    }
    let postcode = data.disclosed[0][i++].rawvalue;
    let plaats = data.disclosed[0][i].rawvalue;

    document.querySelector('.yivi-web-form').remove();
    let address_block = document.createElement('p');
    address_block.append(adres, document.createElement('br'), `${postcode} ${plaats}`);
    document.querySelector('.address-usage').append(address_block);

    return false;
};

start_session_inline(slug, lang, verifier, (message) => {
    let error = document.createElement('p');
    error.innerText = message;
    document.querySelector('.demo-figure').after(error);
});
