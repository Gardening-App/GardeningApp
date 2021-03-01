$(function() {

    $('#submit').click(function() {
		
        if ($('#username').val() == "") {
            alert("Please enter a username");
            return False;
        } else if ($('#password').val() != $('#passwordConfirm').val()) {
            alert("Please make sure your passwords match");
            return False;
        }
	});

});