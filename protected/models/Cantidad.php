<?php

/**
 * This is the model class for table "sgu_cantidad".
 *
 * The followings are the available columns in table 'sgu_cantidad':
 * @property integer $id
 * @property string $codigoPiezaEnUso
 * @property string $detallePieza
 * @property string $fechaIncorporacion
 * @property integer $idCaracteristicaVeh
 *
 * The followings are the available model relations:
 * @property SguCaracteristicaveh $idCaracteristicaVeh0
 */
class Cantidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_Cantidad';
	}
		public function estadoRepuesto($id){
		if($id==0)
			return "No definido";
		if($id==1)
			return "Montado";
		if($id==2)
			return "Historico";
	}
	public function diasUltimoEvento(){

		$dias=((strtotime(date("Y-m-d"))-strtotime($this->fechaIncorporacion))/86400);
		if($this->estado==0)
			return $this->eventoRepuesto();
		if($this->estado==3)
			return $this->eventoRepuesto().': Efectuandose';
		if($dias==0)
			return $this->eventoRepuesto().': Hoy';
		if($dias==1)
			return $this->eventoRepuesto().': Ayer';
		if($dias==2)
			return $this->eventoRepuesto().': hace '.$dias.' día';
		if($dias>=3)
			return $this->eventoRepuesto().': hace '.$dias.' días';

		
	}
	public function eventoRepuesto(){
		if($this->evento==0)
			return "No definido";
		if($this->evento==1)
			return "Cambio";
		if($this->evento==2)
			return "Reparación";
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCaracteristicaVeh,fechaIncorporacion,estado,evento', 'required'),
			array('idCaracteristicaVeh,estado,evento', 'numerical', 'integerOnly'=>true),
			array('codigoPiezaEnUso, detallePieza', 'length', 'max'=>100),
			//array('fechaIncorporacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigoPiezaEnUso, detallePieza, fechaIncorporacion, idCaracteristicaVeh', 'safe', 'on'=>'search'),
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
			'idCaracteristicaVeh0' => array(self::BELONGS_TO, 'Caracteristicaveh', 'idCaracteristicaVeh'),
			'anterior'=>array(self::BELONGS_TO, 'Cantidad', 'anterior'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigoPiezaEnUso' => 'Codigo',
			'detallePieza' => 'Detalle de repuesto',
			'fechaIncorporacion' => 'Fecha de evento',
			'idCaracteristicaVeh' => 'Id Caracteristica Veh',
			'estado'=>'Estado',
			'evento'=>'Evento',
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
		$criteria->compare('codigoPiezaEnUso',$this->codigoPiezaEnUso,true);
		$criteria->compare('detallePieza',$this->detallePieza,true);
		$criteria->compare('fechaIncorporacion',$this->fechaIncorporacion,true);
		$criteria->compare('idCaracteristicaVeh',$this->idCaracteristicaVeh);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cantidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
