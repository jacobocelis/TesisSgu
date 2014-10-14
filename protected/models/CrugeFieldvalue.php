<?php

/**
 * This is the model class for table "cruge_fieldvalue".
 *
 * The followings are the available columns in table 'cruge_fieldvalue':
 * @property integer $idfieldvalue
 * @property integer $iduser
 * @property integer $idfield
 * @property string $value
 *
 * The followings are the available model relations:
 * @property CrugeUser $iduser0
 * @property CrugeField $idfield0
 */
class CrugeFieldvalue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cruge_fieldvalue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iduser, idfield', 'required'),
			array('iduser, idfield', 'numerical', 'integerOnly'=>true),
			array('value', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idfieldvalue, iduser, idfield, value', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'iduser0' => array(self::BELONGS_TO, 'CrugeUser', 'iduser'),
			'idfield0' => array(self::BELONGS_TO, 'CrugeField', 'idfield'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idfieldvalue' => 'Idfieldvalue',
			'iduser' => 'Iduser',
			'idfield' => 'Idfield',
			'value' => 'Value',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idfieldvalue',$this->idfieldvalue);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('idfield',$this->idfield);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrugeFieldvalue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
