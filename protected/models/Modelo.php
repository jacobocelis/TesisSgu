<?php

/**
 * This is the model class for table "sgu_modelo".
 *
 * The followings are the available columns in table 'sgu_modelo':
 * @property integer $id
 * @property string $modelo
 * @property integer $idmarca
 *
 * The followings are the available model relations:
 * @property SguMarca $idmarca0
 * @property SguVehiculo[] $sguVehiculos
 */
class Modelo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_modelo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modelo, idmarca', 'required'),
			array('idmarca', 'numerical', 'integerOnly'=>true),
			array('modelo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, modelo, idmarca', 'safe', 'on'=>'search'),
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
			'idmarca0' => array(self::BELONGS_TO, 'Marca', 'idmarca'),
			'sguVehiculos' => array(self::HAS_MANY, 'Vehiculo', 'idmodelo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'modelo' => 'Modelo',
			'idmarca' => 'Idmarca',
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
		$criteria->compare('modelo',$this->modelo,true);
		$criteria->compare('idmarca',$this->idmarca);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Modelo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
