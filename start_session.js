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


function start_session_inline(type, lang, verifier) {

    let showResult = (state, message) => {
        if (message) {
            let div = document.createElement('div');
            div.innerHTML = message;
            div.classList.add(state, 'yivi-result');
            document.querySelector('.demo-container').append(div)
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
                showResult('ok', 'You cancelled the action. You can try again!')
            } else {
                showResult('error', 'Something went wrong, please try again later.');
            }
        });
}
