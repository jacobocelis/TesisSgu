<?php

/**
 * This is the model class for table "sgu_historicocaucho".
 *
 * The followings are the available columns in table 'sgu_historicocaucho':
 * @property integer $id
 * @property string $fecha
 * @property string $serial
 * @property integer $idestatusCaucho
 * @property integer $idcaucho
 * @property integer $idmarcaCaucho
 * @property integer $idvehiculo
 * @property integer $iddetalleRueda
 * @property integer $idasigChasis
 *
 * The followings are the available model relations:
 * @property Asigchasis $idasigChasis0
 * @property Caucho $idcaucho0
 * @property Detallerueda $iddetalleRueda0
 * @property Estatuscaucho $idestatusCaucho0
 * @property Marcacaucho $idmarcaCaucho0
 * @property Vehiculo $idvehiculo0
 */
class Historicocaucho extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_historicocaucho';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idestatusCaucho, idcaucho, idvehiculo, idasigChasis', 'required'),
			array('idestatusCaucho, idcaucho, idmarcaCaucho, idvehiculo, iddetalleRueda, idasigChasis', 'numerical', 'integerOnly'=>true),
			array('serial', 'length', 'max'=>45),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, serial, idestatusCaucho, idcaucho, idmarcaCaucho, idvehiculo, iddetalleRueda, idasigChasis', 'safe', 'on'=>'search'),
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
			'idasigChasis0' => array(self::BELONGS_TO, 'Asigchasis', 'idasigChasis'),
			'idcaucho0' => array(self::BELONGS_TO, 'Caucho', 'idcaucho'),
			'iddetalleRueda0' => array(self::BELONGS_TO, 'Detallerueda', 'iddetalleRueda'),
			'idestatusCaucho0' => array(self::BELONGS_TO, 'Estatuscaucho', 'idestatusCaucho'),
			'idmarcaCaucho0' => array(self::BELONGS_TO, 'Marcacaucho', 'idmarcaCaucho'),
			'idvehiculo0' => array(self::BELONGS_TO, 'Vehiculo', 'idvehiculo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'serial' => 'Serial',
			'idestatusCaucho' => 'Idestatus Caucho',
			'idcaucho' => 'Idcaucho',
			'idmarcaCaucho' => 'Idmarca Caucho',
			'idvehiculo' => 'Idvehiculo',
			'iddetalleRueda' => 'Iddetalle Rueda',
			'idasigChasis' => 'Idasig Chasis',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('serial',$this->serial,true);
		$criteria->compare('idestatusCaucho',$this->idestatusCaucho);
		$criteria->compare('idcaucho',$this->idcaucho);
		$criteria->compare('idmarcaCaucho',$this->idmarcaCaucho);
		$criteria->compare('idvehiculo',$this->idvehiculo);
		$criteria->compare('iddetalleRueda',$this->iddetalleRueda);
		$criteria->compare('idasigChasis',$this->idasigChasis);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Historicocaucho the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
