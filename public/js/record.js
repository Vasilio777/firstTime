$(function() {
                                                    // Селект страницы регистрации (Студент/Препод)
    $("select").change(function() {
        if ($("#selectar").val() == "Prepod") {

            $("#twoForm").css({ display: "none"});
            $("#oneForm").slideDown(400);
        }
        else if ($("#selectar").val() == "Student") {
            $("#oneForm").css({ display: "none"});
            $("#twoForm").slideDown(800);
        }
        else {
            $("#oneForm").slideUp(400);
            $("#twoForm").slideUp(400);
        }
    });
})

