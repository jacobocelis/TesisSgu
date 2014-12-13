<?php

/**
 * This is the model class for table "sgu_viaje".
 *
 * The followings are the available columns in table 'sgu_viaje':
 * @property integer $id
 * @property double $distanciaKm
 * @property integer $idOrigen
 * @property integer $idDestino
 * @property integer $idtipo
 * @property string $viaje
 *
 * The followings are the available model relations:
 * @property SguHistoricoviajes[] $sguHistoricoviajes
 * @property SguLugar $idOrigen0
 * @property SguLugar $idDestino0
 * @property SguTipoviaje $idtipo0
 */
class Viaje extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_viaje';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('distanciaKm, idOrigen, idDestino, idtipo', 'required'),
			array('idOrigen, idDestino, idtipo', 'numerical', 'integerOnly'=>true),
			array('distanciaKm', 'numerical'),
			array('viaje', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, distanciaKm, idOrigen, idDestino, idtipo, viaje', 'safe', 'on'=>'search'),
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
			'sguHistoricoviajes' => array(self::HAS_MANY, 'Historicoviajes', 'idviaje'),
			'idOrigen0' => array(self::BELONGS_TO, 'Lugar', 'idOrigen'),
			'idDestino0' => array(self::BELONGS_TO, 'Lugar', 'idDestino'),
			'idtipo0' => array(self::BELONGS_TO, 'Tipoviaje', 'idtipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'distanciaKm' => 'Distancia Km',
			'idOrigen' => 'Id Origen',
			'idDestino' => 'Id Destino',
			'idtipo' => 'Idtipo',
			'viaje' => 'Ruta',
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
		$criteria->compare('distanciaKm',$this->distanciaKm);
		$criteria->compare('idOrigen',$this->idOrigen);
		$criteria->compare('idDestino',$this->idDestino);
		$criteria->compare('idtipo',$this->idtipo);
		$criteria->compare('viaje',$this->viaje,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Viaje the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
