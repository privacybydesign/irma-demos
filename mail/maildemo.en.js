$.getScript("../start_session.js", function() {
    $(function () {
        let successgmail_fun = function (data) {
            let email = data.disclosed[0][0].rawvalue;
            let email_len = email.length;
            let email_tail = email.substr(email_len - 9, email_len);
            if (email_tail === "gmail.com") {
                $("#main").html("<h3>Email verification succeeded!</h3><p>You have revealed a <tt>gmail.com</tt> address, which allows you to proceed, for instance to <a href=\"https://www.google.com/gmail/\">Gmail</a><b><p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>");
            } else {
                $("#main").html("<h3>Email verification failed!</h3><p>You do <em>not</em> have a <tt>gmail.com</tt> address, but: &nbsp; <b>"
                    + email + "</p> <br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>");
            }
        };

        let successemail_fun = function (data) {
            let email = data.disclosed[0][0].rawvalue;
            $("#main").html("<h3>Email disclosure succeeded!</h3><p>You have revealed e-mail address: &nbsp; <b>"
                + email +
                "</b></p> <br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>");
        };

        let cancelled_fun = function() {
            $("#result_status")
                .html("Email verification cancelled.")
                .addClass("alert alert-warning")
                .css("font-weight", "bold");
        }

        let error_fun = function (data) {
            $("#result_status")
                .html("Email verification failed!")
                .addClass("alert alert-danger")
                .css("font-weight", "bold");
        };

        $('#try_irma_gmailbtn').click(function () {
            start_session('gmail', 'en', successgmail_fun, cancelled_fun, error_fun);
        });

        $('#try_irma_emailbtn').click(function () {
            start_session('email', 'en', successemail_fun, cancelled_fun, error_fun);
        });
    });
});
