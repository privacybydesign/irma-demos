let messages = {
    'welcome': {
        'en': (name) => [`Hey ${name}, you're a real VIP now`,
            'Your membership card is in your Yivi app, with your own name on it — and you only confirmed once. Use it to watch the premium contents on '],
        'nl': (name) => [`Hey ${name}, je bent nu een echte VIP`,
            'Je lidmaatschapskaartje staat in je Yivi-app, met je eigen naam erop — en je hebt maar één keer bevestigd. Gebruik het om de premium inhoud te bekijken op '],
    },
};

let verifier = (data) => {
    let [heading, body] = messages['welcome'][lang](data.disclosed[0][0].rawvalue);

    let title = document.createElement('h3');
    title.textContent = heading;
    let text = document.createElement('p');
    text.append(body, inline_link('https://yivitube.yivi.app', 'YiviTube'), '.');

    let panel = document.querySelector('.tube-result');
    panel.replaceChildren(title, text);
    panel.hidden = false;
    document.querySelector('.yivi-form').hidden = true;

    // The membership page is the result; there is nothing to add below the demo.
    return false;
};

start_session_inline(session_type, lang, verifier);
