<?php

/**
 * This is the model class for table "sgu_grupo".
 *
 * The followings are the available columns in table 'sgu_grupo':
 * @property integer $id
 * @property string $grupo
 * @property string $descripcion
 * @property integer $idtipo
 *
 * The followings are the available model relations:
 * @property SguCaracteristicavehgrupo[] $sguCaracteristicavehgrupos
 * @property SguTipo $idtipo0
 * @property SguGrupoitem[] $sguGrupoitems
 * @property SguInfgrupo[] $sguInfgrupos
 * @property SguVehiculo[] $sguVehiculos
 */
class Grupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grupo, idtipo', 'required'),
			array('idtipo', 'numerical', 'integerOnly'=>true),
			array('grupo, descripcion', 'length', 'max'=>45),
			array('grupo', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, grupo, descripcion, idtipo', 'safe', 'on'=>'search'),
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
			'sguCaracteristicavehgrupos' => array(self::HAS_MANY, 'SguCaracteristicavehgrupo', 'idgrupo'),
			'idtipo0' => array(self::BELONGS_TO, 'Tipo', 'idtipo'),
			'sguGrupoitems' => array(self::HAS_MANY, 'Grupoitem', 'idgrupo'),
			'sguInfgrupos' => array(self::HAS_MANY, 'Infgrupo', 'idgrupo'),
			'sguVehiculos' => array(self::HAS_MANY, 'Vehiculo', 'idgrupo'),
			'sguActividadesgrupos' => array(self::HAS_MANY,'Actividadesgrupo', 'idgrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'grupo' => 'Grupo',
			'descripcion' => 'Descripción',
			'idtipo' => 'Tipo',
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
		$criteria->compare('grupo',$this->grupo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('idtipo',$this->idtipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
