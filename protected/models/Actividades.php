<?php

/**
 * This is the model class for table "sgu_actividades".
 *
 * The followings are the available columns in table 'sgu_actividades':
 * @property integer $id
 * @property string $actividad
 * @property integer $ultimoKm
 * @property string $ultimoFecha
 * @property integer $frecuenciaKm
 * @property integer $frecuenciaMes
 * @property integer $proximoKm
 * @property string $proximoFecha
 * @property integer $duracion
 * @property integer $atraso
 * @property integer $idprioridad
 * @property integer $idplan
 * @property integer $idtiempod
 * @property integer $idtiempof
 * @property integer $idactividadesGrupo
 *
 * The followings are the available model relations:
 * @property SguActividadesgrupo $idactividadesGrupo0
 * @property SguPlan $idplan0
 * @property SguPrioridad $idprioridad0
 * @property SguTiempo $idtiempod0
 * @property SguTiempo $idtiempof0
 */
class Actividades extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function color($id,$estatus){
		if($id==4)
			return '<strong><span style="color:orange">'.$estatus.'</span></strong>';
		if($id==3)
			return '<strong><span style="color:green">'.$estatus.'</span></strong>';
    }
	public function tableName()
	{
		return 'sgu_actividades';
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
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
	
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idactividadMtto, frecuenciaKm, duracion, idprioridad, idplan, idtiempod, idtiempof, idactividadesGrupo,ultimoKm,ultimoFecha,idestatus, fechaRealizada, kmRealizada', 'required'),
			array('ultimoKm, frecuenciaKm, frecuenciaMes, proximoKm, duracion, atraso, idprioridad, idplan, idtiempod, idtiempof, idactividadesGrupo,idestatus, kmRealizada,', 'numerical', 'integerOnly'=>true),
			array('procedimiento', 'length', 'max'=>200),
			array('ultimoFecha, proximoFecha, fechaRealizada, kmRealizada,', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idactividadMtto, ultimoKm, ultimoFecha, frecuenciaKm, frecuenciaMes, proximoKm, proximoFecha, duracion, atraso, idprioridad, idplan, idtiempod, idtiempof, idactividadesGrupo,idestatus,procedimiento, fechaRealizada, kmRealizada,', 'safe', 'on'=>'search'),
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
			'idactividadesGrupo0' => array(self::BELONGS_TO, 'Actividadesgrupo', 'idactividadesGrupo'),
			'idplan0' => array(self::BELONGS_TO, 'Plan', 'idplan'),
			'idprioridad0' => array(self::BELONGS_TO, 'Prioridad', 'idprioridad'),
			'idtiempod0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempod'),
			'idtiempof0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempof'),
			'idestatus0' => array(self::BELONGS_TO, 'Estatus', 'idestatus'),
			'sguActividadrecursos' => array(self::HAS_MANY, 'Actividadrecurso', 'idactividades'),
			'idactividadesGrupo0' => array(self::BELONGS_TO, 'Actividadesgrupo', 'idactividadesGrupo'),
			'idactividadMtto0' => array(self::BELONGS_TO, 'Actividadmtto', 'idactividadMtto'),
			'sguDetallleordens' => array(self::HAS_MANY, 'Detalleorden', 'idactividades'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'Id',
			'idactividadMtto' => 'Actividad',
			'ultimoKm' => 'Ultimo mantenimiento',
			'ultimoFecha' => 'Fecha del último mantenimiento',
			'frecuenciaKm' => 'Frecuencia Km',
			'frecuenciaMes' => 'Frecuencia Mes',
			'proximoKm' => 'Proximo Km',
			'proximoFecha' => 'Proximo Fecha',
			'duracion' => 'Duracion',
			'atraso' => 'Atraso',
			'idprioridad' => 'Idprioridad',
			'idplan' => 'Idplan',
			'idtiempod' => 'Idtiempod',
			'idtiempof' => 'Idtiempof',
			'idactividadesGrupo' => 'Idactividades Grupo',
			'idestatus' => 'Idestatus',
			'procedimiento' => 'Procedimiento',
			'idactividadMtto' => 'Idactividad Mtto',
			'fechaRealizada' => 'Fecha Realizada',
			'kmRealizada' => 'Km Realizada',
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
		$criteria->compare('idactividadMtto',$this->idactividadMtto);
		$criteria->compare('ultimoKm',$this->ultimoKm);
		$criteria->compare('ultimoFecha',$this->ultimoFecha,true);
		$criteria->compare('frecuenciaKm',$this->frecuenciaKm);
		$criteria->compare('frecuenciaMes',$this->frecuenciaMes);
		$criteria->compare('proximoKm',$this->proximoKm);
		$criteria->compare('proximoFecha',$this->proximoFecha,true);
		$criteria->compare('duracion',$this->duracion);
		$criteria->compare('atraso',$this->atraso);
		$criteria->compare('idprioridad',$this->idprioridad);
		$criteria->compare('idplan',$this->idplan);
		$criteria->compare('idtiempod',$this->idtiempod);
		$criteria->compare('idtiempof',$this->idtiempof);
		$criteria->compare('idactividadesGrupo',$this->idactividadesGrupo);
		$criteria->compare('idestatus',$this->idestatus);
		$criteria->compare('idestatus',$this->idestatus);
		$criteria->compare('idactividadMtto',$this->idactividadMtto);
		$criteria->compare('fechaRealizada',$this->fechaRealizada,true);
		$criteria->compare('kmRealizada',$this->kmRealizada);
		$criteria->compare('procedimiento',$this->procedimiento,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
