<?php

/**
 * This is the model class for table "sgu_cauchorep".
 *
 * The followings are the available columns in table 'sgu_cauchorep':
 * @property integer $id
 * @property integer $idchasis
 * @property integer $idcaucho
 *
 * The followings are the available model relations:
 * @property Caucho $idcaucho0
 * @property Chasis $idchasis0
 */
class Cauchorep extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_cauchoRep';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idchasis, idcaucho', 'required'),
			array('idchasis, idcaucho', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idchasis, idcaucho', 'safe', 'on'=>'search'),
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
			'idcaucho0' => array(self::BELONGS_TO, 'Caucho', 'idcaucho'),
			'idchasis0' => array(self::BELONGS_TO, 'Chasis', 'idchasis'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idchasis' => 'Idchasis',
			'idcaucho' => 'Medida',
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
		$criteria->compare('idchasis',$this->idchasis);
		$criteria->compare('idcaucho',$this->idcaucho);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cauchorep the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
