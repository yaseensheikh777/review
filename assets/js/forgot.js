$(document).ready(function(){
	$('#error-message-div').hide();
	$('#send_email').on('click',function(){
		var email=$('#email').val();
		if(email=='') {
			if($('#error-message-div').hasClass('alert-success')) {
				$('#error-message-div').removeClass('alert-success');
				$('#error-message-div').addClass('alert-danger');
			}
			$('#error-message').text('Please enter your email');
			$('#error-message-div').show();
			return;
		}
		$.ajax({
			type:'POST',
			url: document.URL,
			data : {
				em:email
			},
			success: function(response){
				var res=$.parseJSON(response);
				if(res.type==0) {
					if($('#error-message-div').hasClass('alert-success')) {
						$('#error-message-div').removeClass('alert-success');
						$('#error-message-div').addClass('alert-danger');
					}
				}
				else {
					if($('#error-message-div').hasClass('alert-danger')) {
						$('#error-message-div').removeClass('alert-danger');
						$('#error-message-div').addClass('alert-success');
					}
				}
				$('#error-message').text(res.message);
				$('#error-message-div').show();
			}
		});
	});

	$('#change_password').on('click',function(){
		var pw1=$('#pw1').val();
		var pw2=$('#pw2').val();
		if(pw1==''||pw2==''||pw1!=pw2) {
			if($('#error-message-div').hasClass('alert-success')) {
				$('#error-message-div').removeClass('alert-success');
				$('#error-message-div').addClass('alert-danger');
			}
			if(pw1==''||pw2=='') {
				$('#error-message').text('Enter password');
			}
			else
				$('#error-message').text('The password does not match');
			$('#error-message-div').show();
			return;
		}
		$.ajax({
			type:'POST',
			url: document.URL,
			data : {
				pw1:pw1
			},
			success: function(response){
				var res=$.parseJSON(response);
				if(res.type==0) {
					if($('#error-message-div').hasClass('alert-success')) {
						$('#error-message-div').removeClass('alert-success');
						$('#error-message-div').addClass('alert-danger');
					}
				}
				else {
					if($('#error-message-div').hasClass('alert-danger')) {
						$('#error-message-div').removeClass('alert-danger');
						$('#error-message-div').addClass('alert-success');
					}
				}
				$('#error-message').html(res.message);
				$('#error-message-div').show();
			}
		});
	});

	$('#error-hide').on('click',function(e){
		e.preventDefault();
		$(this).parent().hide();
	});
});