<?php

/**
 * This is the model class for table "sgu_historicoviajes".
 *
 * The followings are the available columns in table 'sgu_historicoviajes':
 * @property integer $id
 * @property string $fecha
 * @property string $horaSalida
 * @property string $horaLlegada
 * @property integer $idviaje
 * @property integer $idvehiculo
 *
 * The followings are the available model relations:
 * @property SguVehiculo $idvehiculo0
 * @property SguViaje $idviaje0
 */
class Historicoviajes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_historicoViajes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, horaSalida, horaLlegada, idviaje, idvehiculo,nroPersonas', 'required'),
			array('idviaje, idvehiculo,nroPersonas', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, horaSalida, horaLlegada, idviaje, idvehiculo', 'safe', 'on'=>'search'),
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
			'idvehiculo0' => array(self::BELONGS_TO, 'Vehiculo', 'idvehiculo'),
			'idviaje0' => array(self::BELONGS_TO, 'Viaje', 'idviaje'),
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
			'horaSalida' => 'Hora de salida',
			'horaLlegada' => 'Hora de llegada',
			'idviaje' => 'Ruta realizada',
			'idvehiculo' => 'Unidad',
			'nroPersonas' => 'Total pasajeros',
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
		$criteria->compare('horaSalida',$this->horaSalida,true);
		$criteria->compare('horaLlegada',$this->horaLlegada,true);
		$criteria->compare('idviaje',$this->idviaje);
		$criteria->compare('idvehiculo',$this->idvehiculo);
		$criteria->compare('nroPersonas',$this->nroPersonas);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Historicoviajes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
