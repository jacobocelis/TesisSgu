<?php

/**
 * This is the model class for table "sgu_tipocombustible".
 *
 * The followings are the available columns in table 'sgu_tipocombustible':
 * @property integer $id
 * @property string $combustible
 * @property double $costoLitro
 *
 * The followings are the available model relations:
 * @property SguVehiculo[] $sguVehiculos
 */
class Tipocombustible extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_tipoCombustible';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, combustible', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('costoLitro', 'numerical'),
			array('combustible', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, combustible, costoLitro', 'safe', 'on'=>'search'),
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
			'sguVehiculos' => array(self::HAS_MANY, 'Vehiculo', 'idcombustible'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'combustible' => 'Combustible',
			'costoLitro' => 'Costo x Litro',
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
		$criteria->compare('combustible',$this->combustible,true);
		$criteria->compare('costoLitro',$this->costoLitro);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tipocombustible the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
