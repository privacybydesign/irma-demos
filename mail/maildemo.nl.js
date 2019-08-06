$.getScript("../start_session.js", function () {
    $(function () {
        let successgmail_fun = function (data) {
            let email = data.disclosed[0][0].rawvalue;
            let email_len = email.length;
            let email_tail = email.substr(email_len - 9, email_len);
            if (email_tail === "gmail.com") {
                $("#main").html("<h3>Email controle is geslaagd!</h3><p>U heeft een <tt>gmail.com</tt> adres getoond en kunt daarmee verder, bijvoorbeeld naar <a href=\"https://www.google.com/gmail/\">Gmail</a><b><p><a href=\"#\" onclick=\"window.location.reload(true)\">Terug</a></p>");
            } else {
                $("#main").html("<h3>Email controle is niet geslaagd!</h3><p>U heeft <em>geen</em> <tt>gmail.com</tt> adres, maar wel: &nbsp; <b>"
                    + email + "</p> <br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Terug</a></p>");
            }
        };

        let successemail_fun = function (data) {
            let email = data.disclosed[0][0].rawvalue;
            $("#main").html("<h3>Email opvraag is geslaagd!</h3><p>U heeft het email adres: &nbsp; <b>"
                + email +
                "</b></p> <br><p><a href=\"#\" onclick=\"window.location.reload(true)\">Terug</a></p>");
        };

        let cancelled_fun = function () {
            $("#result_status")
                .html("Email check geannuleerd.")
                .addClass("alert alert-warning")
                .css("font-weight", "bold");
        };

        let error_fun = function (data) {
            $("#result_status")
                .html("Email check mislukt!")
                .addClass("alert alert-danger")
                .css("font-weight", "bold");
        };

        $('#try_irma_gmailbtn').click(function () {
            start_session('gmail', 'nl', successgmail_fun, cancelled_fun, error_fun);
        });

        $('#try_irma_emailbtn').click(function () {
            start_session('email', 'nl', successemail_fun, cancelled_fun, error_fun);
        });
    });
});
