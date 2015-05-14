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
 * @property integer $idgrupo
 * @property integer $idprioridad
 * @property integer $idtiempod
 * @property integer $idtiempof
 *
 * The followings are the available model relations:
 * @property SguActividades[] $sguActividades
 * @property SguPrioridad $idprioridad0
 * @property SguTiempo $idtiempod0
 * @property SguTiempo $idtiempof0
 * @property SguPlangrupo $idgrupo0
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
	public function totalRecursos($id){
		$total=Yii::app()->db->createCommand('select count(*) as total from sgu_actividadesGrupo ag, sgu_actividadRecursoGrupo arg where arg.idactividadesGrupo=ag.id and ag.id="'.$id.'"')->queryRow();
		return $total["total"];
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idactividadMtto, frecuenciaKm,frecuenciaMes, duracion, idgrupo, idprioridad, idtiempod, idtiempof, duracion', 'required'),
			array('frecuenciaKm, frecuenciaMes, duracion, diasParo, idgrupo, idprioridad, idtiempod, idtiempof', 'numerical', 'integerOnly'=>true),
			array('procedimiento', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,procedimiento, frecuenciaKm, frecuenciaMes, frecuencia, duracion, diasParo, idgrupo, idprioridad, idtiempod, idtiempof,idactividadMtto', 'safe', 'on'=>'search'),
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
			'idgrupo0' => array(self::BELONGS_TO, 'Grupo', 'idgrupo'),
			'Actividadrecursogrupos' => array(self::HAS_MANY, 'Actividadrecursogrupo', 'idactividadesGrupo'),
			'idactividadMtto0' => array(self::BELONGS_TO, 'Actividadmtto', 'idactividadMtto'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'procedimiento' => 'Procedimiento',
			'frecuenciaKm' => 'Frecuencia',
			'frecuenciaMes' => 'o máximo cada',
			'duracion' => 'Duración',
			'diasParo' => 'Dias Paro',
			'idgrupo' => 'Idgrupo',
			'idprioridad' => 'Prioridad',
			'idtiempod' => 'Idtiempod',
			'idtiempof' => 'Idtiempof',
			'idactividadMtto' => 'Actividad',
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
	public function beforeValidate() {
        if($this->idactividadMtto==""){
            $this->addErrors(array(
            	'idactividadMtto'=>'Seleccione almenos una actividad',
            ));
        }
        if($this->frecuenciaMes==""){
            $this->addErrors(array(
            	'frecuenciaMes'=>'Periodo no puede ser nulo',
            ));
        }
        return parent::beforeValidate();
    }	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idactividadMtto',$this->idactividadMtto);
		$criteria->compare('frecuenciaKm',$this->frecuenciaKm);
		$criteria->compare('frecuenciaMes',$this->frecuenciaMes);
		$criteria->compare('procedimiento',$this->procedimiento,true);
		$criteria->compare('duracion',$this->duracion);
		$criteria->compare('diasParo',$this->diasParo);
		$criteria->compare('idgrupo',$this->idgrupo);
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
