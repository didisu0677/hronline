
function formOpen() {
	var response = response_edit;
		if(typeof response.id != 'undefined') {			
			if(response.is_form == 1) {			
				$('#is_form').val('Input Form').trigger('change') 
			}else{
				$('#is_form').val('Lampiran').trigger('change') 
			}
		}
		is_edit= false;
	}
