<?php

/**
 * This is the model class for table "sgu_actividadrecurso".
 *
 * The followings are the available columns in table 'sgu_actividadrecurso':
 * @property integer $id
 * @property integer $cantidad
 * @property integer $idactividades
 * @property integer $idinsumo
 * @property integer $idprovServ
 * @property integer $idrepuesto
 * @property integer $idunidad
 * @property string $detalle
 *
 * The followings are the available model relations:
 * @property SguActividades $idactividades0
 * @property SguInsumo $idinsumo0
 * @property SguProvserv $idprovServ0
 * @property SguRepuesto $idrepuesto0
 * @property SguUnidad $idunidad0
 */
class Actividadrecurso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_actividadrecurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, cantidad, idunidad,idactividadRecursoGrupo', 'required'),
			array('id, cantidad, idactividades, idinsumo, idprovServ, idrepuesto, idunidad, idactividadRecursoGrupo', 'numerical', 'integerOnly'=>true),
			array('detalle', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cantidad, idactividades, idinsumo, idprovServ, idrepuesto, idunidad, detalle,idactividadRecursoGrupo', 'safe', 'on'=>'search'),
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
			'idactividades0' => array(self::BELONGS_TO, 'SguActividades', 'idactividades'),
			'idinsumo0' => array(self::BELONGS_TO, 'SguInsumo', 'idinsumo'),
			'idprovServ0' => array(self::BELONGS_TO, 'SguProvserv', 'idprovServ'),
			'idrepuesto0' => array(self::BELONGS_TO, 'SguRepuesto', 'idrepuesto'),
			'idunidad0' => array(self::BELONGS_TO, 'SguUnidad', 'idunidad'),
			'idactividadRecursoGrupo0' => array(self::BELONGS_TO, 'Actividadrecursogrupo', 'idactividadRecursoGrupo'),
			
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
			'idactividades' => 'Idactividades',
			'idinsumo' => 'Idinsumo',
			'idprovServ' => 'Idprov Serv',
			'idrepuesto' => 'Idrepuesto',
			'idunidad' => 'Idunidad',
			'detalle' => 'Detalle',
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
		$criteria->compare('idprovServ',$this->idprovServ);
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
	 * @return Actividadrecurso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
