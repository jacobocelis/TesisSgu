<?php

/**
 * This is the model class for table "sgu_rotacioncauchos".
 *
 * The followings are the available columns in table 'sgu_rotacioncauchos':
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property double $costoTotal
 * @property string $fechaRealizada
 * @property integer $idestatus
 *
 * The followings are the available model relations:
 * @property Detalleeventoca[] $detalleeventocas
 * @property Estatus $idestatus0
 */
class Rotacioncauchos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function color($id,$estatus){
		if($id==4)
			return '<strong><span style="color:orange">'.$estatus.'</span></strong>';
		if($id==3)
			return '<strong><span style="color:green">'.$estatus.'</span></strong>';
    }
	public function tableName()
	{
		return 'sgu_rotacioncauchos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, idestatus', 'required'),
			array('idestatus', 'numerical', 'integerOnly'=>true),
			array('costoTotal', 'numerical'),
			array('nombre, descripcion', 'length', 'max'=>45),
			array('fechaRealizada', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, descripcion, costoTotal, fechaRealizada, idestatus', 'safe', 'on'=>'search'),
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
			'detalleeventocas' => array(self::HAS_MANY, 'Detalleeventoca', 'idrotacionCauchos'),
			'idestatus0' => array(self::BELONGS_TO, 'Estatus', 'idestatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'costoTotal' => 'Costo Total',
			'fechaRealizada' => 'Fecha Realizada',
			'idestatus' => 'Idestatus',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('costoTotal',$this->costoTotal);
		$criteria->compare('fechaRealizada',$this->fechaRealizada,true);
		$criteria->compare('idestatus',$this->idestatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rotacioncauchos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
