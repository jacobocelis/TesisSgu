<?php

/**
 * This is the model class for table "sgu_ordenmtto".
 *
 * The followings are the available columns in table 'sgu_ordenmtto':
 * @property integer $id
 * @property string $fecha
 * @property string $responsable
 * @property integer $idestatus
 *
 * The followings are the available model relations:
 * @property SguDetalleorden[] $sguDetalleordens
 * @property SguEstatus $idestatus0
 */
class Ordenmtto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function estado($id){
		if($id==5)
			return 0;
		if($id==6)
			return 1;
	}
	public function tableName()
	{
		return 'sgu_ordenMtto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('responsable, idestatus', 'required'),
			array('idestatus', 'numerical', 'integerOnly'=>true),
			array('responsable', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha, responsable, idestatus', 'safe', 'on'=>'search'),
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
			'sguDetalleordens' => array(self::HAS_MANY, 'Detalleorden', 'idordenMtto'),
			'idestatus0' => array(self::BELONGS_TO, 'Estatus', 'idestatus'),
			'sguFacturas' => array(self::HAS_MANY, 'Factura', 'idordenMtto'),
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
			'responsable' => 'Responsable',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('idestatus',$this->idestatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ordenmtto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}