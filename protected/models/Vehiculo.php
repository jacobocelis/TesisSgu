<?php

/**
 * This is the model class for table "sgu_vehiculo".
 *
 * The followings are the available columns in table 'sgu_vehiculo':
 * @property integer $id
 * @property integer $numeroUnidad
 * @property string $serialCarroceria
 * @property string $serialChasis
 * @property string $placa
 * @property integer $anno
 * @property integer $nroPuestos
 * @property integer $nroEjes
 * @property integer $capCarga
 * @property string $comentario
 * @property integer $cantidadRuedas
 * @property integer $capTanque
 * @property integer $idmodelo
 * @property integer $idgrupo
 * @property integer $idcombustible
 * @property string $fechaRegistro
 *
 * The followings are the available model relations:
 * @property SguCaracteristicaveh[] $sguCaracteristicavehs
 * @property SguFoto[] $sguFotos
 * @property SguHistoricoedos[] $sguHistoricoedoses
 * @property SguRueda[] $sguRuedas
 * @property SguCombustible $idcombustible0
 * @property SguGrupo $idgrupo0
 * @property SguModelo $idmodelo0
 * @property SguTipo $idtipo0
 * @property SguVehiculoitem[] $sguVehiculoitems
 */
class Vehiculo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_vehiculo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numeroUnidad, serialCarroceria,serialMotor, placa, anno, cantidadRuedas, capTanque, idmodelo, idgrupo, idcombustible, idcolor,idpropiedad,KmInicial', 'required'),
			array('numeroUnidad, anno, nroPuestos, nroEjes, capCarga, cantidadRuedas, capTanque, idmodelo, idgrupo, idcombustible,idcolor,idpropiedad,KmInicial', 'numerical', 'integerOnly'=>true),
			array('serialCarroceria', 'length', 'max'=>45),
			array('placa', 'length', 'max'=>7),
			array('comentario', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, numeroUnidad, serialCarroceria, serialChasis, placa, anno, nroPuestos, nroEjes, capCarga, comentario, cantidadRuedas, capTanque, idmodelo, idgrupo, idcombustible,idcolor,idpropiedad, idtipo, fechaRegistro,KmInicial', 'safe', 'on'=>'search'),
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
			'Caracteristicavehs' => array(self::HAS_MANY, 'Caracteristicaveh', 'idvehiculo'),
			'Fotos' => array(self::HAS_MANY, 'Foto', 'idvehiculo'),
			'Historicoedoses' => array(self::HAS_MANY, 'Historicoedos', 'idvehiculo'),
			'Ruedas' => array(self::HAS_MANY, 'Rueda', 'idvehiculo'),
			'idcombustible0' => array(self::BELONGS_TO, 'Combustible', 'idcombustible'),
			'idgrupo0' => array(self::BELONGS_TO, 'Grupo', 'idgrupo'),
			'idcolor0' => array(self::BELONGS_TO, 'Color', 'idcolor'),
			'idmodelo0' => array(self::BELONGS_TO, 'Modelo', 'idmodelo'),
			'sguVehiculoitems' => array(self::HAS_MANY, 'Vehiculoitem', 'idvehiculo'),
			'idpropiedad0' => array(self::BELONGS_TO, 'Propiedad', 'idpropiedad'),
			'Vehitems' => array(self::HAS_MANY, 'Vehitem', 'idvehiculo'),
			'sguInformacions' => array(self::HAS_MANY, 'Informacion', 'idvehiculo'),
			'sguActividades' => array(self::HAS_MANY, 'Actividades', 'idvehiculo'),
			'sguKilometrajes' => array(self::HAS_MANY, 'Kilometraje', 'idvehiculo'),
			'sguHistoricoempleadoses' => array(self::HAS_MANY,'Historicoempleados', 'idvehiculo'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numeroUnidad' => 'Número de unidad',
			'serialCarroceria' => 'Serial de carroceria',
			'serialMotor' => 'Serial de motor',
			'placa' => 'Placa',
			'anno' => 'Año',
			'nroPuestos' => 'Número de puestos',
			'nroEjes' => 'Número de ejes',
			'capCarga' => 'Capacidad de carga',
			'comentario' => 'Comentarios',
			'cantidadRuedas' => 'Cantidad de ruedas',
			'capTanque' => 'Capacidad de tanque',	
			'idmodelo' => 'Modelo',
			'idgrupo' => 'Grupo',
			'idcombustible' => 'Combustible',
			'fechaRegistro' => 'Fecha de registro',
			'idcolor' => 'Color',
			'idpropiedad' => 'Propiedad',
			'KmInicial' => 'Kilometraje inicial',
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
		$criteria->compare('numeroUnidad',$this->numeroUnidad);
		$criteria->compare('serialCarroceria',$this->serialCarroceria,true);
		$criteria->compare('serialMotor',$this->serialMotor,true);
		$criteria->compare('placa',$this->placa,true);
		$criteria->compare('anno',$this->anno);
		$criteria->compare('nroPuestos',$this->nroPuestos);
		$criteria->compare('nroEjes',$this->nroEjes);
		$criteria->compare('capCarga',$this->capCarga);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('cantidadRuedas',$this->cantidadRuedas);
		$criteria->compare('capTanque',$this->capTanque);
		$criteria->compare('idmodelo',$this->idmodelo);
		$criteria->compare('idgrupo',$this->idgrupo);
		$criteria->compare('idcombustible',$this->idcombustible);
		$criteria->compare('fechaRegistro',$this->fechaRegistro,true);
		$criteria->compare('idcolor',$this->idcolor);
		$criteria->compare('idpropiedad',$this->idpropiedad);
		$criteria->compare('fechaRegistro',$this->fechaRegistro,true);
		$criteria->compare('KmInicial',$this->KmInicial);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vehiculo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
