<?php

/**
 * This is the model class for table "sgu_provserv".
 *
 * The followings are the available columns in table 'sgu_provserv':
 * @property integer $id
 * @property integer $idservicio
 * @property integer $idproveedor
 *
 * The followings are the available model relations:
 * @property SguActividadrecurso[] $sguActividadrecursos
 * @property SguActividadrecursogrupo[] $sguActividadrecursogrupos
 * @property SguProveedor $idproveedor0
 * @property SguServicio $idservicio0
 */
class Provserv extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_provserv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, idservicio, idproveedor', 'required'),
			array('id, idservicio, idproveedor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idservicio, idproveedor', 'safe', 'on'=>'search'),
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
			'sguActividadrecursos' => array(self::HAS_MANY, 'Actividadrecurso', 'idprovServ'),
			'sguActividadrecursogrupos' => array(self::HAS_MANY, 'Actividadrecursogrupo', 'idprovServ'),
			'idproveedor0' => array(self::BELONGS_TO, 'Proveedor', 'idproveedor'),
			'idservicio0' => array(self::BELONGS_TO, 'Servicio', 'idservicio'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idservicio' => 'Idservicio',
			'idproveedor' => 'Idproveedor',
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
		$criteria->compare('idservicio',$this->idservicio);
		$criteria->compare('idproveedor',$this->idproveedor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Provserv the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
