<?php

/**
 * This is the model class for table "sgu_detalleeventoca".
 *
 * The followings are the available columns in table 'sgu_detalleeventoca':
 * @property integer $id
 * @property string $fechaFalla
 * @property string $fechaRealizada
 * @property string $comentario
 * @property integer $idhistoricoCaucho
 * @property integer $idfallaCaucho
 * @property integer $idaccionCaucho
 * @property integer $idestatus
 *
 * The followings are the available model relations:
 * @property Accioncaucho $idaccionCaucho0
 * @property Estatus $idestatus0
 * @property Fallacaucho $idfallaCaucho0
 * @property Historicocaucho $idhistoricoCaucho0
 * @property Detordneumatico[] $detordneumaticos
 */
class Detalleeventoca extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_detalleEventoCa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fechaFalla, fechaRealizada, idhistoricoCaucho, idaccionCaucho, idestatus', 'required'),
			array('idhistoricoCaucho, idfallaCaucho, idaccionCaucho, idestatus,idempleado', 'numerical', 'integerOnly'=>true),
			array('comentario', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fechaFalla, fechaRealizada, comentario, idhistoricoCaucho, idfallaCaucho, idaccionCaucho, idestatus,idempleado', 'safe', 'on'=>'search'),
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
			'idaccionCaucho0' => array(self::BELONGS_TO, 'Accioncaucho', 'idaccionCaucho'),
			'idestatus0' => array(self::BELONGS_TO, 'Estatus', 'idestatus'),
			'idfallaCaucho0' => array(self::BELONGS_TO, 'Fallacaucho', 'idfallaCaucho'),
			'idhistoricoCaucho0' => array(self::BELONGS_TO, 'Historicocaucho', 'idhistoricoCaucho'),
			'detordneumaticos' => array(self::HAS_MANY, 'Detordneumatico', 'iddetalleEventoCa'),
			'idempleado0' => array(self::BELONGS_TO, 'Empleado', 'idempleado'),
		);
	}
	public function beforeValidate() {
		
        if($this->idhistoricoCaucho==null){
            $this->addErrors(array(
            	'idhistoricoCaucho'=>'Error: Debe seleccionar un neumático',
            ));
        }
        return parent::beforeValidate();
    }	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fechaFalla' => 'Fecha de avería',
			'fechaRealizada' => 'Fecha de reparada',
			'comentario' => 'Comentario',
			'idhistoricoCaucho' => 'Neumático averiado',
			'idfallaCaucho' => 'Avería',
			'idaccionCaucho' => 'Acción a realizar',
			'idestatus' => 'Estatus',
			'idempleado' => 'Conductor',
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
		$criteria->compare('fechaFalla',$this->fechaFalla,true);
		$criteria->compare('fechaRealizada',$this->fechaRealizada,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('idhistoricoCaucho',$this->idhistoricoCaucho);
		$criteria->compare('idfallaCaucho',$this->idfallaCaucho);
		$criteria->compare('idaccionCaucho',$this->idaccionCaucho);
		$criteria->compare('idestatus',$this->idestatus);
		$criteria->compare('idempleado',$this->idempleado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detalleeventoca the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
