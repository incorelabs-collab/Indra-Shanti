<?php
$mail_ack;
$mail_send = "indrashanti.ambikapur@gmail.com";
$msg;

use \google\appengine\api\mail\Message;

function sendMessage($to,$subject,$msg){
	try{
		$message = new Message();
		$message->setSender("indrashanti.ambikapur@gmail.com");
		$message->addTo($to);
		$message->setSubject($subject);
		$message->setHtmlBody($msg);
		$message->send();
	}catch(InvalidArgumentException $e){

	}
}


if (isset($_REQUEST)) {
	if ($_REQUEST["id"] == 1) {
		if (isset($_REQUEST["room_type"]) ||
			isset($_REQUEST["check_in"]) ||
			isset($_REQUEST["check_out"]) ||
			isset($_REQUEST["email"]) || 
			isset($_REQUEST["mobile"]) ) {
		
			$mail_ack = $_REQUEST["email"];
			
			$msg = '<p>Hi Indrashanti team,</p>
				<p>There is an enquiry for Room Type:<strong>'.$_REQUEST["room_type"].'</strong>. Their tentative visit time is from <strong>'.$_REQUEST["check_in"].' to '.$_REQUEST["check_out"].'</strong>.</p>
				<h4>Contact Details</h4><table border="1">
					<tr><td><b>MOBILE</b></td><td>'.$_REQUEST["mobile"].'</td></tr>
					<tr><td><b>EMAIL</b></td><td>'.$_REQUEST["email"].'</td></tr>
				</table>';

		}else{
			echo "Sorry !! Internal Error.";
		}
	}elseif ($_REQUEST["id"] == 2) {
		$mail_ack = $_REQUEST["email"];
		$msg = '<p>Hi Indrashanti team,</p>
				There is message from '.$_REQUEST['name'].'<p><strong>Message: </strong>'.$_REQUEST['msg'].'</p>
				<h4>Contact Details</h4><table border="1">
					<tr><td><b>MOBILE</b></td><td>'.$_REQUEST["mobile"].'</td></tr>
					<tr><td><b>EMAIL</b></td><td>'.$_REQUEST["email"].'</td></tr>
				</table>';
	}

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
	$headers .= 'From: Incore Labs. <contact@incorelabs.com>' . "\r\n";
	$headers_ack = 'From: Indrashanti. <no-reply@indrashanti.com>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	$msg_ack = "<p>Thank you for showing interest. We will contact you shortly</p>Regards<br />Indra Shanti<br />For any queries please contact indrashanti.ambikapur@gmail.com";

	sendMessage($mail_ack, "Thank you", $msg_ack);
	sendMessage($mail_send, "Inquiry", $msg);
	echo "Thank you for showing interest. We will contact you shortly.";
}
?>