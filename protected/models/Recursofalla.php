<?php

/**
 * This is the model class for table "sgu_recursofalla".
 *
 * The followings are the available columns in table 'sgu_recursofalla':
 * @property integer $id
 * @property integer $cantidad
 * @property double $costoUnitario
 * @property double $costoTotal
 * @property integer $idinsumo
 * @property integer $idservicio
 * @property integer $idrepuesto
 * @property integer $idreporteFalla
 * @property integer $idunidad
 * @property integer $garantia
 * @property integer $idtiempo
 *
 * The followings are the available model relations:
 * @property SguInsumo $idinsumo0
 * @property SguReportefalla $idreporteFalla0
 * @property SguRepuesto $idrepuesto0
 * @property SguServicio $idservicio0
 * @property SguTiempo $idtiempo0
 * @property SguUnidad $idunidad0
 */
class Recursofalla extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_recursofalla';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidad, idreporteFalla, idunidad', 'required'),
			array('cantidad, idinsumo, idservicio, idrepuesto, idreporteFalla, idunidad, garantia, idtiempo', 'numerical', 'integerOnly'=>true),
			array('costoUnitario, costoTotal', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, costoUnitario, costoTotal, idinsumo, idservicio, idrepuesto, idreporteFalla, idunidad, garantia, idtiempo', 'safe', 'on'=>'search'),
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
			'idinsumo0' => array(self::BELONGS_TO, 'Insumo', 'idinsumo'),
			'idreporteFalla0' => array(self::BELONGS_TO, 'Reportefalla', 'idreporteFalla'),
			'idrepuesto0' => array(self::BELONGS_TO, 'Repuesto', 'idrepuesto'),
			'idservicio0' => array(self::BELONGS_TO, 'Servicio', 'idservicio'),
			'idtiempo0' => array(self::BELONGS_TO, 'Tiempo', 'idtiempo'),
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
			'costoUnitario' => 'Costo Unitario',
			'costoTotal' => 'Costo Total',
			'idinsumo' => 'Insumo',
			'idservicio' => 'Servicio',
			'idrepuesto' => 'Repuesto',
			'idreporteFalla' => 'Idreporte Falla',
			'idunidad' => 'Unidad',
			'garantia' => 'Garantia',
			'idtiempo' => 'Idtiempo',
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
		$criteria->compare('costoUnitario',$this->costoUnitario);
		$criteria->compare('costoTotal',$this->costoTotal);
		$criteria->compare('idinsumo',$this->idinsumo);
		$criteria->compare('idservicio',$this->idservicio);
		$criteria->compare('idrepuesto',$this->idrepuesto);
		$criteria->compare('idreporteFalla',$this->idreporteFalla);
		$criteria->compare('idunidad',$this->idunidad);
		$criteria->compare('garantia',$this->garantia);
		$criteria->compare('idtiempo',$this->idtiempo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recursofalla the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
