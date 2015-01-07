<?php

/**
 * This is the model class for table "sgu_chasis".
 *
 * The followings are the available columns in table 'sgu_chasis':
 * @property integer $id
 * @property string $nombre
 * @property integer $nroEjes
 * @property integer $cantidadNormales
 * @property integer $cantidadRepuesto
 *
 * The followings are the available model relations:
 * @property SguAsigchasis[] $sguAsigchasises
 * @property SguDetalleeje[] $sguDetalleejes
 */
class Chasis extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_chasis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, nroEjes, cantidadNormales, cantidadRepuesto', 'required'),
			array('nroEjes, cantidadNormales, cantidadRepuesto', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, nroEjes, cantidadNormales, cantidadRepuesto', 'safe', 'on'=>'search'),
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
			'sguAsigchasises' => array(self::HAS_MANY, 'Asigchasis', 'idchasis'),
			'sguDetalleejes' => array(self::HAS_MANY, 'Detalleeje', 'idchasis'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'nroEjes' => 'Total de ejes',
			'cantidadNormales' => 'Total de neumáticos en uso',
			'cantidadRepuesto' => 'Total neumáticos de repuesto',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('nroEjes',$this->nroEjes);
		$criteria->compare('cantidadNormales',$this->cantidadNormales);
		$criteria->compare('cantidadRepuesto',$this->cantidadRepuesto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Chasis the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
