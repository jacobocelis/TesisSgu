<?php
Yii::import('ext.yii-mail.YiiMailMessage');

class PublicoController extends Controller{
 
	public function enviarMail($to,$from,$subject,$body){
		$message = new YiiMailMessage;
		$message->setBody($body, 'text');
		$message->subject =$subject;
		$message->addTo($to);
		$message->from = $from;
		if(Yii::app()->mail->send($message))
			return true;
		else 
			return false;
	
	}
 
}

?>