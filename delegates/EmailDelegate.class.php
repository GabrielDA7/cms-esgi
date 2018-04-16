<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class EmailDelegate {

	public function checkEmailConfirmation($params) {
		$user = ClassUtils::constructObjectWithParameters($params['GET'], USER_CLASS_NAME);
		$user = $user->getWithParameters();
		if (empty($user)) {
			return404View();
		}
		$user[0]->setEmailConfirm("1");
		$user[0]->setPwd(null);
		$user[0]->update();
		header(LOCATION . DIRNAME . USER_LOGIN_FRONT_LINK);
	}

	public function sendMail($data) {
		if (isset($data['user'])) {
			$user = $data['user'];
			$mail = new PHPMailer(true);
			try {
			    //Server settings
			    $this->setSMTP($mail);
			    //Recipients
			    $mail->setFrom('decultot.louis@gmail.com', 'Mailer');
			    $mail->addAddress($user->getEmail()); 

			    //Attachments
			    /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

			    //Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Confirmation de l\'email';
			    $mail->Body    = 'Cliquer sur le lien pour confirmer votre inscription : http://localhost/Uteach/user/email?id='.$user->getId().'&emailConfirm='.$user->getEmailConfirm();
			    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			    $mail->send();
			    LogsUtils::process("logs", "Send email", "true");
			} catch (Exception $e) {
				LogsUtils::process("logs", "Send email", $mail->ErrorInfo);
			}
		}
	}

	private function setSMTP(&$mail) {
		$mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = gethostbyname('smtp.gmail.com'); 		  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = '';         // SMTP username
	    $mail->Password = '';                         // SMTP password
	    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 465;                                    // TCP port to connect to
	    $mail->SMTPOptions = array(
		    	'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);
	}
}
?>