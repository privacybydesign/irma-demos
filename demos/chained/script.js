let result_status = document.getElementById('result_status');

// The message builders return DOM nodes so that disclosed values are never
// parsed as HTML; compose the result with the DOM instead of innerHTML.
let show_final_result = function (contentNode) {
    let back = document.createElement('p');
    let link = document.createElement('a');
    link.href = '#';
    link.textContent = MESSAGES['back'];
    link.addEventListener('click', function (event) {
        event.preventDefault();
        window.location.reload();
    });
    back.append(link);
    document.querySelector('main section').replaceChildren(contentNode, back);
};

let success_issuance_fun = function (data) {
    let name = data.disclosed[0][0].rawvalue;
    show_final_result(MESSAGES['succeeded-issuance'](name));
};

let success_disclosure_fun = function (data) {
    // The disclosure request requires a premium membership, so a fullname is
    // always present. Guard anyway so we never greet "Hey Null" if the
    // attribute is missing or empty (see issue #32).
    let name = data.disclosed[0][0].rawvalue;
    if (!name) {
        error_disclosure_fun();
        return;
    }
    show_final_result(MESSAGES['succeeded-disclosure'](name));
};

let start_premium_issuance = function () {
    start_session('irmatube_premium', MESSAGES['lang'], success_issuance_fun, cancelled_issuance_fun, error_issuance_fun);
};

// The "Show premium contents" disclosure requires a YiviTube premium
// membership. When the user does not have that credential the Yivi app has
// nothing to disclose and the session ends as Cancelled/Aborted, leaving
// the user with only a bare "check cancelled" message and no way forward
// (see issue #23). Instead of leaving them stranded, guide them into this
// demo's own issuance flow so they can obtain the membership right here.
let show_membership_guidance = function (intro, alertClass) {
    let button = "<button class='custom-button'>" + MESSAGES['become-member-button'] + "</button>";
    result_status.innerHTML = intro + "<br>" + MESSAGES['no-membership-message'] + "<p>" + button + "</p>";
    result_status.className = 'alert ' + (alertClass || 'alert-warning');
    result_status.querySelector('button').addEventListener('click', start_premium_issuance);
};

let cancelled_issuance_fun = function() {
    result_status.innerHTML = MESSAGES['cancel-message'];
    result_status.classList.add('alert', 'alert-warning');
};

let error_issuance_fun = function() {
    result_status.innerHTML = MESSAGES['error-message'];
    result_status.classList.add('alert', 'alert-danger');
};

let cancelled_disclosure_fun = function() {
    show_membership_guidance(MESSAGES['cancel-disclosure-message'], 'alert-warning');
};

let error_disclosure_fun = function () {
    show_membership_guidance(MESSAGES['error-disclosure-message'], 'alert-danger');
};

document.getElementById('irmatube_premium').addEventListener('click', start_premium_issuance);

document.getElementById('watch_premium_contents').addEventListener('click', function () {
    start_session('watch_premium_contents', MESSAGES['lang'], success_disclosure_fun, cancelled_disclosure_fun, error_disclosure_fun);
});
