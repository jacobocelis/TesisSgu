<?php

/**
 * This is the model class for table "sgu_plangrupo".
 *
 * The followings are the available columns in table 'sgu_plangrupo':
 * @property integer $id
 * @property string $parte
 * @property integer $idgrupo
 * @property integer $idplanGrupo
 *
 * The followings are the available model relations:
 * @property SguActividadesgrupo[] $sguActividadesgrupos
 * @property SguPlan[] $sguPlans
 * @property SguGrupo $idgrupo0
 * @property Plangrupo $idplanGrupo0
 * @property Plangrupo[] $sguPlangrupos
 */
class Plangrupo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_planGrupo';
	}
	public function getCompiledColour()
	{
		return 'Green';
    }
	public function parte($id){
		$parte=Yii::app()->db->createCommand('select concat_ws(" => ",(select parte from sgu_plangrupo c1 where c1.id=c2.idplanGrupo),c2.parte) as parte from sgu_plangrupo c2
		where c2.id="'.$id.'"')->queryRow();
		return $parte["parte"];
	}
	public function totalActividades($id){
		$total=Yii::app()->db->createCommand('select count(*) as total from sgu_planGrupo pg, sgu_actividadesGrupo ag where ag.idplan=pg.id and pg.id="'.$id.'"')->queryRow();
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
			array('parte, idgrupo', 'required'),
			array('idgrupo, idplanGrupo', 'numerical', 'integerOnly'=>true),
			array('parte', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parte, idgrupo, idplanGrupo', 'safe', 'on'=>'search'),
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
			'sguActividadesgrupos' => array(self::HAS_MANY, 'Actividadesgrupo', 'idplan'),
			'sguPlans' => array(self::HAS_MANY, 'Plan', 'idplanGrupo'),
			'idgrupo0' => array(self::BELONGS_TO, 'Grupo', 'idgrupo'),
			'idplanGrupo0' => array(self::BELONGS_TO, 'Plangrupo', 'idplanGrupo'),
			'sguPlangrupos' => array(self::HAS_MANY, 'Plangrupo', 'idplanGrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parte' => 'Parte',
			'idgrupo' => 'Idgrupo',
			'idplanGrupo' => 'Idplan Grupo',
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
		$criteria->compare('parte',$this->parte,true);
		$criteria->compare('idgrupo',$this->idgrupo);
		$criteria->compare('idplanGrupo',$this->idplanGrupo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plangrupo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}