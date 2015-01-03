<?php

/**
 * This is the model class for table "sgu_combust".
 *
 * The followings are the available columns in table 'sgu_combust':
 * @property integer $id
 * @property string $tipo
 * @property double $costoLitro
 * @property integer $idtipoCombustible
 *
 * The followings are the available model relations:
 * @property SguTipocombustible $idtipoCombustible0
 */
class Combust extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_combust';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo, costoLitro, idtipoCombustible', 'required'),
			array('idtipoCombustible', 'numerical', 'integerOnly'=>true),
			array('costoLitro', 'numerical'),
			array('tipo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipo, costoLitro, idtipoCombustible', 'safe', 'on'=>'search'),
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
			'idtipoCombustible0' => array(self::BELONGS_TO, 'Tipocombustible', 'idtipoCombustible'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipo' => 'Detalle',
			'costoLitro' => 'Costo x litro',
			'idtipoCombustible' => 'Tipo de combustible',
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
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('costoLitro',$this->costoLitro);
		$criteria->compare('idtipoCombustible',$this->idtipoCombustible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Combust the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}