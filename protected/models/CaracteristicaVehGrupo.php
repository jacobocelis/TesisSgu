<?php

/**
 * This is the model class for table "sgu_caracteristicavehgrupo".
 *
 * The followings are the available columns in table 'sgu_caracteristicavehgrupo':
 * @property integer $id
 * @property integer $cantidad
 * @property integer $idgrupo
 * @property integer $idrepuesto
 *
 * The followings are the available model relations:
 * @property SguGrupo $idgrupo0
 * @property SguRepuesto $idrepuesto0
 */
class CaracteristicaVehGrupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_CaracteristicaVehGrupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idgrupo, idrepuesto', 'required'),
			array('cantidad, idgrupo, idrepuesto', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, idgrupo, idrepuesto', 'safe', 'on'=>'search'),
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
			'idgrupo0' => array(self::BELONGS_TO, 'Grupo', 'idgrupo'),
			'idrepuesto0' => array(self::BELONGS_TO, 'Repuesto', 'idrepuesto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'Cantidad',
			'idgrupo' => 'Idgrupo',
			'idrepuesto' => 'Idrepuesto',
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
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('idgrupo',$this->idgrupo);
		$criteria->compare('idrepuesto',$this->idrepuesto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Caracteristicavehgrupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
