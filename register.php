<?php
include("includes/site_header.php");

?>
<head>
<script src="js/ajax.js"></script>
</head>
<body>
  <div class="main_wrapper">
  	<div id="registration_div">
      <h4>Register Form</h4>
      <h5>It is free to register. Items marked with * are required.</h5>
      <form id="form_register" name = "form_register" action="register_ex.php" method="POST"  >
          <label for="first_name">First name* </label>
          <input type="text" id ="first_name" class="input_resgister" name="first_name"  maxlength="40" /><br/>
          <label for="second_name">Second name* </label>
          <input type="text" id ="second_name" class="input_resgister" name="second_name"  maxlength="40" /><br/>
          <label for="username_register">Username* </label>
          <input type="text" id ="username_register" class="input_resgister" name="username_register"  maxlength="30" onChange="check_user();"/><div id="status_username"></div><br/>
          <label for="register_email">Email*</label>
          <input type="email" id = "register_email" class="input_resgister" name="register_email"   maxlength="40" onChange="check_email();"/><div id="status_email"></div><br/>
          <label for="confirm_email">Confirm Email*</label>
          <input type="email" id = "confirm_email" class="input_resgister" name="confirm_email" maxlength="40"/><br/>
          <label for="password_user">Password*</label>
          <input type="password" id = "password_user" class="input_resgister" name="password_user"  maxlength="40"/><br/>
          <label for="confirm_password">Confirm password*</label>
          <input type="password" id = "confirm_password" class="input_resgister" name="confirm_password"  maxlength="40"/><br/>
          <label for="register_phone">Phone*</label>
          <input type="text" id="register_phone" name="register_phone" class="input_resgister" /><br/>
          <input type="submit" name="send_register" value="Send" onClick="return RegisterFormValidator()" />
          <input type="reset" value="Clear" />
           <p id="invalid_field_message"></p>
      		<p id="valid_field_message"></p>
      
      
      </form>
      <noscript>
      	Oooops! Your JavaScript is turned-off. If you do not turn it on, you might not be able to enjoy everything!
      </noscript>
      
      <div id="terms_conditions">
      	<span class="normal_text">By registering, you are accepting the</span>	
      	<a href="#terms_details">  *Terms and Conditions</a>
        <p id="terms_details">Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, 
        which together with our privacy policy govern [business name]'s relationship with you in relation to this website. If you disagree with any part of these terms and 
        conditions, please do not use our website. 
        The term '[business name]' or 'us' or 'we' refers to the owner of the website whose registered office is [address]. Our company registration number is [company registration 
        number and place of registration]. The term 'you' refers to the user or viewer of our website. <br>
		<br>
		The use of this website is subject to the following terms of use: <br>
        	The content of the pages of this website is for your general information and use only. It is subject to change without notice.<br>
            This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, the following personal information may be stored by us for use by third parties: 
			[insert list of information].<br>
			Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found 
            or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for 
            any such inaccuracies or errors to the fullest extent permitted by law.</p>
      </div>
     
  
  </div>
  
  </div>
  
</body>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>