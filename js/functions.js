function ArticleFormValidator(){
	var title = document.forms["add_article"]["title_article"].value;
	var description =document.forms["add_article"]["description_article"].value;
	var text =document.forms["add_article"]["text_article"].value;
	var category =document.forms["add_article"]["cat_article"].value;
	
	//Validade the fields
	if(title == "" || description == "" || text ==""){
		document.getElementById("invalid_field_message2").innerHTML = "The fields marked with * are required!";
		$("#invalid_field_message2").show();
		return false;
	}
	else
	{	
		return true;
		
	}
	
}

function FormValidator(){
	var name = document.forms["Contact_form"]["name"].value;
	var email =document.forms["Contact_form"]["email"].value;
	var text = document.forms["Contact_form"]["message"].value;
	var subject = document.forms["Contact_form"]["subject"].value;
	
	//Validade the fields
	if(name=="" || email=="" || text=="" || subject== ""){
		if(name == ""){
			$("#name").addClass('invalid_form_field');
			document.getElementById("invalid_field_message").innerHTML = "The following fields are required *";
			$("#invalid_field_message").show();
			document.getElementById("name").focus();
			return false;
			
		}
		else{
			$("#name").removeClass('invalid_form_field');
			$("#name").addClass('text_input');
			
		}
		if(subject == ""){
			$("#subject").addClass('invalid_form_field');
			document.getElementById("invalid_field_message").innerHTML = "The following fields are required *";
			$("#invalid_field_message").show();
			document.getElementById("email").focus();
			return false;
			
		}
		else{
			$("#subject").removeClass('invalid_form_field');
			$("#subject").addClass('text_input');
			
		}
		if(email == ""){
			$("#email").addClass('invalid_form_field');
			document.getElementById("invalid_field_message").innerHTML = "The following fields are required *";
			$("#invalid_field_message").show();
			document.getElementById("email").focus();
			return false;
			
		}
		else{
			$("#email").removeClass('invalid_form_field');
			$("#email").addClass('text_input');
			
		}
		if(text == ""){
			$("#textarea_form").removeClass('text_input');
			$("#textarea_form").addClass('invalid_form_field');
			document.getElementById("invalid_field_message").innerHTML = "The following fields are required *";
			$("#invalid_field_message").show();
			document.getElementById("textarea_form").focus();
			return false;
			
		}
		else{
			$("#textarea_form").removeClass('invalid_form_field');
			$("#textarea_form").addClass('text_input');
			
		}
	}
	else{
			
		$("#name").addClass('text_input');
		$("#email").addClass('text_input');
		
		return true;
		
	}
}
	
function RegisterFormValidator(){
	var name = document.forms["form_register"]["first_name"].value;
	var surname =document.forms["form_register"]["second_name"].value;
	var email =document.forms["form_register"]["register_email"].value;
	var confirm_email =document.forms["form_register"]["confirm_email"].value;
	var register_user =document.forms["form_register"]["username_register"].value;
	var user_password =document.forms["form_register"]["password_user"].value;
	var confirm_password =document.forms["form_register"]["confirm_password"].value;
	var phone_user =document.forms["form_register"]["register_phone"].value;
	
	
	
	//Validade the fields
	if(name=="" || surname=="" || email=="" || confirm_email=="" || register_user=="" || user_password=="" ){
		
			document.getElementById("invalid_field_message").innerHTML = "The following fields are required *";
			$("#invalid_field_message").show();
			
			return false;
	}
	else
	{	
		if(user_password != confirm_password){
			document.getElementById("invalid_field_message").innerHTML = "Password/Confirmation must match!";
			$("#invalid_field_message").show();
			
			return false;	
			
		}
		else if(email !=confirm_email ){
			document.getElementById("invalid_field_message").innerHTML = "Email/Email Confirmation must match!";
			$("#invalid_field_message").show();
			return false;
			
		}
		else{
			
			return true;
		}
	}
	
	
	
}


function VideoFormValidator(){
	var title = document.forms["add_video"]["title_video"].value;
	var description =document.forms["add_video"]["description_video"].value;
	var text =document.forms["add_video"]["text_video"].value;
	var category =document.forms["add_video"]["cat_video"].value;
	var link_video =document.forms["add_video"]["link_video"].value;
	//Validade the fields
	if(title=="" || description=="" || text=="" || link_video == "" ){
			document.getElementById("invalid_field_message2").innerHTML = "The fields marked with * are required!";
			$("#invalid_field_message2").show();
			return false;
	}
	else
	{	
		return true;
		
	}
	
}



function passwordValidator(){
	var oldPass = document.forms["edit_password"]["old_password"].value;
	var newPass =document.forms["edit_password"]["new_password"].value;
	var repPass =document.forms["edit_password"]["repeat_password"].value;	
	var passLen = newPass.length;
	//Validade the fields
	if(oldPass=="" || newPass=="" || repPass == "" ){
			document.getElementById("status_password").innerHTML = "The fields marked with * are required!";
			return false;
	}
	if(repPass != newPass){
			
			document.getElementById("status_password").innerHTML = "Password and confirm password must match!";
			return false;	
	}
	if(newPass.length < 5 || newPass.length > 50){
			document.getElementById("status_password").innerHTML = "Check the lenght of your password!";
			return false;	
	}
	else
	{	
		
		return true;
		
	}
	
}


