<?php

/**
 * This is the model class for table "sgu_reportefalla".
 *
 * The followings are the available columns in table 'sgu_reportefalla':
 * @property integer $id
 * @property string $detalle
 * @property string $fechaFalla
 * @property string $fechaRealizada
 * @property integer $kmRealizada
 * @property integer $diasParo
 * @property integer $idtiempo
 * @property integer $idvehiculo
 * @property integer $idempleado
 * @property integer $idfalla
 * @property integer $idestatus
 *
 * The followings are the available model relations:
 * @property SguDetalleordenco[] $sguDetalleordencos
 * @property SguRecursofalla[] $sguRecursofallas
 * @property SguEmpleado $idempleado0
 * @property SguEstatus $idestatus0
 * @property SguFalla $idfalla0
 * @property SguTiempo $idtiempo0
 * @property SguVehiculo $idvehiculo0
 */
class Reportefalla extends CActiveRecord
{
	public function color($id,$estatus){
		if($id==4)
			return '<strong><span style="color:orange">'.$estatus.'</span></strong>';
		if($id==3)
			return '<strong><span style="color:green">'.$estatus.'</span></strong>';
    }
	public function noasignado(){
			return '<span style="color:red">no registrado</span>';
    }
	public function valores($id){
		if($id=='0000-01-01'||$id==-1)
			return 0;
		return 1;
    }
	function diasRestantes($fin){
		$datetime1 = new DateTime($fin);
		$datetime2 = new DateTime("now");
		$datetime2=$datetime2->format('Y-m-d');
		$fecha=new DateTime($datetime2);
		$interval = $fecha->diff($datetime1);
			if($interval->format('%R%a')<0)
				return 0;
		return $interval->format('%a');
	}
	function kmRestantes($id,$prox){
		$km=Kilometraje::model()->findAll(array(
			'condition'=>'t.idvehiculo ='.$id.' order by t.id desc limit 1',
		));
		if(($prox-$km[0]["lectura"])<0)
			return 0;
		else
			return $prox-$km[0]["lectura"];
	}
	/*public function porcentaje($ini,$fin){
		$datetime1 = new DateTime($fin);
		$datetime2 = new DateTime("now");
		$interval = $datetime2->diff($datetime1);
		$diasR=$interval->format('%a');
		//dias totales
		$datetime1 = new DateTime($fin);
		$datetime2 = new DateTime($ini);
		$interval = $datetime2->diff($datetime1);
		$diasT=$interval->format('%a');		
		
		return 100-(($diasR/$diasT)*100);
	}*/
	public function atraso($fin){
		$datetime1 = new DateTime($fin);
		$datetime2 = new DateTime("now");
		$interval = $datetime2->diff($datetime1);
		$retraso=$interval->format('%R%a');
		
		if($retraso==-1)
			return $interval->format('%a Día');
		if($retraso<-1)
			return $interval->format('%a Días');
		return "";
	}
	public function atrasoKm($id,$prox){
		$km=Kilometraje::model()->findAll(array(
			'condition'=>'t.idvehiculo ='.$id.' order by t.id desc limit 1',
		));
		if(($prox-$km[0]["lectura"])<0)
			return "+ ".abs($prox-$km[0]["lectura"])." Km";
		else
			return "";
	}
	public function porcentaje($ini,$fin){
		$datetime1 = new DateTime($fin);
		$datetime2 = new DateTime("now");
		$datetime2=$datetime2->format('Y-m-d');
		$fecha=new DateTime($datetime2);
		$interval = $fecha->diff($datetime1);
		
		if($interval->format('%R%a')<0)
			return 100;
		$diasR=$interval->format('%a');
		if($diasR>5)
			return 0;
		else	
			return 100-(($diasR/5)*100);
		
	}
	public function obtColor($restante){
		if($restante<=5)
			return 'F00';
		else
			return '20DA14';
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_reporteFalla';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fechaFalla, diasParo, idtiempo, idvehiculo, idempleado, idfalla, idestatus', 'required'),
			array('kmRealizada, diasParo, idtiempo, idvehiculo, idempleado, idfalla, idestatus', 'numerical', 'integerOnly'=>true),
			array('detalle', 'length', 'max'=>150),
			array('fechaRealizada', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, detalle, fechaFalla, fechaRealizada, kmRealizada, diasParo, idtiempo, idvehiculo, idempleado, idfalla, idestatus', 'safe', 'on'=>'search'),
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
			'sguDetalleordencos' => array(self::HAS_MANY, 'Detalleordenco', 'idreporteFalla'),
			'sguRecursofallas' => array(self::HAS_MANY, 'Recursofalla', 'idreporteFalla'),
			'idempleado0' => array(self::BELONGS_TO, 'Empleado', 'idempleado'),
			'idestatus0' => array(self::BELONGS_TO, 'Estatus', 'idestatus'),
			'idfalla0' => array(self::BELONGS_TO, 'Falla', 'idfalla'),
			'idtiempo0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempo'),
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
			'detalle' => 'Detalle',
			'fechaFalla' => 'Fecha',
			'fechaRealizada' => 'Realizada',
			'kmRealizada' => 'Km Realizada',
			'diasParo' => 'Tiempo de paro',
			'idtiempo' => 'Idtiempo',
			'idvehiculo' => 'Unidad',
			'idempleado' => 'Reportó',
			'idfalla' => 'Falla',
			'idestatus' => 'Estatus',
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
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('fechaFalla',$this->fechaFalla,true);
		$criteria->compare('fechaRealizada',$this->fechaRealizada,true);
		$criteria->compare('kmRealizada',$this->kmRealizada);
		$criteria->compare('diasParo',$this->diasParo);
		$criteria->compare('idtiempo',$this->idtiempo);
		$criteria->compare('idvehiculo',$this->idvehiculo);
		$criteria->compare('idempleado',$this->idempleado);
		$criteria->compare('idfalla',$this->idfalla);
		$criteria->compare('idestatus',$this->idestatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reportefalla the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
