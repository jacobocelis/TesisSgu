<?php

/**
 * This is the model class for table "sgu_posicionrueda".
 *
 * The followings are the available columns in table 'sgu_posicionrueda':
 * @property integer $id
 * @property string $posicionRueda
 *
 * The followings are the available model relations:
 * @property SguDetallerueda[] $sguDetalleruedas
 * @property SguHistoricocaucho[] $sguHistoricocauchos
 */
class Posicionrueda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_posicionRueda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('posicionRueda', 'required'),
			array('posicionRueda', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, posicionRueda', 'safe', 'on'=>'search'),
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
			'sguDetalleruedas' => array(self::HAS_MANY, 'Detallerueda', 'idposicionRueda'),
			'sguHistoricocauchos' => array(self::HAS_MANY, 'Historicocaucho', 'idposicionRueda'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'posicionRueda' => 'Posicion Rueda',
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
		$criteria->compare('posicionRueda',$this->posicionRueda,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Posicionrueda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
