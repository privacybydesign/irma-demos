let verifier = (data) => {
    let i = 0;
    let adres = data.disclosed[0][i++].rawvalue;
    if (data.disclosed[0][i].id.match('.*\.houseNumber')) {
        adres += " " + data.disclosed[0][i++].rawvalue;
    }
    let postcode = data.disclosed[0][i++].rawvalue;
    let plaats = data.disclosed[0][i].rawvalue;

    return `<ul>
        <li>${adres}</li>
        <li>${postcode}</li>
        <li>${plaats}</li>
    </ul>`;
};

start_session_inline(slug, lang, verifier);
