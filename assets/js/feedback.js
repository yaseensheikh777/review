$(document).ready(function(){
	var rate=0;
	$('#error-message-div').hide();
	$('#error-hide').on('click',function(e){
		e.preventDefault();
		$(this).parent().hide();
	});
	$('.radio').on('click',function() {
		id=$(this).attr('id');
		id=id.split('star');
		rate=id[1];
	});

	$('#feedback').on('click',function() {
		$('#error-message-div').hide();
		comment=$('#comment').val();
		title=$('#title').val();
		if(title==''||rate==0) {
			if(title=='') {
				$('#error-message').text("Please write title to submit");	
			}
			else {
				$('#error-message').text("Please rate to submit");
			}
			$('#error-message-div').show();
			return;
		}
		$.ajax({
			type: "POST",
			URL : document.url,
			data : {
				rate:rate,
				comment :comment,
				title : title
			},
			success : function(response) {
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
});