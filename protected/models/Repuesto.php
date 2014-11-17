<?php

/**
 * This is the model class for table "sgu_repuesto".
 *
 * The followings are the available columns in table 'sgu_repuesto':
 * @property integer $id
 * @property string $repuesto
 * @property string $descripcion
 * @property integer $idsubTipoRepuesto
 *
 * The followings are the available model relations:
 * @property SguCaracteristicaveh[] $sguCaracteristicavehs
 * @property SguCaracteristicavehgrupo[] $sguCaracteristicavehgrupos
 * @property SguSubtiporepuesto $idsubTipoRepuesto0
 * @property SguSinonimo[] $sguSinonimos
 * @property SguSinonimo[] $sguSinonimos1
 */
class Repuesto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_repuesto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('repuesto, idsubTipoRepuesto,idunidad', 'required'),
			array('idsubTipoRepuesto,idunidad', 'numerical', 'integerOnly'=>true),
			array('repuesto', 'length', 'max'=>200),
			array('descripcion', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, repuesto, descripcion, idsubTipoRepuesto,idunidad', 'safe', 'on'=>'search'),
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
			'sguCaracteristicavehs' => array(self::HAS_MANY, 'Caracteristicaveh', 'idrepuesto'),
			'sguCaracteristicavehgrupos' => array(self::HAS_MANY, 'Caracteristicavehgrupo', 'idrepuesto'),
			'idsubTipoRepuesto0' => array(self::BELONGS_TO, 'Subtiporepuesto', 'idsubTipoRepuesto'),
			'sguSinonimos' => array(self::HAS_MANY, 'Sinonimo', 'idrepuesto1'),
			'sguSinonimos1' => array(self::HAS_MANY, 'Sinonimo', 'idrepuesto2'),
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
			'repuesto' => 'Repuesto',
			'descripcion' => 'Descripcion',
			'idsubTipoRepuesto' => 'Sub-tipo',
			'idunidad' => 'Idunidad',
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
		$criteria->compare('repuesto',$this->repuesto,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('idsubTipoRepuesto',$this->idsubTipoRepuesto);
		$criteria->compare('idunidad',$this->idunidad);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function buscar($data)
	{
		$grupo=$data;
		// @todo Please modify the following code to remove attributes that should not be searched.
		
		$criteria=new CDbCriteria;
		if($grupo!=""){
			//$criteria->compare('id',$this->id);
			$criteria->compare('t.id not in (select re.id from sgu_CaracteristicaVehGrupo cg, 
			sgu_grupo gu, sgu_repuesto re where cg.idgrupo=gu.id and gu.grupo="'.$grupo.'" and re.id=cg.idrepuesto) and t.repuesto',$this->repuesto,true);
			$criteria->order = 'idsubTipoRepuesto ASC';
			$criteria->addCondition('t.id not in (select re.id from sgu_CaracteristicaVehGrupo cg, 
			sgu_grupo gu, sgu_repuesto re where cg.idgrupo=gu.id and gu.grupo="'.$grupo.'" and re.id=cg.idrepuesto)');
			
			$dataProvider= new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
			));
			$dataProvider->pagination->pageSize=$dataProvider->totalItemCount;
			return $dataProvider;
		}
		if($grupo==""){
			$criteria->compare('repuesto',$this->repuesto,true);
			$criteria->order = 'idsubTipoRepuesto ASC';
			 $dataProvider=new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				));
			$dataProvider->pagination->pageSize=$dataProvider->totalItemCount;
			return $dataProvider;
		}
	}
	public function ActualizarRepuestos($authItemName)
	{	
		// @todo Please modify the following code to remove attributes that should not be searched.
		$grupo=$authItemName;
		$criteria=new CDbCriteria;

		/*$criteria->compare('id',$this->id);
		$criteria->compare('repuesto',$this->repuesto,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('idsubTipoRepuesto',$this->idsubTipoRepuesto);*/
		$criteria->addCondition('id not in (select re.id from sgu_CaracteristicaVehGrupo cg, 
		sgu_grupo gu, sgu_repuesto re where cg.idgrupo=gu.id and gu.grupo="'.$grupo.'"
		and re.id=cg.idrepuesto)');
		$criteria->order = 'idsubTipoRepuesto ASC';
		$dataProvider= new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		$dataProvider->pagination->pageSize=$dataProvider->totalItemCount;
		return $dataProvider;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Repuesto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
