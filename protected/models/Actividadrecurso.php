<?php

/**
 * This is the model class for table "sgu_actividadrecurso".
 *
 * The followings are the available columns in table 'sgu_actividadrecurso':
 * @property integer $id
 * @property integer $cantidad
 * @property integer $idactividades
 * @property integer $idinsumo
 * @property integer $idrepuesto
 * @property integer $idservicio
 * @property integer $idunidad
 * @property string $detalle
 * @property integer $idactividadRecursoGrupo
 * @property double $costoUnitario
 * @property double $costoTotal
 *
 * The followings are the available model relations:
 * @property SguActividadrecursogrupo $idactividadRecursoGrupo0
 * @property SguActividades $idactividades0
 * @property SguInsumo $idinsumo0
 * @property SguRepuesto $idrepuesto0
 * @property SguServicio $idservicio0
 * @property SguUnidad $idunidad0
 */
class Actividadrecurso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_actividadRecurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidad, idactividades, idunidad,costoUnitario', 'required'),
			array('cantidad, idactividades, idinsumo, idrepuesto, idservicio, idunidad, idactividadRecursoGrupo', 'numerical', 'integerOnly'=>true),
			array('costoUnitario, costoTotal', 'numerical'),
			array('detalle', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, idactividades, idinsumo, idrepuesto, idservicio, idunidad, detalle, idactividadRecursoGrupo, costoUnitario, costoTotal', 'safe', 'on'=>'search'),
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
			'idactividadRecursoGrupo0' => array(self::BELONGS_TO, 'Actividadrecursogrupo', 'idactividadRecursoGrupo'),
			'idactividades0' => array(self::BELONGS_TO, 'Actividades', 'idactividades'),
			'idinsumo0' => array(self::BELONGS_TO, 'Insumo', 'idinsumo'),
			'idrepuesto0' => array(self::BELONGS_TO, 'Repuesto', 'idrepuesto'),
			'idservicio0' => array(self::BELONGS_TO, 'Servicio', 'idservicio'),
			'idunidad0' => array(self::BELONGS_TO, 'Unidad', 'idunidad'),
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
			'idactividades' => 'Actividades',
			'idinsumo' => 'Insumo',
			'idrepuesto' => 'Repuesto',
			'idservicio' => 'Servicio',
			'idunidad' => 'Unidad',
			'detalle' => 'Detalle',
			'idactividadRecursoGrupo' => 'Idactividad Recurso Grupo',
			'costoUnitario' => 'Costo unitario',
			'costoTotal' => 'Costo total',
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
		$criteria->compare('idactividades',$this->idactividades);
		$criteria->compare('idinsumo',$this->idinsumo);
		$criteria->compare('idrepuesto',$this->idrepuesto);
		$criteria->compare('idservicio',$this->idservicio);
		$criteria->compare('idunidad',$this->idunidad);
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('idactividadRecursoGrupo',$this->idactividadRecursoGrupo);
		$criteria->compare('costoUnitario',$this->costoUnitario);
		$criteria->compare('costoTotal',$this->costoTotal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividadrecurso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
