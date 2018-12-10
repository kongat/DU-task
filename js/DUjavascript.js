$('#form1').submit(function (e) {
	
		e.preventDefault();
		
		var name = document.forms["myForm"]["fullName"].value;
		var email = document.forms["myForm"]["userEmail"].value;
		var password1 = document.forms["myForm"]["password1"].value;
		var password2 = document.forms["myForm"]["password2"].value;
		
		if (name == ""){
			$("#name-error").text("Συμπληρώστε το όνομα σας.");
			return false;
		}else if (email == ""){
			$("#email-error").text("Συμπληρώστε το Email σας.");
			return false;
		}else if (password1 == ""){
			
			$("#password1-error").text("Συμπληρώστε το κωδικο σας.");
			return false; 
		}else if (password2 == ""){
		
			$("#password2-error").text("Συμπληρώστε ξανά τον κωδικό σας.");
			return false; 
		}else if (password2 != password1){
		
			$("#password2-error").text("Οι κωδικοί δεν συμπίπτουν.");
			return false; 	
		}
		
		var self = this;
		
		$.ajax({
			type: 'post',
			url: 'register-handle.php',
			async: false,
			data: $('form').serialize(),	
			success: function (data) {
              
				if (data ==='true'){
					$("#email-error").text("Υπάρχει ήδη καταχωτημένο το συγκεκριμένο email.");
				}else{
					self.submit();
				}
            }
		})
				
		
				
});
		
		
        


$('#fullName').focus(function() {
	 $('#name-error').text("");
	
});
$('#userEmail').focus(function() {
	 $('#email-error').text("");
	
});
$('#password1').focus(function() {
	 $('#password1-error').text("");
	
});
$('#password2').focus(function() {
	 $('#password2-error').text("");
	
});
