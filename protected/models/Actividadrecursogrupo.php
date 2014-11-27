<?php

/**
 * This is the model class for table "sgu_actividadrecursogrupo".
 *
 * The followings are the available columns in table 'sgu_actividadrecursogrupo':
 * @property integer $id
 * @property integer $cantidad
 * @property integer $idactividadesGrupo
 * @property integer $idinsumo
 * @property integer $idprovServ
 * @property integer $idrepuesto
 * @property integer $idunidad
 * @property string $detalle
 *
 * The followings are the available model relations:
 * @property SguActividadesgrupo $idactividadesGrupo0
 * @property SguInsumo $idinsumo0
 * @property SguProvserv $idprovServ0
 * @property SguRepuesto $idrepuesto0
 * @property SguUnidad $idunidad0
 */
class Actividadrecursogrupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_actividadRecursoGrupo';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidad, idactividadesGrupo, idunidad', 'required'),
			array('cantidad, idactividadesGrupo, idinsumo, idservicio, idrepuesto, idunidad', 'numerical', 'integerOnly'=>true),
			array('detalle', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cantidad, idactividadesGrupo, idinsumo, idservicio, idrepuesto, idunidad, detalle', 'safe', 'on'=>'search'),
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
			'idinsumo0' => array(self::BELONGS_TO, 'Insumo', 'idinsumo'),
			'idservicio0' => array(self::BELONGS_TO, 'Servicio', 'idservicio'),
			'idrepuesto0' => array(self::BELONGS_TO, 'Repuesto', 'idrepuesto'),
			'idunidad0' => array(self::BELONGS_TO, 'Unidad', 'idunidad'),
			'sguActividadrecursos' => array(self::HAS_MANY, 'Actividadrecurso', 'idactividadRecursoGrupo'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cantidad' => 'Cantidad',
			'idactividadesGrupo' => 'Idactividades Grupo',
			'idinsumo' => 'Insumo',
			'idservicio' => 'Servicio',
			'idrepuesto' => 'Repuesto',
			'idunidad' => 'Unidad',
			'detalle' => 'Información adicional',
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
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('idactividadesGrupo',$this->idactividadesGrupo);
		$criteria->compare('idinsumo',$this->idinsumo);
		$criteria->compare('idservicio',$this->idservicio);
		$criteria->compare('idrepuesto',$this->idrepuesto);
		$criteria->compare('idunidad',$this->idunidad);
		$criteria->compare('detalle',$this->detalle,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividadrecursogrupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
