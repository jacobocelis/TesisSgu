<?php

/**
 * This is the model class for table "sgu_detalleorden".
 *
 * The followings are the available columns in table 'sgu_detalleorden':
 * @property integer $id
 * @property integer $idordenMtto
 * @property integer $idactividades
 *
 * The followings are the available model relations:
 * @property SguDetalleact[] $sguDetalleacts
 * @property SguActividades $idactividades0
 * @property SguOrdenmtto $idordenMtto0
 */
class Detalleorden extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_detalleOrden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idordenMtto, idactividades', 'required'),
			array('idordenMtto, idactividades', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idordenMtto, idactividades', 'safe', 'on'=>'search'),
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
			'sguFacturaacts' => array(self::HAS_MANY, 'Facturaact', 'iddetalleOrden'),
			'idactividades0' => array(self::BELONGS_TO, 'Actividades', 'idactividades'),
			'idordenMtto0' => array(self::BELONGS_TO, 'Ordenmtto', 'idordenMtto'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idordenMtto' => 'Idorden Mtto',
			'idactividades' => 'Idactividades',
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
		$criteria->compare('idordenMtto',$this->idordenMtto);
		$criteria->compare('idactividades',$this->idactividades);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detalleorden the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
