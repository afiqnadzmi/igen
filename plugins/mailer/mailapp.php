<?phprequire("class.phpmailer.php");function mailto($toemail, $subj, $msg, $headers) {    //--------------writing email----------------------------------------$mail = new PHPMailer(true);  //initiate PHPMailer$mail->IsSMTP();  // telling the class to use SMTP$mail->Mailer = "smtp"; //type$mail->SMTPSecure = "tls"; $mail->Host = "smtp.gmail.com"; //host smtp default->google: smtp.gmail.com$mail->Port = 587; //smtp port default-> 465$mail->SMTPAuth = true; // turn on SMTP authentication$mail->IsHTML(true);$mail->SMTPDebug = 1;$mail->Username = "igen.tech.hr@gmail.com"; // SMTP username old - baseopsdemo@gmail.com -$mail->Password = "UseR1234HR"; // SMTP password$mail->Subject  = $subj; //email title $mail->AddAddress($toemail);  //to email    $mail->Body	= $msg;    $mail->WordWrap = 100; //warp text content        if($mail->Send()){		return "A reset link has been sent to your email";				}else{		return "Error while processing";		}    //print 'hi---' . $recipient . ',' . $subj . ',' . $mail_body . $a;    }?>