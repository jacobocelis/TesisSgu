<?php

/**
 * This is the model class for table "sgu_insumo".
 *
 * The followings are the available columns in table 'sgu_insumo':
 * @property integer $id
 * @property string $insumo
 * @property integer $tipoInsumo
 *
 * The followings are the available model relations:
 * @property SguActividadrecurso[] $sguActividadrecursos
 * @property SguActividadrecursogrupo[] $sguActividadrecursogrupos
 * @property SguTipoinsumo $tipoInsumo0
 */
class Insumo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_insumo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('insumo, tipoInsumo', 'required'),
			array('tipoInsumo', 'numerical', 'integerOnly'=>true),
			array('insumo', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('insumo, tipoInsumo', 'safe', 'on'=>'search'),
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
			'sguActividadrecursos' => array(self::HAS_MANY, 'Actividadrecurso', 'idinsumo'),
			'sguActividadrecursogrupos' => array(self::HAS_MANY, 'Actividadrecursogrupo', 'idinsumo'),
			'tipoInsumo0' => array(self::BELONGS_TO, 'Tipoinsumo', 'tipoInsumo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'insumo' => 'Insumo',
			'tipoInsumo' => 'Tipo',
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
		$criteria->compare('insumo',$this->insumo,true);
		$criteria->compare('tipoInsumo',$this->tipoInsumo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Insumo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
