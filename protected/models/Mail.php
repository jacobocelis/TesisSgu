<?php

class Mail extends CFormModel
{

	public $subject;
	public $to;
	public $from;
	public $body;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, to, from, body', 'required'),
			array('to, from', 'email'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'subject' => 'Asunto',
			'from' => 'De',
			'to' => 'Para',
			'body' => 'Mensaje',
		);
	}
}