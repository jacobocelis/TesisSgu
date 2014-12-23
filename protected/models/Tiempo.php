<?php

/**
 * This is the model class for table "sgu_tiempo".
 *
 * The followings are the available columns in table 'sgu_tiempo':
 * @property integer $id
 * @property string $tiempo
 *
 * The followings are the available model relations:
 * @property SguActividades[] $sguActividades
 * @property SguActividades[] $sguActividades1
 * @property SguActividadesgrupo[] $sguActividadesgrupos
 * @property SguActividadesgrupo[] $sguActividadesgrupos1
 */
class Tiempo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_tiempo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tiempo', 'required'),
			array('tiempo', 'length', 'max'=>10),
			array('sqlTimevalues', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tiempo', 'sqlTimevalues', 'safe', 'on'=>'search'),
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
			'sguActividades' => array(self::HAS_MANY, 'Actividades', 'idtiempod'),
			'sguActividades1' => array(self::HAS_MANY, 'Actividades', 'idtiempof'),
			'sguActividadesgrupos' => array(self::HAS_MANY, 'Actividadesgrupo', 'idtiempod'),
			'sguActividadesgrupos1' => array(self::HAS_MANY, 'Actividadesgrupo', 'idtiempof'),
			'sguActividadrecursos' => array(self::HAS_MANY, 'Actividadrecurso', 'idtiempoGarantia'),
			'sguRecursofallas' => array(self::HAS_MANY, 'Recursofalla', 'idtiempo'),
			'sguReportefallas' => array(self::HAS_MANY, 'Reportefalla', 'idtiempo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tiempo' => 'Tiempo',
			'sqlTimevalues' => 'Sql Timevalues',
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
		$criteria->compare('tiempo',$this->tiempo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tiempo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
