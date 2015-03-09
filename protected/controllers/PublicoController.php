<?php
Yii::import('ext.yii-mail.YiiMailMessage');

class PublicoController extends Controller{
 
	public function enviarMail($to,$from,$subject,$body,$adjunto=""){
		$message = new YiiMailMessage;
		$message->setBody($body, 'text');
		$message->subject =$subject;
		$message->addTo($to);
		$message->from = $from;
		if ($adjunto!=""){
                $swiftAttachment = Swift_Attachment::fromPath($adjunto);
                $message->attach($swiftAttachment);
                //var_dump($swiftAttachment);
        }
		if(Yii::app()->mail->send($message))
			return true;
		else 
			return false;
	}
}

?>