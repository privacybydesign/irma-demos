function start_session(type, lang, success_fun, cancelled_fun, error_fun) {
    console.log("Button clicked");
    yivi.newPopup({
        language: lang,
        session: {
            url: '..',
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
