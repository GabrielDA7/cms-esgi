<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class ObjectDelegate {


	public function __construct() {}
	
	public function pushObjectById(&$data, $params, $objectName) {
		if ($objectName == USER_CLASS_NAME && isset($_SESSION['userId'])) {
			$params['POST']['id'] = $_SESSION['userId'];
		}
		$object = ClassUtils::constructObjectWithId($params['POST']['id'], $objectName);
		$object = $object->getById();
		$data[lcfirst($objectName)] = $object;
	}

	public function pushObjectsByParameters(&$data, $params, $objectName) {
		$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
		$objects = $object->getWithParameters();
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function pushAllObjects(&$data, $params, $objectName) {
		$object  = new $objectName();
		$objects = $object->getAll();
		$data[lcfirst($objectName)."s"] = $objects;
	}

	public function add($data, $params, $objectName) {
		if (empty($data['errors'])) {
			$object = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$object->generateToken();
			}
			$object->insert();
		}
	}

	public function update(&$data, $params, $objectName, $redirectFront, $redirectBack) {
		if (empty($data['errors'])) {
			$objects = ClassUtils::constructObjectWithParameters($params['POST'], $objectName);
			if ($objectName == USER_CLASS_NAME) {
				$objects->unsetRoleIfNotAdmin();
			}
			$objects->update();
			header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
			exit;
		} else {
			$this->objectDelegate->pushObjectById($data, $params, $objectName);
		}
	}

	public function delete($params, $objectName, $redirectFront, $redirectBack) {
		$objects = ClassUtils::constructObjectWithId($params['POST']['id'], $objectName);
		$objects->delete();
		header(LOCATION . DIRNAME . (isset($params['URL'][2]) && $params['URL'][2] === "back") ? $redirectBack : $redirectFront);
	}

	public function listAll(&$data, $params, $objectName) {
		if (empty($data['errors'])) {
			$this->pushObjectsByParameters($data, $params, $objectName);
		} else {
			$this->pushAllObjects($data, $params, $objectName);
		}
	}

	public function login(&$data, $params) {
		if (empty($data['errors'])) {
			$user = ClassUtils::constructObjectWithParameters($params['POST'], USER_CLASS_NAME);
			$data['wrongPassword'] = $user->login();
		}
	}

	public function disconnect() {
		$user = ClassUtils::constructObjectWithId($_SESSION['userId'], USER_CLASS_NAME);
		$user->disconnect();
		header(LOCATION . DIRNAME);
	}

	public function checkEmailConfirmation($params) {
		$user = ClassUtils::constructObjectWithParameters($params['GET'], USER_CLASS_NAME);
		$user = $user->getWithParameters();
		if (empty($user)) {
			return404View();
		}
		$this->sendMail($user[0]);
		/*header(LOCATION . DIRNAME . USER_LOGIN_FRONT_LINK);*/
	}

	private function sendMail($user) {
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = gethostbyname('smtp.gmail.com'); 					  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'decultot.louis@gmail.com';         // SMTP username
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
		    //Recipients
		    $mail->setFrom('decultot.louis@gmail.com', 'Mailer');
		    $mail->addAddress('decultot.louis@gmail.com'); 

		    //Attachments
		    /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Confirmation de l\'email';
		    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    LogsUtils::process("Send email", "true");
		} catch (Exception $e) {
			LogsUtils::process("Send email", $mail->ErrorInfo);
		}
	}
}
?>