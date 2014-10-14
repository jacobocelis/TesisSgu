<?php

/**
 * This is the model class for table "cruge_field".
 *
 * The followings are the available columns in table 'cruge_field':
 * @property integer $idfield
 * @property string $fieldname
 * @property string $longname
 * @property integer $position
 * @property integer $required
 * @property integer $fieldtype
 * @property integer $fieldsize
 * @property integer $maxlength
 * @property integer $showinreports
 * @property string $useregexp
 * @property string $useregexpmsg
 * @property string $predetvalue
 *
 * The followings are the available model relations:
 * @property CrugeFieldvalue[] $crugeFieldvalues
 */
class CrugeField extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cruge_field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fieldname', 'required'),
			array('position, required, fieldtype, fieldsize, maxlength, showinreports', 'numerical', 'integerOnly'=>true),
			array('fieldname', 'length', 'max'=>20),
			array('longname', 'length', 'max'=>50),
			array('useregexp, useregexpmsg', 'length', 'max'=>512),
			array('predetvalue', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idfield, fieldname, longname, position, required, fieldtype, fieldsize, maxlength, showinreports, useregexp, useregexpmsg, predetvalue', 'safe', 'on'=>'search'),
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
			'crugeFieldvalues' => array(self::HAS_MANY, 'CrugeFieldvalue', 'idfield'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idfield' => 'Idfield',
			'fieldname' => 'Fieldname',
			'longname' => 'Longname',
			'position' => 'Position',
			'required' => 'Required',
			'fieldtype' => 'Fieldtype',
			'fieldsize' => 'Fieldsize',
			'maxlength' => 'Maxlength',
			'showinreports' => 'Showinreports',
			'useregexp' => 'Useregexp',
			'useregexpmsg' => 'Useregexpmsg',
			'predetvalue' => 'Predetvalue',
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

		$criteria->compare('idfield',$this->idfield);
		$criteria->compare('fieldname',$this->fieldname,true);
		$criteria->compare('longname',$this->longname,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('required',$this->required);
		$criteria->compare('fieldtype',$this->fieldtype);
		$criteria->compare('fieldsize',$this->fieldsize);
		$criteria->compare('maxlength',$this->maxlength);
		$criteria->compare('showinreports',$this->showinreports);
		$criteria->compare('useregexp',$this->useregexp,true);
		$criteria->compare('useregexpmsg',$this->useregexpmsg,true);
		$criteria->compare('predetvalue',$this->predetvalue,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrugeField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
