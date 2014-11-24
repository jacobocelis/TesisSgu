<?php

/**
 * This is the model class for table "sgu_detalleact".
 *
 * The followings are the available columns in table 'sgu_detalleact':
 * @property integer $id
 * @property integer $idfactura
 * @property integer $iddetallleOrden
 *
 * The followings are the available model relations:
 * @property SguDetallleorden $iddetallleOrden0
 * @property SguFactura $idfactura0
 * @property SguDetallegasto[] $sguDetallegastos
 */
class Detalleact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_detalleAct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idfactura, iddetallleOrden', 'required'),
			array('idfactura, iddetallleOrden', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idfactura, iddetallleOrden', 'safe', 'on'=>'search'),
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
			'iddetallleOrden0' => array(self::BELONGS_TO, 'Detalleorden', 'iddetalleOrden'),
			'idfactura0' => array(self::BELONGS_TO, 'Factura', 'idfactura'),
			'sguDetallegastos' => array(self::HAS_MANY, 'Detallegasto', 'iddetalleAct'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idfactura' => 'Idfactura',
			'iddetallleOrden' => 'Iddetallle Orden',
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
		$criteria->compare('idfactura',$this->idfactura);
		$criteria->compare('iddetallleOrden',$this->iddetallleOrden);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detalleact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
