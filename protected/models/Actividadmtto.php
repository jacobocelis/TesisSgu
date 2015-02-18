<?php

/**
 * This is the model class for table "sgu_actividadmtto".
 *
 * The followings are the available columns in table 'sgu_actividadmtto':
 * @property integer $id
 * @property string $actividad
 *
 * The followings are the available model relations:
 * @property SguActividades[] $sguActividades
 * @property SguActividadesgrupo[] $sguActividadesgrupos
 */
class Actividadmtto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_actividadMtto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('actividad', 'required'),
			array('actividad', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('actividad', 'safe', 'on'=>'search'),
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
			'sguActividades' => array(self::HAS_MANY, 'Actividades', 'idactividadMtto'),
			'sguActividadesgrupos' => array(self::HAS_MANY, 'Actividadesgrupo', 'idactividadMtto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'actividad' => 'Nueva actividad',
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
		$criteria->compare('actividad',$this->actividad,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividadmtto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
