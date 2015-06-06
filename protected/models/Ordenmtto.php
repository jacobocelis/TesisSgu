<?php

/**
 * This is the model class for table "sgu_ordenmtto".
 *
 * The followings are the available columns in table 'sgu_ordenmtto':
 * @property integer $id
 * @property string $fecha
 * @property string $responsable
 * @property integer $idestatus
 *
 * The followings are the available model relations:
 * @property SguDetalleorden[] $sguDetalleordens
 * @property SguEstatus $idestatus0
 */
class Ordenmtto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function color($id,$estatus){
		if($id==5)
			return '<strong><span style="color:orange">'.$estatus.'</span></strong>';
		if($id==6 or $id==7)
			return '<strong><span style="color:green">'.$estatus.'</span></strong>';
		
    }
	public function estado($id){
		if($id==5)
			return 0;
		if($id==6)
			return 1;
	}
	public function puedeEliminar(){
		$url;
		$imagen;
		$realizoAct=0;
		$detOrden=Detalleorden::model()->findAll("idordenMtto='".$this->id."'");
		foreach ($detOrden as $value) {
			$act=Actividades::model()->findByPk($value["idactividades"]);
			if($act['idestatus']==3)
				$realizoAct=1;
		}
		$factura=Factura::model()->find("idordenMtto='".$this->id."'");
		if($factura or $realizoAct){
			$imagen=Yii::app()->request->baseUrl."/imagenes/delete-off.png";
			$url="{alert('No puede eliminar la orden en éste punto')}";
		}
		else{
			$imagen=Yii::app()->request->baseUrl."/imagenes/delete.png";
			$url='{if(confirm("¿Desea cancelar ésta orden?")) eliminar("'.$this->id.'");}';
		}

		return CHtml::link(
                CHtml::image($imagen,
                        "Eliminar",array("title"=>"Eliminar orden")),		  
                "",
                array(
                	'style'=>'cursor: pointer;text-decoration: underline;text-align:center;',
                     'onclick'=>$url
                )
        );
	}
	public function tableName()
	{
		return 'sgu_ordenMtto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, tipo, idestatus, taller, cOperativo, cTaller', 'required'),
			array('tipo, idestatus, taller, cOperativo, cTaller', 'numerical', 'integerOnly'=>true),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha,tipo, idestatus, taller, cOperativo, cTaller', 'safe', 'on'=>'search'),
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
			'sguDetalleordens' => array(self::HAS_MANY, 'Detalleorden', 'idordenMtto'),
			'idestatus0' => array(self::BELONGS_TO, 'Estatus', 'idestatus'),
			'sguFacturas' => array(self::HAS_MANY, 'Factura', 'idordenMtto'),
			'cOperativo0' => array(self::BELONGS_TO, 'Empleado', 'cOperativo'),
			'cTaller0' => array(self::BELONGS_TO, 'Empleado', 'cTaller'),
			'idestatus0' => array(self::BELONGS_TO, 'Estatus', 'idestatus'),
			'taller0' => array(self::BELONGS_TO, 'Proveedor', 'taller'),
			'sguDetalleordencos' => array(self::HAS_MANY, 'Detalleordenco', 'idordenMtto'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'tipo' => 'Tipo',
			'idestatus' => 'Idestatus',
			'taller' => 'Taller',
			
			'cOperativo' => 'Coordinador operativo',
			'cTaller' => 'Coordinador de transporte',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('idestatus',$this->idestatus);
		$criteria->compare('taller',$this->taller);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('cOperativo',$this->cOperativo);
		$criteria->compare('cTaller',$this->cTaller);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ordenmtto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
