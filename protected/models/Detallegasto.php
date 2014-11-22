<?php

/**
 * This is the model class for table "sgu_detallegasto".
 *
 * The followings are the available columns in table 'sgu_detallegasto':
 * @property integer $id
 * @property string $material
 * @property double $costoUnitario
 * @property integer $cantidad
 * @property double $total
 * @property integer $iddetalleAct
 *
 * The followings are the available model relations:
 * @property SguDetalleact $iddetalleAct0
 */
class Detallegasto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_detalleGasto';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('material, costoUnitario, cantidad, total, iddetalleAct', 'required'),
			array('cantidad, iddetalleAct', 'numerical', 'integerOnly'=>true),
			array('costoUnitario, total', 'numerical'),
			array('material', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, material, costoUnitario, cantidad, total, iddetalleAct', 'safe', 'on'=>'search'),
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
			'iddetalleAct0' => array(self::BELONGS_TO, 'Detalleact', 'iddetalleAct'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'material' => 'Material',
			'costoUnitario' => 'Costo Unitario',
			'cantidad' => 'Cantidad',
			'total' => 'Total',
			'iddetalleAct' => 'Iddetalle Act',
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

	
		$criteria->compare('material',$this->material,true);
		$criteria->compare('costoUnitario',$this->costoUnitario);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('total',$this->total);
		$criteria->compare('iddetalleAct',$this->iddetalleAct);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detallegasto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
