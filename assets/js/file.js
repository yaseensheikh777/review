$(document).ready(function(){
	$('#error-message-div').hide();
	$('#login').on('click',function(){
		login();
	});

	$('.input-register').on('keypress',function(e){
		if(e.which==13) {
			e.preventDefault();
			login();
		}
	});

	$('#error-hide').on('click',function(e){
		e.preventDefault();
		$(this).parent().hide();
	});

	function login() {
		$('#error-message-div').hide();
		uname=$('#name').val();
		up=$('#pw').val();
		if(uname==''||up=='') {
			$('#error-message').text("Username or Password can't be empty");
			$('#error-message-div').show();
			return;
		}
		$.ajax({
			type: "POST",
			URL : document.url,
			data : {
				em:uname,
				pw :up
			},
			success : function(response) {
					var res=$.parseJSON(response);
					if(res.type==0) {
						$('#error-message').text(res.message);
						$('#error-message-div').show();
					}
					else {
						location.href=res.message;
					}
			}
		});
	}
});