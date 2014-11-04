<?php

/**
 * This is the model class for table "sgu_plan".
 *
 * The followings are the available columns in table 'sgu_plan':
 * @property integer $id
 * @property string $parte
 * @property integer $idplan
 * @property integer $idvehiculo
 *
 * The followings are the available model relations:
 * @property SguActividades[] $sguActividades
 * @property Plan $idplan0
 * @property Plan[] $sguPlans
 * @property SguVehiculo $idvehiculo0
 */
class Plan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parte, idvehiculo', 'required'),
			array('idplan, idvehiculo', 'numerical', 'integerOnly'=>true),
			array('parte', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parte, idplan, idvehiculo', 'safe', 'on'=>'search'),
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
			'sguActividades' => array(self::HAS_MANY, 'SguActividades', 'idplan'),
			'idplan0' => array(self::BELONGS_TO, 'Plan', 'idplan'),
			'sguPlans' => array(self::HAS_MANY, 'Plan', 'idplan'),
			'idvehiculo0' => array(self::BELONGS_TO, 'SguVehiculo', 'idvehiculo'),
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
			'idplan' => 'Idplan',
			'idvehiculo' => 'Idvehiculo',
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
		$criteria->compare('idplan',$this->idplan);
		$criteria->compare('idvehiculo',$this->idvehiculo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
