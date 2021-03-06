<?php

/**
 * This is the model class for table "sgu_historicoedos".
 *
 * The followings are the available columns in table 'sgu_historicoedos':
 * @property integer $id
 * @property integer $idestado
 * @property integer $idvehiculo
 * @property string $fecha
 * @property string $motivo
 *
 * The followings are the available model relations:
 * @property Estado $idestado0
 * @property Vehiculo $idvehiculo0
 */
class Historicoedos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_historicoEdos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idestado, idvehiculo, motivo, fecha', 'required'),
			array('idestado, idvehiculo', 'numerical', 'integerOnly'=>true),
			array('motivo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idestado, idvehiculo, fecha, motivo', 'safe', 'on'=>'search'),
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
			'idestado0' => array(self::BELONGS_TO, 'Estado', 'idestado'),
			'idvehiculo0' => array(self::BELONGS_TO, 'Vehiculo', 'idvehiculo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idestado' => 'Idestado',
			'idvehiculo' => 'Idvehiculo',
			'fecha' => 'Fecha',
			'motivo' => 'Motivo',
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
		$criteria->compare('idestado',$this->idestado);
		$criteria->compare('idvehiculo',$this->idvehiculo);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('motivo',$this->motivo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Historicoedos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
