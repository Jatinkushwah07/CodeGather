<?php 
	
	require('Mailer/PHPMailerAutoload.php');
	
	function sendmail($data) {
		$mail = getInstance();
		$body = "<div>Dear Team,</div>";
		$body = $body . "<div style='height:15px;'>&nbsp;</div>";
		$body = $body . "<div style='height:15px;'>".$data['name']." has raised a query as mentioned below.</div>";
		$body = $body . "<div style='height:15px;'>&nbsp;</div>";
		$body = $body . "<div>&nbsp;&nbsp;&nbsp;&nbsp;".nl2br($data['message'])."</div>";
		$body = $body . "<div style='height:15px;'>&nbsp;</div>";
		$body = $body . "<div style='height:15px;'>Contact Details:-</div>";
		$body = $body . "<div style='height:15px;'>Email Address : ".$data['email']."</div>";
		$body = $body . "<div style='height:15px;'>Mobile Number : ".$data['phone']."</div>";
		$body = $body . "<div style='height:15px;'>&nbsp;</div>";
		$body = $body . "<div>Regards,</div>";
		$body = $body . "<div>Team EPG, NDTV.</div>";
		$mail->MsgHTML($body);
		$mail->SetFrom('epg@ndtv.com', 'NDTV EPG Team');
		$mail->AddAddress('jatin.kushwah07@gmail.com');
		//$mail->AddCC('epgtech@ndtv.com');
		$mail->Subject = "Customer query form EPG site";	
		//$mail->AddAttachment($zippath);
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
			return false;
		}
		return true;
	}
	
	function sendErrorMail($error) {
		$mail = getInstance();
		$body = "<div>Please check error encountered in send epg in xls format</div>";
		$body = $body . "<div style='height:15px;'>&nbsp;</div>";
		$body = $body . "<div style='color:red;'>&nbsp;&nbsp;&nbsp;&nbsp;".$error."</div>";
		$body = $body . "<div style='height:15px;'>&nbsp;</div>";
		$body = $body . "<div>Regards,</div>";
		$body = $body . "<div>Team EPG, NDTV.</div>";
		$mail->MsgHTML($body);
		$mail->SetFrom('epg@ndtv.com', 'NDTV EPG Team');
		$mail->AddAddress('sachint@ndtv.com');
		$mail->Subject = $error;
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	function getInstance() {
		$mail = new PHPMailer();
		$mail->SMTPDebug = 0;
		$mail->SMTPAutoTLS = false;
		$mail->SMTPAuth = false;
		$mail->SMTPSecure = '';
		$mail->Host = "172.16.0.91";
		$mail->Port = 2521;
		$mail->Mailer = "smtp";
		$mail->IsHTML(true);
		//$mail->Username = "";
		//$mail->Password = ""; 
		return $mail;
	}