let verifier = (data) => {
    let i = 0;
    let adres = data.disclosed[0][i++].rawvalue;
    if (data.disclosed[0][i].id.match('.*\.houseNumber')) {
        adres += " " + data.disclosed[0][i++].rawvalue;
    }
    let postcode = data.disclosed[0][i++].rawvalue;
    let plaats = data.disclosed[0][i].rawvalue;

    document.querySelector('.yivi-web-form').remove();
    document.querySelector('.address-usage').removeAttribute('hidden');
    let address_block = document.createElement('p');
    address_block.innerHTML = `${adres}<br>${postcode} ${plaats}`;
    document.querySelector('.address-usage').append(address_block);

    return false;
};

start_session_inline(slug, lang, verifier);
