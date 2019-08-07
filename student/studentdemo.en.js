$.getScript("../start_session.js", function() {
    let successstudent_fun = function (data) {
        let result = data.disclosed[0][0].rawvalue;
        if (result === "student") {
            $("#main").html('<h3>Student verification succeeded!</h3><p>For special offers, in Dutch, go to: <a href="https://www.studentenwegwijzer.nl/studentenkorting/">(web)winkels</a></p> <br> <p><a href="#" onclick="window.location.reload(true)">Back</a></p>');
        } else {
            $("#main").html('<h3>Student verification failed!</h3><br> <p><a href="#" onclick="window.location.reload(true)">Back</a></p>');
        }
    };


    let successschool_fun = function (data) {
        let role = data.disclosed[0][0].rawvalue;
        let school = data.disclosed[0][1].rawvalue;
        $("#main").html('<h3>Attribute verification succeeded!</h3><p>You are <b>'
            + role +
            "</b> at the institution with abbreviation: <b>"
            + school +
            "</b></p> <br>" +
            "<p><a href=\"#\" onclick=\"window.location.reload(true)\">Back</a></p>");
    };

    var cancel_fun = function (data) {
        $("#result_status")
            .html("student verification cancelled.")
            .addClass("alert alert-warning")
            .css("font-weight", "bold");
    };

    var error_fun = function (data) {
        $("#result_status")
            .html("student verification failed!")
            .addClass("alert alert-danger")
            .css("font-weight", "bold");
    };

    $('#try_irma_studentbtn').click(function () {
        start_session('student', 'en', successstudent_fun, cancel_fun, error_fun);
    });

    $('#try_irma_studentschoolbtn').click(function () {
        start_session('school', 'en', successschool_fun, cancel_fun, error_fun);
    });
});
