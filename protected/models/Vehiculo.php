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
	public $estatus;
	public $tipo;
	
	public function tableName()
	{
		return 'sgu_vehiculo';
	}
	public function setEstado($estado,$motivo){
		$model = new Historicoedos;
		$model->idestado=$estado;
		$model->idvehiculo=$this->id;
		$model->motivo=$motivo;
		$model->fecha=date("Y-m-d");
		return $model->save();
	}
	public function getEstado($id){
		
		$estado=Yii::app()->db->createCommand("select he.idestado, e.estado from sgu_historicoEdos he, sgu_estado e where e.id=he.idestado and he.idvehiculo=".$id." order by he.id desc limit 1")->queryRow();
		if($estado["idestado"]=='1')
			return '<div style="color:green"><b>'.$estado["estado"].'</b></div>';
		if($estado["idestado"]=='2')
			return '<div style="color:red"><b>'.$estado["estado"].'</b></div>';
		if($estado["idestado"]=='3')
			return '<div style="color:orange"><b>'.$estado["estado"].'</b></div>';
		if($estado["idestado"]=='4')
			return '<div style="color:grey"><b>'.$estado["estado"].'</b></div>';
	}
	public function totalGastos($data)
	{
		$total=0;
		foreach($data as $dat){
			$orden=Detalleorden::model()->find('idactividades='.$dat['idactividades'].'');
			$factura=Factura::model()->find('idordenMtto='.$orden->idordenMtto.'');
			$total=$total+($dat["costoTotal"]+($dat["costoTotal"]*($factura->iva/$factura->total)));
		}
			
		return $total;
	}
	public function totalGastosCo($data)
	{
		$total=0;
		foreach($data as $dat){
			$orden=Detalleordenco::model()->find('idreporteFalla='.$dat['idreporteFalla'].'');
			$factura=Factura::model()->find('idordenMtto='.$orden->idordenMtto.'');
			$total=$total+($dat["costoTotal"]+($dat["costoTotal"]*($factura->iva/$factura->total)));
		}
			
		return $total;
	}
	public function totalGastosNeumatico($data){
		$total=0;
		foreach($data as $dat){
			$orden=Detordneumatico::model()->find('iddetalleEventoCa='.$dat['iddetalleEventoCa'].'');
			$factura=Factura::model()->find('idordenMtto='.$orden->idordenMtto.'');
			$total=$total+($dat["costoTotal"]+($dat["costoTotal"]*($factura->iva/$factura->total)));
		}
			
		return $total;
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numeroUnidad, nroPuestos,serialCarroceria,serialMotor, placa, anno , idmodelo, idgrupo, idcombustible, idcolor,idpropiedad,KmInicial', 'required'),
			array('numeroUnidad, anno, nroPuestos, idmodelo, idgrupo, idcombustible,idcolor,idpropiedad,KmInicial', 'numerical', 'integerOnly'=>true),
			array('serialCarroceria', 'length', 'max'=>45),
			array('placa', 'length', 'max'=>7),
			array('comentario', 'length', 'max'=>200),
			array('estatus,tipo', 'safe', 'on'=>'search'),
			array('numeroUnidad','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, numeroUnidad, serialCarroceria, serialChasis, placa, anno, nroPuestos, idmodelo, idgrupo, idcombustible,idcolor,idpropiedad, idtipo,', 'safe', 'on'=>'search'),
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
			'idcombustible0' => array(self::BELONGS_TO, 'Tipocombustible', 'idcombustible'),
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
			'sguReportefallas' => array(self::HAS_MANY,'Reportefalla', 'idvehiculo'),
			
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function getVehiculosPorEstatus($idestatus){
		return '(select idvehiculo as id from (select * from (select h.idestado as idestado,v.id as idvehiculo from sgu_vehiculo v, sgu_historicoEdos h where v.id=h.idvehiculo  order by h.id desc) as uno group by uno.idvehiculo) as dos where dos.idestado='.$idestatus.')';
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numeroUnidad' => 'Número de unidad',
			'serialCarroceria' => 'Serial de carroceria',
			'serialMotor' => 'Serial de motor',
			'placa' => 'Placa',
			'anno' => 'Año',
			//'nroPuestos' => 'Número de puestos',
			//'nroEjes' => 'Número de ejes',
			//'capCarga' => 'Capacidad de carga',
			'comentario' => 'Comentarios',
			//'cantidadRuedas' => 'Cantidad de ruedas',
			//'capTanque' => 'Capacidad de tanque',	
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
	{	//$criteria->compare('fechaRegistro',$this->fechaRegistro,true);
		//$criteria->compare('KmInicial',$this->KmInicial);
		//$criteria->compare('nroPuestos',$this->nroPuestos);
		//$criteria->compare('nroEjes',$this->nroEjes);
		//$criteria->compare('capCarga',$this->capCarga);
		//$criteria->compare('comentario',$this->comentario,true);
		//$criteria->compare('cantidadRuedas',$this->cantidadRuedas);
		//$criteria->compare('capTanque',$this->capTanque);
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
	
		$criteria->compare('numeroUnidad',$this->numeroUnidad);
		$criteria->compare('serialCarroceria',$this->serialCarroceria,true);
		$criteria->compare('serialMotor',$this->serialMotor,true);
		$criteria->compare('placa',$this->placa,true);
		$criteria->compare('anno',$this->anno);
		$criteria->compare('nroPuestos',$this->nroPuestos);
		//$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('idmodelo',$this->idmodelo);
		$criteria->compare('idcombustible',$this->idcombustible);
		$criteria->compare('idgrupo',$this->idgrupo);
		$criteria->compare('idcolor',$this->idcolor);
		$criteria->compare('idpropiedad',$this->idpropiedad);
		$criteria->addCondition('id not in '.$this->getVehiculosPorEstatus(4).'');
		//para filtrar tipo
		if($this->tipo<>"")
			$criteria->addCondition('idgrupo in(select id from sgu_grupo where idtipo="'.$this->tipo.'") ');
		
		if($this->estatus<>"")
			$criteria->addCondition('id in '.$this->getVehiculosPorEstatus($this->estatus).'');
		
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
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
