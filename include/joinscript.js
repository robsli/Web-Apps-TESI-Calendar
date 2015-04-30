	var errorArray = [];
	var invalidArray =[];

	String.prototype.capitalize = function() {
    	return this.charAt(0).toUpperCase() + this.slice(1);
	}

	function validatefield(fieldname){
		var field = document.getElementById(fieldname);
		var fieldvalue = field.value;
		var tomatch;
		if (fieldname=="email"){
			tomatch = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
			if (fieldvalue=='') {
				errorArray.push(fieldname);
			}
			if (!tomatch.test(fieldvalue)) {
				invalidArray.push(fieldname);
				return false;
			}
		}
		if (fieldvalue=='' || fieldvalue=="0") {
			errorArray.push(fieldname);
			return false;
		}
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
		
		var samePasswordValid = (document.getElementById("password").value) == (document.getElementById("confirmpassword").value)
		
		if (!firstnamevalid || !lastnamevalid || !emailvalid || !passwordvalid ||
			!schoolvalid || !majorvalid || !classvalid){
			var errormessage = "";
			var invaliderrormessage = "";
			for (var i = 0; i < errorArray.length; i++){
				if (i==0){
					if (i==errorArray.length-1){
						errormessage += errorArray[i].capitalize() + " was not filled out.";
						break;
					}
					else{
						errormessage += errorArray[i].capitalize() + ", ";
					}
				}
				else if (i==errorArray.length-1){
					errormessage += "and " + errorArray[i] + " were not filled out.";
				}
				else{
					errormessage += errorArray[i] + ", ";
				}
			}
			for (var i = 0; i < invalidArray.length; i++){
				if (i==0){
					if (i==invalidArray.length-1){
						invaliderrormessage += invalidArray[i].capitalize() + " was filled incorrectly.";
						break;
					}
					else{
						invaliderrormessage += invalidArray[i].capitalize() + ", ";
					}
				}
				else if (i==invalidArray.length-1){
					invaliderrormessage += "and " + invalidArray[i] + " were filled incorrectly.";
				}
				else{
					invaliderrormessage += invalidArray[i] + ", ";
				}
			}
			errorArray = [];
			invalidArray =[];
			if (errormessage!="")
				writetoelement("errormessage", errormessage,"firebrick");
			else
				writetoelement("errormessage", "","firebrick");
			
			if (invaliderrormessage!="")
				writetoelement("invaliderrormessage", invaliderrormessage,"firebrick")
			else
				writetoelement("invaliderrormessage", "","firebrick");
			
			return false;
		}
		else{
			if(!samePasswordValid){
				writetoelement("errormessage", "Passwords do not match!","firebrick");
				return false;
			}
			return true;
		}
	}

	function writetoelement(elementname, message, color){
		var resultloc=document.getElementById(elementname);
		resultloc.style.color = color;
		resultloc.innerHTML =  message;
    }