let result_status = $('#result_status');

let success_issuance_fun = function (data) {
    let name = data.disclosed[0][0].rawvalue;
    $("#main")
        .empty()
        .append(MESSAGES['succeeded-issuance'](name))
        .append('<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">' + MESSAGES['back'] + '</a></p>');
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
    $("#main")
        .empty()
        .append(MESSAGES['succeeded-disclosure'](name))
        .append('<br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>');
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
    let button = $('<button>')
        .addClass('custom-button')
        .text(MESSAGES['become-member-button'])
        .click(start_premium_issuance);
    result_status
        .empty()
        .append(document.createTextNode(intro))
        .append('<br>')
        .append(document.createTextNode(MESSAGES['no-membership-message']))
        .append($('<p>').append(button))
        .removeClass()
        .addClass('alert ' + (alertClass || 'alert-warning'));
};

let cancelled_issuance_fun = function() {
    result_status
        .html(MESSAGES['cancel-issuance-message'])
        .addClass("alert alert-warning");
};

let error_issuance_fun = function () {
    result_status
        .html(MESSAGES['error-issuance-message'])
        .addClass('alert alert-danger');
};

let cancelled_disclosure_fun = function() {
    show_membership_guidance(MESSAGES['cancel-disclosure-message'], 'alert-warning');
};

let error_disclosure_fun = function () {
    show_membership_guidance(MESSAGES['error-disclosure-message'], 'alert-danger');
};

$('#irmatube_premium').click(start_premium_issuance);

$('#watch_premium_contents').click(function () {
    start_session('watch_premium_contents', MESSAGES['lang'], success_disclosure_fun, cancelled_disclosure_fun, error_disclosure_fun);
});
