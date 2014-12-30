<?php

/**
 * This is the model class for table "sgu_historicocombustible".
 *
 * The followings are the available columns in table 'sgu_historicocombustible':
 * @property integer $id
 * @property string $fecha
 * @property double $litros
 * @property double $costoTotal
 * @property integer $idestacionServicio
 * @property integer $idconductor
 * @property integer $idvehiculo
 *
 * The followings are the available model relations:
 * @property SguEmpleado $idconductor0
 * @property SguEstacionservicio $idestacionServicio0
 * @property SguVehiculo $idvehiculo0
 */
class Historicocombustible extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_historicoCombustible';
	}
	public function fechaReposicion($fecha){
		
		if(date("d/m/Y",strtotime($fecha))==date("d/m/Y",strtotime("today")))
			return '<div id="verde">Hoy</div>';
		elseif(date("d/m/Y",strtotime($fecha))==date("d/m/Y",strtotime("yesterday")))
			return '<div id="verde">Ayer</div>';
		else
			return '+ '.(date("d/m/Y",strtotime("now"))-date("d/m/Y",strtotime($fecha))).' Días';
		
	}
	
	public function ReposicionDias($fecha){
			return (date("d/m/Y",strtotime("now"))-date("d/m/Y",strtotime($fecha)));
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, litros, costoTotal, idestacionServicio, idconductor, idvehiculo', 'required'),
			array('idestacionServicio, idconductor, idvehiculo', 'numerical', 'integerOnly'=>true),
			array('litros, costoTotal', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, litros, costoTotal, idestacionServicio, idconductor, idvehiculo', 'safe', 'on'=>'search'),
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
			'idconductor0' => array(self::BELONGS_TO, 'Empleado', 'idconductor'),
			'idestacionServicio0' => array(self::BELONGS_TO, 'Estacionservicio', 'idestacionServicio'),
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
			'litros' => 'Litros',
			'costoTotal' => 'Costo Total',
			'idestacionServicio' => 'Idestacion Servicio',
			'idconductor' => 'Idconductor',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('litros',$this->litros);
		$criteria->compare('costoTotal',$this->costoTotal);
		$criteria->compare('idestacionServicio',$this->idestacionServicio);
		$criteria->compare('idconductor',$this->idconductor);
		$criteria->compare('idvehiculo',$this->idvehiculo);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Historicocombustible the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
