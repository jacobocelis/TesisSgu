<?php

/**
 * This is the model class for table "sgu_factura".
 *
 * The followings are the available columns in table 'sgu_factura':
 * @property integer $id
 * @property string $fechaFactura
 * @property integer $codigo
 * @property integer $idproveedor
 * @property integer $idordenMtto
 * @property double $total
 * @property double $iva
 * @property double $totalFactura
 *
 * The followings are the available model relations:
 * @property SguOrdenmtto $idordenMtto0
 * @property SguProveedor $idproveedor0
 * @property SguFacturaact[] $sguFacturaacts
 */
class Factura extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sgu_factura';
	}
	public function totalFacturaOrdenNeumaticos($id){
		
		$iva=Parametro::model()->findByAttributes(array('nombre'=>'IVA'));
		$factura=Factura::model()->findByPk($id);
		
						$actividades=Detordneumatico::model()->findAll(array("condition"=>"idordenMtto = '".$factura->idordenMtto."' and iddetalleEventoCa in (select id from sgu_detalleEventoCa where idfallaCaucho is not null) "));
						$subTotal=0;
						//averias
						for($i=0;$i<count($actividades);$i++){
							$averias=Detreccaucho::model()->findAll(array("condition"=>"iddetalleEventoCa = '".$actividades[$i]["iddetalleEventoCa"]."'"));
							for($j=0;$j<count($averias);$j++){
								$subTotal+=$averias[$j]["costoTotal"];
							}
						}
					
						//renovaciones
						$actividades=Detordneumatico::model()->findAll(array("condition"=>"idordenMtto = '".$factura->idordenMtto."' and iddetalleEventoCa in (select id from sgu_detalleEventoCa where idaccionCaucho=1 and idestatus = 3)"));
						for($i=0;$i<count($actividades);$i++){
							$renovaciones=Historicocaucho::model()->find(array('condition'=>'iddetalleRueda in (select iddetalleRueda from sgu_historicoCaucho where id in (select idhistoricoCaucho from sgu_detalleEventoCa where id="'.$actividades[$i]["iddetalleEventoCa"].'" )) and idestatusCaucho=1 and idvehiculo in (select idvehiculo from sgu_historicoCaucho where id in (select idhistoricoCaucho from sgu_detalleEventoCa where id="'.$actividades[$i]["iddetalleEventoCa"].'"))'));
								$subTotal+=$renovaciones["costounitario"];
						}
					
						//rotaciones
						/*$rotaciones=Rotacioncauchos::model()->findAll(array(
						'condition' =>'id in (select de.idrotacionCauchos as id from sgu_detOrdNeumatico d, sgu_detalleEventoCa de where d.iddetalleEventoCa=de.id and d.idordenMtto='.$factura->idordenMtto.' and de.idaccionCaucho=2 group by de.idrotacionCauchos) and idestatus= 3','order'=>'id'));
						
						for($i=0;$i<count($rotaciones);$i++)
							$subTotal+=$rotaciones[$i]["costoTotal"];*/
						
		return $subTotal;
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fechaFactura, codigo, idproveedor, idordenMtto', 'required'),
			array('codigo, idproveedor, idordenMtto', 'numerical', 'integerOnly'=>true),
			array('total, iva, totalFactura', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fechaFactura, codigo, idproveedor, idordenMtto, total, iva, totalFactura', 'safe', 'on'=>'search'),
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
			'idordenMtto0' => array(self::BELONGS_TO, 'Ordenmtto', 'idordenMtto'),
			'idproveedor0' => array(self::BELONGS_TO, 'Proveedor', 'idproveedor'),
			'sguFacturaacts' => array(self::HAS_MANY, 'Facturaact', 'idfactura'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fechaFactura' => 'Fecha de factura',
			'codigo' => 'Factura número',
			'idproveedor' => 'Proveedor',
			'idordenMtto' => 'Idorden Mtto',
			'total' => 'SubTotal',
			'iva' => 'IVA',
			'totalFactura' => 'Total facturado',
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
		$criteria->compare('fechaFactura',$this->fechaFactura,true);
		$criteria->compare('codigo',$this->codigo);
		$criteria->compare('idproveedor',$this->idproveedor);
		$criteria->compare('idordenMtto',$this->idordenMtto);
		$criteria->compare('total',$this->total);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('totalFactura',$this->totalFactura);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Factura the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
