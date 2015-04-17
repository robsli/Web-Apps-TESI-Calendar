	function validatefield(fieldname){
		var field = document.getElementById(fieldname);
		var fieldvalue = field.value;
		var article = fieldname.concat("error");
		var message = "No ".concat(fieldname);
		var tomatch;
		if (fieldname=="email" ){
			tomatch = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
			}
		if (fieldvalue=='' || fieldvalue=="0") {
			writetoelement(article,
						message,
						"firebrick");
			return false;
		}
		message = "Incorrect format of ".concat(fieldname);
		if (fieldname=="email"){
				if (!tomatch.test(fieldvalue)) {
					writetoelement(article,
							message,
							"firebrick");
					return false;
				}
		}
		writetoelement(article,"","firebrick");
		return true;
	}
	
	function validate(){
		var firstnamevalid = validatefield("firstname");
		var lastnamevalid = validatefield("lastname");
		var emailvalid = validatefield("email");
		var passwordvalid = validatefield("password");
		var schoolvalid = validatefield("school");
		var majorvalid = validatefield("major");
		var classvalid = validatefield("class");

		if (!firstnamevalid || !lastnamevalid || !emailvalid || !passwordvalid ||
			!schoolvalid || !majorvalid || !classvalid){
			return false;
		}
		else{
			return true;
		}
	}

	function writetoelement(elementname, message, color){
		var resultloc=document.getElementById(elementname);
		resultloc.style.color = color;
		resultloc.innerHTML =  message;
    }
