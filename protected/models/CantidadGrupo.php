<?php

/**
 * This is the model class for table "sgu_cantidadgrupo".
 *
 * The followings are the available columns in table 'sgu_cantidadgrupo':
 * @property integer $id
 * @property string $detallePieza
 * @property integer $idCaracteristicaVehGrupo
 *
 * The followings are the available model relations:
 * @property SguCaracteristicavehgrupo $idCaracteristicaVehGrupo0
 */
class CantidadGrupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_CantidadGrupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, idCaracteristicaVehGrupo', 'required'),
			array('id, idCaracteristicaVehGrupo', 'numerical', 'integerOnly'=>true),
			array('detallePieza', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, detallePieza, idCaracteristicaVehGrupo', 'safe', 'on'=>'search'),
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
			'idCaracteristicaVehGrupo0' => array(self::BELONGS_TO, 'Caracteristicavehgrupo', 'idCaracteristicaVehGrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'detallePieza' => 'Detalle Pieza',
			'idCaracteristicaVehGrupo' => 'Id Caracteristica Veh Grupo',
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
		$criteria->compare('detallePieza',$this->detallePieza,true);
		$criteria->compare('idCaracteristicaVehGrupo',$this->idCaracteristicaVehGrupo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cantidadgrupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
