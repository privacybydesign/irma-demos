$.getScript('/start_session.js', function() {
    function doVerificationSession() {
        const e = document.getElementById('result');
        e.classList.forEach((label) => {
            if (label.includes('-'))
                e.classList.remove(label)
        });
        start_session('beingalive', MESSAGES['lang'], onSuccess, showError, showError);
    }

    function onSuccess(result) {
        const limit = 14;
        const now = new Date();
        const microSecondsDiff = Math.floor(now.getTime() - 1000 * result.disclosed[0][0].issuancetime);
        // Number of milliseconds per day =
        // 24 hrs/day * 60 minutes/hour * 60 seconds/minute * 1000 msecs/second
        const daysDiff = Math.floor(microSecondsDiff / (1000 * 60 * 60 * 24));
        console.log("Day difference " + daysDiff);
        console.log(result.disclosed);
        if (daysDiff <= limit) {
            showSuccess(MESSAGES['success'](result.disclosed[0][0].rawvalue, result.disclosed[0][1].rawvalue, result.disclosed[0][2].rawvalue));
        } else {
            console.log("Failure");
            showError(MESSAGES['data-too-old'](limit, daysDiff));
        }
    }

    function showError(err) {
        const e = document.getElementById('result');
        e.removeAttribute('hidden');
        e.classList.forEach((label) => {
            if (label.includes('-'))
                e.classList.remove(label)
        });

        if (err === 'CANCELLED') {
            e.classList.add('alert-warning');
            e.innerText = MESSAGES['cancelled'];
        } else {
            e.classList.add('alert-danger');
            e.innerText = String(err);
        }
        throw err;
    }

    function showSuccess(text) {
        const e = document.getElementById('result');
        e.innerHTML = text;
        e.removeAttribute('hidden');
        e.classList.add('alert-success');
    }

    document.getElementById('verification').addEventListener('click', doVerificationSession);
});
