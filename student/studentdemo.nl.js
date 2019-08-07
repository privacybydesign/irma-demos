$.getScript("../start_session.js", function() {
    var successstudent_fun = function(data) {
	    if (data.disclosed[0][0].rawvalue === "student") {
		$("#main").html('<h3>Student controle geslaagd!</h3><p>Voor aanbiedingen, ga naar: <a href="https://www.studentenwegwijzer.nl/studentenkorting/">(web)winkels</a></p> <br> <p><a href="#" onclick="window.location.reload(true)">Terug</a></p>');
	    }
	    else {
		$("#main").html('<h3>Student controle niet geslaagd!</h3><br> <p><a href="#" onclick="window.location.reload(true)">Terug</a></p>');
	    }
    };


    let successschool_fun = function(data) {
        let role = data.disclosed[0][0].rawvalue;
        let school = data.disclosed[0][1].rawvalue;
        $("#main").html('<h3>Attribuut controle is geslaagd!</h3><p>U bent <b>'
                + role  +
                "</b> aan de instelling met afkorting <b>"
                + school +
                "</b></p> <br>" +
                "<p><a href=\"#\" onclick=\"window.location.reload(true)\">Terug</a></p>");
    };

    let cancel_fun = function(data) {
        $("#result_status")
            .html("student check geannulleerd.")
            .addClass("alert alert-warning")
            .css("font-weight", "bold");
    };

    let error_fun = function(data) {
        $("#result_status")
            .html("student check mislukt!")
            .addClass("alert alert-danger")
            .css("font-weight", "bold");
    };

    $('#try_irma_studentbtn').click(function () {
        start_session('student', 'nl', successstudent_fun, cancel_fun, error_fun);
    });

    $('#try_irma_studentschoolbtn').click(function () {
        start_session('school', 'nl', successschool_fun, cancel_fun, error_fun);
    });
});
