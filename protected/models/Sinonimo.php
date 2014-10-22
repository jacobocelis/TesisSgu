<?php

/**
 * This is the model class for table "sgu_sinonimo".
 *
 * The followings are the available columns in table 'sgu_sinonimo':
 * @property integer $id
 * @property string $sinonimo
 * @property integer $idrepuesto1
 * @property integer $idrepuesto2
 *
 * The followings are the available model relations:
 * @property SguRepuesto $idrepuesto10
 * @property SguRepuesto $idrepuesto20
 */
class Sinonimo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_Sinonimo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sinonimo, idrepuesto1', 'required'),
			array('idrepuesto1, idrepuesto2', 'numerical', 'integerOnly'=>true),
			array('sinonimo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sinonimo, idrepuesto1, idrepuesto2', 'safe', 'on'=>'search'),
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
			'idrepuesto10' => array(self::BELONGS_TO, 'Repuesto', 'idrepuesto1'),
			'idrepuesto20' => array(self::BELONGS_TO, 'Repuesto', 'idrepuesto2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sinonimo' => 'Sinonimo',
			'idrepuesto1' => 'Idrepuesto1',
			'idrepuesto2' => 'Idrepuesto2',
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
		$criteria->compare('sinonimo',$this->sinonimo,true);
		$criteria->compare('idrepuesto1',$this->idrepuesto1);
		$criteria->compare('idrepuesto2',$this->idrepuesto2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sinonimo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
