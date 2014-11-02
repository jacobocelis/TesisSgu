<?php

/**
 * This is the model class for table "sgu_recursiva".
 *
 * The followings are the available columns in table 'sgu_recursiva':
 * @property integer $id
 * @property string $parte
 * @property integer $idrecursiva
 *
 * The followings are the available model relations:
 * @property Recursiva $idrecursiva0
 * @property Recursiva[] $sguRecursivas
 */
class Recursiva extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_recursiva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idrecursiva', 'numerical', 'integerOnly'=>true),
			array('parte', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parte, idrecursiva', 'safe', 'on'=>'search'),
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
			'idrecursiva0' => array(self::BELONGS_TO, 'Recursiva', 'idrecursiva'),
			'sguRecursivas' => array(self::HAS_MANY, 'Recursiva', 'idrecursiva'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parte' => 'Parte',
			'idrecursiva' => 'Idrecursiva',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('parte',$this->parte,true);
		$criteria->compare('idrecursiva',$this->idrecursiva);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recursiva the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
