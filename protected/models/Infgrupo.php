<?php

/**
 * This is the model class for table "sgu_infgrupo".
 *
 * The followings are the available columns in table 'sgu_infgrupo':
 * @property integer $id
 * @property string $informacion
 * @property integer $idgrupo
 *
 * The followings are the available model relations:
 * @property SguGrupo $idgrupo0
 */
class Infgrupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_infGrupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('informacion, idgrupo', 'required'),
			
			array('idgrupo', 'numerical', 'integerOnly'=>true),
			array('informacion', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, informacion, idgrupo', 'safe', 'on'=>'search'),
			
			
        array('informacion', 'UniqueAttributesValidator', 'with'=>'idgrupo'),
    
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
			'idgrupo0' => array(self::BELONGS_TO, 'Grupo', 'idgrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'informacion' => 'Campo',
			'idgrupo' => 'Idgrupo',
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
		$criteria->compare('informacion',$this->informacion,true);
		$criteria->compare('idgrupo',$this->idgrupo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Infgrupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
