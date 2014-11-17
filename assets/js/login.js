$(document).ready(function() {
	$("#login_form").submit(function(event) {
		var username =  $('#username').val();
		var password =  $('#password').val();
		
		if (username.length + password.length < 10) {  
			return false;
		} else {
			$("input[type=submit]").attr("disabled", "disabled");
			event.preventDefault();
		}
		
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Checking....').fadeIn(1000);
		//check the Username exists or not from ajax
		$.post("../controller/ajax.php",{ username:$('#username').val(), password:$('#password').val(), operation:'login', rand:Math.random() }, function(data) {
		  console.log(data);
            if(data==1) //if correct login detail
		  {
			$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Access Granted.').addClass('messageboxok').fadeTo(900,1,
				  function(){ 
					 document.location='movies.php';
				  });
			});
		  } else {
			$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Access Denied!').addClass('messageboxerror').fadeTo(900,1, function() {
					$("input[type=submit]").removeAttr("disabled");   
				});
			});		
		  }	
		});
		return false; //not to post the  form physically
	});
});