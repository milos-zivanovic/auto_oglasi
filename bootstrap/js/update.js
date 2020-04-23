$(document).ready(function () {
	$('#button_submit').prop('disabled', true);
});

$('#button_submit').click(function () {
	var username = $('#username').val();
	var password = $('#password').val();
	var repeat_password = $('#retype_password').val();
	
	$('#update_status').text("Učitavanje...");
	
	if(username == "" || password == "" || repeat_password == "") {
		$('#update_status').html("Molimo popunite sva polja.").css("color", "#ff0000");
	} else {
		$.ajax({
			url: 'update_reverse.php',
			type: 'POST',
			data: {
				username: username,
				password: password, 
				repeat_password: repeat_password
			},
			success: function (data) {
				$('#update_status').text(data).css("color", "#ff0000");
				$('#password').text("");
				$('#retype_password').text("");
				alert('Prilokom sledećeg logovanja, koristite unete podatke.');
			}
		});
	}
});

$('#username').focusin(function () {
	check_length ($('#username'), $('#username_feedback'), true);
	$('#username').keyup(function () {
		check_length ($('#username'), $('#username_feedback'), true);
	});
}).blur(function () {
	$('#username_feedback').text("");
});

$('#password').focusin(function () {
	check_length ($('#password'), $('#password_feedback'), false);
	$('#password').keyup(function () {
		check_length ($('#password'), $('#password_feedback'), false);
	});
}).blur(function () {
	$('#password_feedback').text("");
});

$('#retype_password').focusin(function () {
	check_length ($('#retype_password'), $('#retype_password_feedback'), false);
	$('#retype_password').keyup(function () {
		check_length ($('#retype_password'), $('#retype_password_feedback'), false);
	});
}).blur(function () {
	$('#retype_password_feedback').text("");
});


function check_length (field, span, no_username) {
	if(field.val().length < 5) {
		span.text("min 5 karaktera").css("color", "#ff0000");
	} else {
		if(no_username == false) {
			pass_match($('#password'), $('#retype_password'), span);
		}else if(no_username == true) { 
			var username = $('#username').val();
			$.ajax({
				url: 'username_free.php',
				type: 'POST',
				data: {username: username},
				success: function (data) {
					$('#username_feedback').text(data).css('color', '#ff0000');
				}
			});
		} else {
			span.text("");
		}
	}
	
	if($('#username').val().length >=5 && $('#password').val().length >=5 && $('#retype_password').val().length >=5 &&
			$('#password').val() == $('#retype_password').val()) {
		$('#button_submit').removeAttr('disabled');
	} else {
		$('#button_submit').prop('disabled', true);
	}
}

function pass_match(password, repeat_password, span) {
	if (password.val().length != repeat_password.val().length  &&  password.val() != repeat_password.val()) {
		span.text('Lozinke se ne poklapaju.');
	} else {
		span.text('');
	}
}

