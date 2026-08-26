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

function start_session_inline(type, lang, verifier, errorHandler = null) {

    let showResult = (state, message) => {
        if (message) {
            if (errorHandler !== null) {
                errorHandler(message);
            } else {
                let error = document.createElement('p');
                error.innerText = message;
                document.querySelector('.demo-figure').after(error);
            }
        }
    }

    yivi.newWeb({
        language: lang,
        element: '#yivi-web-form',
        translations: {
            header: header_text,
        },
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
