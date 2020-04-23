$(document).ready(function() {
	$('#password').hide();
	$('#button_submit').hide();
	$('#remember').hide().prop('disabled', true);
	$('#button_submit').prop('disabled', true);
});

$('#username').keyup(function () {
	var page = 'Log';
	feedback(page);
}).focusin(function () {
	var page = 'Log';
	feedback(page);
});

$('#username_reg').keyup(function () {
	var page = 'Reg';
	feedback(page);
}).focusin(function () {
	var page = 'Reg';
	feedback(page);
});

$('#password').keyup(function () {
	var password_val = $('#password').val();
	var username_val = $('#username').val();
	if(password_val != '') {	
		var pass_length = $('#password').val().length;
		if(pass_length < 5 || pass_length > 40) {
			$('#password_feedback').html('min 5 karaktera').css('color', '#ff0000' );
			$('#password').css('background-color', '#F2DEDE');
			$('#button_submit').hide().prop('disabled', true);;
			$('#remember').hide().prop('disabled', true);;
		} else {
			$('#password').css('background-color', '#FCF8E3');
			if($('#hidden').val() == 'true') {
				$('#hidden').attr('type', 'password').attr('class', 'text').attr('placeholder', 'Ponovi unesite lozinku...').attr('maxlength', '40').attr('value', '');
			} else if($('#hidden').val() == 'false'){
				
				$.ajax({
					url: 'ajax_reverse.php',
					type: 'POST',
					data: {password: password_val, username: username_val},
					success: function (data) {
						$('#password_feedback').html(data).css('color', '#ff0000');
					}
				});
				
				$('#button_submit').show('fast').removeAttr('disabled');
				$('#remember').show('fast').removeAttr('disabled');
			}
		}
	} else {
		$('#hidden').attr('type', 'hidden')
		$('#password').css('background-color', 'white');
		$('#button_submit').hide().prop('disabled', true);
		$('#remember').hide().prop('disabled', true);
	}
});

$('#hidden').keyup(function () {
	var retype_pass_val = $('#hidden').val();
	if(retype_pass_val != '') {
		var retype_pass_length = $('#hidden').val().length;
		if(retype_pass_length >=5 && retype_pass_length <= 40 && $('#hidden').val() == $('#password').val()) {
			$('#hidden').css('background-color', '#DFF0D8');
			$('#button_submit').show('fast').removeAttr('disabled');
			$('#remember').show('fast').removeAttr('disabled');
		} else {
			$('#hidden').css('background-color', '#F2DEDE');
			$('#button_submit').hide('fast').prop('disabled', true);;
			$('#remember').hide('fast').prop('disabled', true);;
		}
	} else {
		$('#button_submit').hide();
		$('#remember').hide();
	}
});


function feedback(page) {
	if(page == 'Log') {
		var username_val = $('#username').val();
		var username = $('#username');
	} else if(page == 'Reg') {
		var username_val = $('#username_reg').val();
		var username = $('#username_reg');
	}
	if(username_val != '') {
		var user_length = username_val.length;
		if(user_length < 5 || user_length > 40) {
			username.css('background-color', '#F2DEDE');
			$('#username_feedback').html('min 5 karaktera').css('color', '#ff0000');
		} else {
			$.ajax({
			url: 'ajax_reverse.php',
			type: 'POST',
			data: { username: username_val,  page: page},
			success: function (data) {
				$('#username_feedback').html(data);
			}
			});
			
			username.css('background-color', '#FCF8E3');
			$('#password').show('fast');
		}
	} else {
		$('#password').hide();
		username.css('background-color', 'white');
	}
}