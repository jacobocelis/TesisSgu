<?php

class Autonomia extends CFormModel
{

	public $autonomia;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('autonomia', 'required'),
			array('autonomia', 'numerical', 'integerOnly'=>true),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'autonomia' => 'Autonomía',
		);
	}
}