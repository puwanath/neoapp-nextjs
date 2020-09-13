$(function() {
	
	//auto open 
	if ($ .cookie("popup_register") == null) {
        $('.popup').fadeIn(350);
		$('#form-register')[0].reset();
		$('#txt_firstname').focus();
		
	$ .cookie("popup_register", "2");
	}
	
	
	// button register
	$('.nav-register').on('click',function(e){
		$('.popup').fadeIn(350);
		$('#form-register')[0].reset();
		$('#txt_firstname').focus();
		
		e.preventDefault();
	})
	
	//----- OPEN
	$('[data-popup-open]').on('click', function(e) {
		var targeted_popup_class = jQuery(this).attr('data-popup-open');
		$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
		e.preventDefault();
	});
	//----- CLOSE
	$('[data-popup-close]').on('click', function(e) {
		var targeted_popup_class = jQuery(this).attr('data-popup-close');
		$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
		e.preventDefault();
	});
	
	
	$("#btnsubmit").on('click',function(e){
		
		if($("#txt_firstname").val()==''){
			$('#txt_firstname').css('border','1px solid red');
			$('#err_nofirstname').text('*Please fill in this field.');
		}else{
			$('#txt_firstname').css('border','1px solid gold');
			$('#err_nofirstname').text('');
		}
		
		if($("#txt_lastname").val()==''){
			$('#txt_lastname').css('border','1px solid red');
			$('#err_nolastname').text('*Please fill in this field.');
		}else{
			$('#txt_lastname').css('border','1px solid gold');
			$('#err_nolastname').text('');
		}
		
		if($("#txt_email").val()==''){
			$('#txt_email').css('border','1px solid red');
			$('#err_noemail').text('*Please fill in this field.');
		}else{
			$('#txt_email').css('border','1px solid gold');
			$('#err_noemail').text('');
		}
		
		if($("#txt_tel").val()==''){
			$('#txt_tel').css('border','1px solid red');
			$('#err_notel').text('*Please fill in this field.');
		}else{
			$('#txt_tel').css('border','1px solid gold');
			$('#err_notel').text('');
		}		
		
		if($('#txt_firstname').val()!='' && $('#txt_lastname').val()!='' && $('#txt_email').val()!='' && $('#txt_tel').val()!=''){
			$('#form-register').submit();
		}else{
			
			return false;
		}
		
		e.preventDefault();
	});
	
	
	$("#form-register").on('submit',(function(e){
		e.preventDefault();
		$.ajax({
		  url: "../site/inc/function-sendmail.php",
		  type: "POST",
		  data:  new FormData(this),
		  contentType: false,
		  cache: false,
		  processData:false,
		  dataType: "json",
		  success: function(data){

			if(data.status=="success"){
				$('.popup').fadeOut(350);
				//swal("Thank you for your registration", "A sales representative will contact you back as soon as possible.", "success");
				$('#form-register')[0].reset();
				window.location.replace("http://www.sindhornresidence.com/eng/registration_success.php");
			}else{
				swal("Register Error!", "Please register again later.!", "error");
			}

		  },
		  error: function(){}
		});
	}));
	
	
	
});