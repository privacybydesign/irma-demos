function start_session(type, lang, success_fun, cancelled_fun, error_fun) {
    console.log("Button clicked");
    yivi.newPopup({
        language: lang,
        session: {
            start: {
                url: o => `${o.url}/start_session.php?type=${type}&lang=${lang}`
            },
            result: {
                url: (o, {sessionPtr, sessionToken}) => `${sessionPtr.u.split('/irma')[0]}/session/${sessionToken}/result`
            }
        }
    })
        .start()
        .then(success_fun)
        .catch(function (msg) {
            if (msg === 'Cancelled' || msg === 'Aborted') {
                cancelled_fun(msg);
            } else {
                error_fun(msg);
            }
        });
}


const INLINE_SESSION_MESSAGES = {
    cancelled: {
        en: 'You cancelled the action. You can try again!',
        nl: 'Je hebt de actie geannuleerd. Je kunt het opnieuw proberen!',
    },
    error: {
        en: 'Something went wrong, please try again later.',
        nl: 'Er is iets misgegaan, probeer het later opnieuw.',
    },
};

function inline_session_message(key, lang) {
    return INLINE_SESSION_MESSAGES[key][lang] || INLINE_SESSION_MESSAGES[key].en;
}

// Appends a result block below the demo. `message` may be a string of markup or
// a DOM node; demos that compose disclosed values must pass a node, so a value
// from a credential is never parsed as HTML.
function render_inline_result(state, message) {
    let div = document.createElement('div');
    if (message instanceof Node) {
        div.append(message);
    } else {
        div.innerHTML = message;
    }
    div.classList.add(state, 'yivi-result');
    document.querySelector('.demo-container').append(div);
    return div;
}

function clear_inline_results() {
    document.querySelectorAll('.demo-container .yivi-result').forEach(node => node.remove());
}

// Builds the body of a result block: a heading and a paragraph. Values that came
// out of a credential belong in here as text or as a node from
// inline_attribute(), so they are never parsed as HTML.
function inline_result(heading, ...content) {
    let fragment = document.createDocumentFragment();
    let title = document.createElement('h3');
    title.textContent = heading;
    let body = document.createElement('p');
    body.append(...content);
    fragment.append(title, body);
    return fragment;
}

function inline_attribute(value) {
    let attribute = document.createElement('em');
    attribute.className = 'attribute';
    attribute.textContent = value;
    return attribute;
}

function inline_link(url, text) {
    let link = document.createElement('a');
    link.href = url;
    link.target = '_blank';
    link.textContent = text;
    return link;
}

// A page can only show one inline session at a time: on a demo with several
// actions, starting a second one replaces the first. Abort the one being
// replaced and stamp every session with a generation, so a session that is
// still settling can no longer write its result over the current one.
let inline_session_generation = 0;
let inline_session_handler = null;

function start_session_inline(type, lang, verifier, errorHandler = null, options = {}) {
    let generation = ++inline_session_generation;

    if (inline_session_handler !== null) {
        try {
            inline_session_handler.abort();
        } catch (error) {
            console.error(error.message);
        }
    }

    let showResult = (state, message) => {
        if (generation !== inline_session_generation) return;
        if (message) {
            if (errorHandler !== null) {
                errorHandler(message, state);
            } else {
                render_inline_result(state, message);
            }
        }
    }

    inline_session_handler = yivi.newWeb({
        language: lang,
        element: options.element || '#yivi-web-form',
        translations: {
            header: options.header || header_text,
        },
        session: {
            start: {
                url: o => `${o.url}/start_session.php?type=${type}&lang=${lang}`
            },
            result: {
                url: (o, {sessionPtr, sessionToken}) => `${sessionPtr.u.split('/irma')[0]}/session/${sessionToken}/result`
            }
        }
    });

    inline_session_handler
        .start()
        .then((data) => {
            showResult('result', verifier(data));
        })
        .catch((data) => {
            if (data === 'Cancelled' || data === 'Aborted') {
                showResult('ok', inline_session_message('cancelled', lang))
            } else {
                showResult('error', inline_session_message('error', lang));
            }
        });
}

// Wires the buttons that `demo-page.php` renders for a demo with several
// actions. `handlers` maps a session type to its verifier, or to an object
// with a `verifier` and an `onError` that overrides how a result is rendered.
function start_session_choice(handlers) {
    let buttons = Array.from(document.querySelectorAll('.demo-actions [data-session]'));

    let start = (button) => {
        let type = button.dataset.session;
        let handler = handlers[type];
        if (!handler) return;
        if (typeof handler === 'function') handler = {verifier: handler};

        buttons.forEach(other => other.setAttribute('aria-pressed', String(other === button)));
        clear_inline_results();

        start_session_inline(type, lang, handler.verifier, handler.onError || null, {
            header: demo_actions[type],
        });
    };

    buttons.forEach(button => button.addEventListener('click', () => start(button)));

    return {
        start: (type) => {
            let button = buttons.find(candidate => candidate.dataset.session === type);
            if (button) start(button);
        },
    };
}
