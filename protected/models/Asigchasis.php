<?php

/**
 * This is the model class for table "sgu_asigchasis".
 *
 * The followings are the available columns in table 'sgu_asigchasis':
 * @property integer $id
 * @property integer $idchasis
 * @property integer $idgrupo
 *
 * The followings are the available model relations:
 * @property SguChasis $idchasis0
 * @property SguGrupo $idgrupo0
 */
class Asigchasis extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_asigChasis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idchasis, idgrupo', 'required'),
			array('idchasis, idgrupo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idchasis, idgrupo', 'safe', 'on'=>'search'),
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
			'idchasis0' => array(self::BELONGS_TO, 'Chasis', 'idchasis'),
			'idgrupo0' => array(self::BELONGS_TO, 'Grupo', 'idgrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idchasis' => 'Idchasis',
			'idgrupo' => 'Grupo',
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
		$criteria->compare('idchasis',$this->idchasis);
		$criteria->compare('idgrupo',$this->idgrupo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asigchasis the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
