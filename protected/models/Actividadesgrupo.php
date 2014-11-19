<?php

/**
 * This is the model class for table "sgu_actividadesgrupo".
 *
 * The followings are the available columns in table 'sgu_actividadesgrupo':
 * @property integer $id
 * @property string $actividad
 * @property integer $frecuenciaKm
 * @property integer $frecuenciaMes
 * @property string $frecuencia
 * @property integer $duracion
 * @property integer $diasParo
 * @property integer $idplan
 * @property integer $idprioridad
 * @property integer $idtiempod
 * @property integer $idtiempof
 *
 * The followings are the available model relations:
 * @property SguActividades[] $sguActividades
 * @property SguPrioridad $idprioridad0
 * @property SguTiempo $idtiempod0
 * @property SguTiempo $idtiempof0
 * @property SguPlangrupo $idplan0
 */
class Actividadesgrupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_actividadesGrupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('actividad, frecuenciaKm, duracion, idplan, idprioridad, idtiempod, idtiempof', 'required'),
			array('frecuenciaKm, frecuenciaMes, duracion, diasParo, idplan, idprioridad, idtiempod, idtiempof', 'numerical', 'integerOnly'=>true),
			array('actividad', 'length', 'max'=>80),
			array('procedimiento', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, actividad,procedimiento, frecuenciaKm, frecuenciaMes, frecuencia, duracion, diasParo, idplan, idprioridad, idtiempod, idtiempof', 'safe', 'on'=>'search'),
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
			'sguActividades' => array(self::HAS_MANY, 'Actividades', 'idactividadesGrupo'),
			'idprioridad0' => array(self::BELONGS_TO, 'Prioridad', 'idprioridad'),
			'idtiempod0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempod'),
			'idtiempof0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempof'),
			'idplan0' => array(self::BELONGS_TO, 'Plangrupo', 'idplan'),
			'Actividadrecursogrupos' => array(self::HAS_MANY, 'Actividadrecursogrupo', 'idactividadesGrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'actividad' => 'Actividad',
			'procedimiento' => 'Procedimiento',
			'frecuenciaKm' => 'Frecuencia',
			'frecuenciaMes' => 'o máximo cada',
			'duracion' => 'Duración',
			'diasParo' => 'Dias Paro',
			'idplan' => 'Idplan',
			'idprioridad' => 'Prioridad',
			'idtiempod' => 'Idtiempod',
			'idtiempof' => 'Idtiempof',
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
		$criteria->compare('actividad',$this->actividad,true);
		$criteria->compare('frecuenciaKm',$this->frecuenciaKm);
		$criteria->compare('frecuenciaMes',$this->frecuenciaMes);
		$criteria->compare('procedimiento',$this->procedimiento,true);
		$criteria->compare('duracion',$this->duracion);
		$criteria->compare('diasParo',$this->diasParo);
		$criteria->compare('idplan',$this->idplan);
		$criteria->compare('idprioridad',$this->idprioridad);
		$criteria->compare('idtiempod',$this->idtiempod);
		$criteria->compare('idtiempof',$this->idtiempof);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividadesgrupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
