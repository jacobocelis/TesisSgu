<?php

/**
 * This is the model class for table "sgu_caucho".
 *
 * The followings are the available columns in table 'sgu_caucho':
 * @property integer $id
 * @property integer $idmedidaCaucho
 * @property integer $idrin
 * @property integer $idpiso
 *
 * The followings are the available model relations:
 * @property SguMedidacaucho $idmedidaCaucho0
 * @property SguPiso $idpiso0
 * @property SguRin $idrin0
 * @property SguHistoricocaucho[] $sguHistoricocauchos
 */
class Caucho extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_caucho';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idmedidaCaucho, idrin, idpiso', 'required'),
			array('idmedidaCaucho, idrin, idpiso', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idmedidaCaucho, idrin, idpiso', 'safe', 'on'=>'search'),
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
			'idmedidaCaucho0' => array(self::BELONGS_TO, 'SguMedidacaucho', 'idmedidaCaucho'),
			'idpiso0' => array(self::BELONGS_TO, 'SguPiso', 'idpiso'),
			'idrin0' => array(self::BELONGS_TO, 'SguRin', 'idrin'),
			'sguHistoricocauchos' => array(self::HAS_MANY, 'SguHistoricocaucho', 'idcaucho'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idmedidaCaucho' => 'Idmedida Caucho',
			'idrin' => 'Idrin',
			'idpiso' => 'Idpiso',
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
		$criteria->compare('idmedidaCaucho',$this->idmedidaCaucho);
		$criteria->compare('idrin',$this->idrin);
		$criteria->compare('idpiso',$this->idpiso);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Caucho the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
