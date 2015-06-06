<?php

class Iva extends CFormModel
{

	public $iva;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iva', 'required'),
			array('iva', 'numerical', 'integerOnly'=>true, 'min'=>0,'max'=>100),

		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iva' => 'IVA',
		);
	}
}