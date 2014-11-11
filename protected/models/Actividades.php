<?php

/**
 * This is the model class for table "sgu_actividades".
 *
 * The followings are the available columns in table 'sgu_actividades':
 * @property integer $id
 * @property string $actividad
 * @property integer $ultimoKm
 * @property string $ultimoFecha
 * @property integer $frecuenciaKm
 * @property integer $frecuenciaMes
 * @property integer $proximoKm
 * @property string $proximoFecha
 * @property integer $duracion
 * @property integer $atraso
 * @property integer $idprioridad
 * @property integer $idplan
 * @property integer $idtiempod
 * @property integer $idtiempof
 * @property integer $idactividadesGrupo
 *
 * The followings are the available model relations:
 * @property SguActividadesgrupo $idactividadesGrupo0
 * @property SguPlan $idplan0
 * @property SguPrioridad $idprioridad0
 * @property SguTiempo $idtiempod0
 * @property SguTiempo $idtiempof0
 */
class Actividades extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_actividades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('actividad, frecuenciaKm, duracion, idprioridad, idplan, idtiempod, idtiempof, idactividadesGrupo', 'required'),
			array('ultimoKm, frecuenciaKm, frecuenciaMes, proximoKm, duracion, atraso, idprioridad, idplan, idtiempod, idtiempof, idactividadesGrupo', 'numerical', 'integerOnly'=>true),
			array('actividad', 'length', 'max'=>80),
			array('ultimoFecha, proximoFecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, actividad, ultimoKm, ultimoFecha, frecuenciaKm, frecuenciaMes, proximoKm, proximoFecha, duracion, atraso, idprioridad, idplan, idtiempod, idtiempof, idactividadesGrupo', 'safe', 'on'=>'search'),
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
			'idactividadesGrupo0' => array(self::BELONGS_TO, 'Actividadesgrupo', 'idactividadesGrupo'),
			'idplan0' => array(self::BELONGS_TO, 'Plan', 'idplan'),
			'idprioridad0' => array(self::BELONGS_TO, 'Prioridad', 'idprioridad'),
			'idtiempod0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempod'),
			'idtiempof0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempof'),
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
			'ultimoKm' => 'Ultimo Km',
			'ultimoFecha' => 'Ultimo Fecha',
			'frecuenciaKm' => 'Frecuencia Km',
			'frecuenciaMes' => 'Frecuencia Mes',
			'proximoKm' => 'Proximo Km',
			'proximoFecha' => 'Proximo Fecha',
			'duracion' => 'Duracion',
			'atraso' => 'Atraso',
			'idprioridad' => 'Idprioridad',
			'idplan' => 'Idplan',
			'idtiempod' => 'Idtiempod',
			'idtiempof' => 'Idtiempof',
			'idactividadesGrupo' => 'Idactividades Grupo',
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
		$criteria->compare('ultimoKm',$this->ultimoKm);
		$criteria->compare('ultimoFecha',$this->ultimoFecha,true);
		$criteria->compare('frecuenciaKm',$this->frecuenciaKm);
		$criteria->compare('frecuenciaMes',$this->frecuenciaMes);
		$criteria->compare('proximoKm',$this->proximoKm);
		$criteria->compare('proximoFecha',$this->proximoFecha,true);
		$criteria->compare('duracion',$this->duracion);
		$criteria->compare('atraso',$this->atraso);
		$criteria->compare('idprioridad',$this->idprioridad);
		$criteria->compare('idplan',$this->idplan);
		$criteria->compare('idtiempod',$this->idtiempod);
		$criteria->compare('idtiempof',$this->idtiempof);
		$criteria->compare('idactividadesGrupo',$this->idactividadesGrupo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
