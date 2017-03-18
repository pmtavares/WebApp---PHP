<?php
require_once("includes/site_header.php");


//CODE TO SEND THE FORM CONTACT
$message_sent = "";
if(isset($_POST["send_message"])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message_user = $_POST['message'];
	$phone = $_POST['phone'];
	if (($name=="")||($email=="")||($message_user=="") || ($subject =="")) 
    { 
       $message_sent =  "All fields are required, please fill <a href='contact.php'>the form</a> again."; 
    } 
	else{
		$from="From: $name<$email>\r\nReturn-path: $email"; 
		$message .= "Phone Number: ".$phone."";
		$message .= "<p>Name: ".$name."</p>";
		$message = '<!DOCTYPE html><html>
			<head>
			<meta charset="UTF-8"><title>yoursitename Message</title>
			</head>
			<body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">'.$message_user.'
			<br/><br/>Name: '.$name.'<br/><br/>Phone number: '.$phone.'
			</body></html>';
		$headers = "From: $name<$email>\r\nReturn-path: $email";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        mail("pmauriciotavares@yahoo.com.br", $subject, $message, $headers); 
        $message_sent =  "<h4>Email sent!</h4><p>Thanks for contact us</p>"; 
        
		
	}
	
}

?>
<body>
<div class="main_wrapper">
	<div id="map_contact">
    	<p>Contact Info</p>
    	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3105.15008367138!2d-77.03879428440858!3d38.897683100524205!3m2!1i1024!
        	2i768!4f13.1!3m3!1m2!1s0x89b7b7bcdec17ee3%3A0xf920b148b3d45e45!2s1600+Pennsylvania+Ave+NW%2C+Washington%2C+DC+20500%2C+USA!5e0!3m2!
            1spt-BR!2sie!4v1412970291858" width="1080" height="340" >
         </iframe>
    
    </div>
    <div id="form_contact"> 
    	<h3>Send us a message</h3>
       
    	<form method="POST" action="contact.php" id="main_form_contact" name = "Contact_form" >
        <label for="name">Name*</label>
        <label for="email">Email*</label>
        <label for="phone">Phone</label>
        <input type="text" id ="name" class="text_input" name="name" placeholder="Full Name"  maxlength="40" />
       	<input type="email" id = "email" class="text_input" name="email" placeholder="Email"  maxlength="40"/>
        <input type="text" id="phone" name="phone" class="text_input" placeholder="Phone Number"/></br></br>
        <label for="subject" id="subject_label">Subject*</label>
        <input type="text" id ="subject" class="text_input" name="subject" placeholder="subject"  maxlength="100" />
        <br/>
        <label for="message">Message* </label>
		<textarea  maxlength="600" id="message" class="text_input" name="message" placeholder="Your Message here..." rows="10" cols="10"></textarea><br/>
        <input type="submit" name="send_message" value="Send" onClick="return FormValidator()" />
        <input type="reset" value="Clear" />
        <p id="invalid_field_message"></p>
        <p id="valid_field_message"><?php echo $message_sent; ?></p>
        </form>
    
    </div><!--End div form_contact--> 	
    <div id="address_contact">
    	<h2>Addresses</h2>
        <h3>Address 1</h3>
        <p>1600 Pennsylvania Ave NW, Washington, DC 20500, USA</p>
        <h3>Address 2</h3>
        <p>Ballymena Borough Council, Co Antrim, Northern Ireland, Republic of Ireland </p>
        <h3>Telephones:</h3>
        <p>01 123543</p>
        <p>01 987345</p>
        <p></p>
    
    </div>	
    		
</div><!--End div main_wrapper--> 
  
</body>

<!--Page's footer-->
<?php require_once("includes/site_footer.php"); ?>
