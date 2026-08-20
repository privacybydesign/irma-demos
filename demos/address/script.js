let verifier = (data) => {
    let i = 0;
    let adres = data.disclosed[0][i++].rawvalue;
    if (data.disclosed[0][i].id.match('.*\.houseNumber')) {
        adres += " " + data.disclosed[0][i++].rawvalue;
    }
    let postcode = data.disclosed[0][i++].rawvalue;
    let plaats = data.disclosed[0][i].rawvalue;

    let usage = document.querySelector('.address-usage');
    usage.hidden = false;
    let address_block = document.createElement('p');
    address_block.append(adres, document.createElement('br'), `${postcode} ${plaats}`);
    usage.append(address_block);

    document.querySelector('.yivi-form').hidden = true;

    // The filled-in page is the result; there is nothing to add below the demo.
    return false;
};

start_session_inline(session_type, lang, verifier);
