<?php

/**
 * This is the model class for table "sgu_detreccaucho".
 *
 * The followings are the available columns in table 'sgu_detreccaucho':
 * @property integer $id
 * @property integer $cantidad
 * @property double $costoUnitario
 * @property double $costoTotal
 * @property integer $idrecursoCaucho
 * @property integer $iddetalleEventoCa
 * @property integer $idunidad
 *
 * The followings are the available model relations:
 * @property Detalleeventoca $iddetalleEventoCa0
 * @property Recursocaucho $idrecursoCaucho0
 * @property Unidad $idunidad0
 */
class Detreccaucho extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_detRecCaucho';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidad, costoUnitario, costoTotal, idrecursoCaucho, iddetalleEventoCa, idunidad', 'required'),
			array('cantidad, idrecursoCaucho, iddetalleEventoCa, idunidad', 'numerical', 'integerOnly'=>true),
			array('costoUnitario, costoTotal, iva', 'numerical'),
			array('costoUnitario', 'validarCosto'),
			array('cantidad', 'validarCantidad'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, costoUnitario, costoTotal, idrecursoCaucho, iddetalleEventoCa, idunidad', 'safe', 'on'=>'search'),
		);
	}
	public function validarCosto(){
                if($this->costoUnitario<=0){
                    $this->addError('costoUnitario', 'Costo unitario debe ser mayor a cero');
                }
	}
	public function validarCantidad(){
                if($this->cantidad<=0){
                    $this->addError('cantidad', 'Cantidad debe ser mayor a cero');
                }
	}
	public function iva(){
		
		$orden=Detordneumatico::model()->find('iddetalleEventoCa='.$this->iddetalleEventoCa.'');
		$factura=Factura::model()->find('idordenMtto='.$orden->idordenMtto.'');
		return $this->costoTotal*($factura->iva/$factura->total); 
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'iddetalleEventoCa0' => array(self::BELONGS_TO, 'Detalleeventoca', 'iddetalleEventoCa'),
			'idrecursoCaucho0' => array(self::BELONGS_TO, 'Recursocaucho', 'idrecursoCaucho'),
			'idunidad0' => array(self::BELONGS_TO, 'Unidad', 'idunidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'Cantidad',
			'costoUnitario' => 'Costo Unitario',
			'costoTotal' => 'Costo Total',
			'idrecursoCaucho' => 'Recurso',
			'iddetalleEventoCa' => 'Iddetalle Evento Ca',
			'idunidad' => 'Idunidad',
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
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('costoUnitario',$this->costoUnitario);
		$criteria->compare('costoTotal',$this->costoTotal);
		$criteria->compare('idrecursoCaucho',$this->idrecursoCaucho);
		$criteria->compare('iddetalleEventoCa',$this->iddetalleEventoCa);
		$criteria->compare('idunidad',$this->idunidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detreccaucho the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
