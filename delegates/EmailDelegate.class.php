<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class EmailDelegate {

	public function __construct() {}

	public function sendEmailConfirmation(&$data) {
		if (!isset($data['users']) || empty($data['users'])) {
			return $data['errors'] = TRUE;
		}
		$user = $data['users'][0];
		$subject = 'Confirmation de l\'email';
		$url = $this->computeFullUrl(DIRNAME . USER_EMAIL_CONFIRM_LINK);
		$body = '<form action="' . $url .'" method="POST">
		          <input type="hidden" name="id" value="'. $user->getId() .'">
		          <input type="hidden" name="emailConfirm" value="'. $user->getEmailConfirm() .'">
		          <input type="submit" name="submit" value="Confirm email">
		        </form>';
		$data['errors'] = $this->sendMail($user->getEmail(), $subject, $body);
	}

	public function sendPasswordReset(&$data) {
		if (!isset($data['users']) || empty($data['users'])) {
			return $data['errors'] = TRUE;
		}
		$user = $data['users'][0];
		$user->generatePwdReset();
		$subject = 'modifier mot de passe';
		$body = '<form action="localhost' .  DIRNAME . USER_PASSWORD_RESET_LINK .'" method="POST">
		          <input type="hidden" name="id" value="'. $user->getId() .'">
		          <input type="hidden" name="pwdReset" value="'. $user->getPwdReset() .'">
		          <input type="submit" name="submit" value="Reset Password">
		        </form>';
		$data['errors'] = $this->sendMail($user->getEmail(), $subject, $body);
		$data['user'] = $user;
	}

	private function sendMail($email, $subject, $body, $attachments = []) {
		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $this->setSMTP($mail);
		    //Recipients
		    $mail->setFrom('decultot.louis@gmail.com', 'Uteach');
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
	    $mail->Host = gethostbyname('SSL0.OVH.NET'); 		  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'account.services@uteach.fr';         // SMTP username
      	$mail->Password = 'Aze123Esgi';                         // SMTP password
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

	private function computeFullUrl($url) {
		$protocole = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
		return $protocole . $_SERVER['SERVER_NAME'] . $url;
	}
}