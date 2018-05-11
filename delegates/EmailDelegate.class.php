<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class EmailDelegate {

	public function __construct() {}

	public function checkEmailConfirmation($params) {
		$user = ClassUtils::constructObjectWithParameters($params['GET'], USER_CLASS_NAME);
		$user = $user->getWithParameters();
		if (empty($user)) {
			RedirectUtils::redirect404();
		}
		$user[0]->setEmailConfirm("1");
		$user[0]->update();
		RedirectUtils::redirect(USER_LOGIN_FRONT_LINK);
	}

	public function checkPasswordReset($params) {
		$user = ClassUtils::constructObjectWithId($params['POST']['userId'], USER_CLASS_NAME);
		$user = $user->getById();
		if (empty($user)) {
			RedirectUtils::redirect404();
		}
		$user->setPwdReset(null);
		$user->setPwd($params['POST']['newPwd']);
		$user->update();
		RedirectUtils::redirect(USER_LOGIN_FRONT_LINK);
	}

	public function sendEmailConfirmation($data) {
		if (!isset($data['user'])) {
			$data['errors'] = TRUE;
			return null;
		}
		$user = $data['user'];
		$subject = 'Confirmation de l\'email';
		$body = 'Cliquer sur le lien pour confirmer votre inscription : http://localhost/Uteach/user/email?id='.$user->getId().'&emailConfirm='.$user->getEmailConfirm();
		$data['errors'] = $this->sendMail($user->getEmail(), $subject, $body);
	}

	public function sendPasswordReset($email) {
		if (!isset($data['user'])) {
			$data['errors'] = TRUE;
			return null;
		}
		$user = $data['user'];
		$subject = 'modifier mot de passe';
		$body = 'Cliquer sur le lien pour modifier votre mot de passe : http://localhost/Uteach/user/email?email='.$user->getEmail();
		$data['errors'] = $this->sendMail($user->getEmail(), $subject, $body);
	}

	private function sendMail($email, $subject, $body, $attachments = []) {
		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $this->setSMTP($mail);
		    //Recipients
		    $mail->setFrom('decultot.louis@gmail.com', 'Mailer');
		    $mail->addAddress($email);

		    if (!empty($attachments)) {
		    	foreach ($attachments as $file => $name) {
		    		$mail->addAttachment($file['URL'], $name);
		    	}
		    }

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $body;
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    LogsUtils::process("logs", "Send email", "true");
		    return FALSE;
		} catch (Exception $e) {
			LogsUtils::process("logs", "Send email", $mail->ErrorInfo);
			return TRUE;
		}
	
	}

	private function setSMTP(&$mail) {
		$mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = gethostbyname('smtp.gmail.com'); 		  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'gabrieldaoud3112@gmail.com';         // SMTP username
	    $mail->Password = '1234ggaabb78$#';                         // SMTP password
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
