<?php

/**
 * This is the model class for table "sgu_detallerueda".
 *
 * The followings are the available columns in table 'sgu_detallerueda':
 * @property integer $id
 * @property integer $idposicionRueda
 * @property integer $iddetalleEje
 * @property integer $idcaucho
 *
 * The followings are the available model relations:
 * @property Caucho $idcaucho0
 * @property Detalleeje $iddetalleEje0
 * @property Posicionrueda $idposicionRueda0
 */
class Detallerueda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_detalleRueda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idposicionRueda, iddetalleEje, idcaucho', 'required'),
			array('idposicionRueda, iddetalleEje, idcaucho', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idposicionRueda, iddetalleEje, idcaucho', 'safe', 'on'=>'search'),
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
			'idcaucho0' => array(self::BELONGS_TO, 'Caucho', 'idcaucho'),
			'iddetalleEje0' => array(self::BELONGS_TO, 'Detalleeje', 'iddetalleEje'),
			'idposicionRueda0' => array(self::BELONGS_TO, 'Posicionrueda', 'idposicionRueda'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idposicionRueda' => 'Idposicion Rueda',
			'iddetalleEje' => 'Iddetalle Eje',
			'idcaucho' => 'Idcaucho',
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
		$criteria->compare('idposicionRueda',$this->idposicionRueda);
		$criteria->compare('iddetalleEje',$this->iddetalleEje);
		$criteria->compare('idcaucho',$this->idcaucho);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detallerueda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
