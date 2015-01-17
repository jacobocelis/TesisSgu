<?php

/**
 * This is the model class for table "sgu_detordneumatico".
 *
 * The followings are the available columns in table 'sgu_detordneumatico':
 * @property integer $id
 * @property integer $idordenMtto
 * @property integer $iddetalleEventoCa
 *
 * The followings are the available model relations:
 * @property Detalleeventoca $iddetalleEventoCa0
 * @property Ordenmtto $idordenMtto0
 */
class Detordneumatico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_detOrdNeumatico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idordenMtto, iddetalleEventoCa', 'required'),
			array('idordenMtto, iddetalleEventoCa', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idordenMtto, iddetalleEventoCa', 'safe', 'on'=>'search'),
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
			'iddetalleEventoCa0' => array(self::BELONGS_TO, 'Detalleeventoca', 'iddetalleEventoCa'),
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
			'iddetalleEventoCa' => 'Iddetalle Evento Ca',
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
		$criteria->compare('iddetalleEventoCa',$this->iddetalleEventoCa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detordneumatico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
