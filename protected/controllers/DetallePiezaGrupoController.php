<?php

class DetallePiezaGrupoController extends Controller
{
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','DetallePieza','Verdetalle','Agregardetalle'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionAgregardetalle($id){
	 $data=$id;
	if(isset($_GET['total'])){
		$dat=$_GET['total'];
		$datos= explode(",", $dat);
		
		$detalles=Yii::app()->db->createCommand('select id from sgu_CantidadGrupo where idCaracteristicaVehGrupo="'.$data.'"')->queryAll();
		$total=count($detalles);
		for($i=0;$i<$total;$i++){
			Yii::app()->db->createCommand('UPDATE `tsg`.`sgu_CantidadGrupo` SET `detallePieza` = "'.$datos[$i].'" WHERE `sgu_CantidadGrupo`.`id` = '.$detalles[$i]['id'])->query();
			
		}
		$tot=Yii::app()->db->createCommand('select cv.id from sgu_CaracteristicaVeh cv, sgu_CaracteristicaVehGrupo cvg  
			where cvg.id="'.$data.'" and cv.idrepuesto=cvg.idrepuesto and
			cv.idvehiculo in (select id from sgu_vehiculo where idgrupo in 
			(select idgrupo from sgu_CaracteristicaVehGrupo where id="'.$data.'"))')->queryAll();
		$tota=count($tot);
		for($j=0;$j<$tota;$j++){
			$id=Yii::app()->db->createCommand('select id from sgu_Cantidad where idCaracteristicaVeh="'.$tot[$j]['id'].'"')->queryAll();
			for($k=0;$k<$total;$k++){
				Yii::app()->db->createCommand('UPDATE `tsg`.`sgu_Cantidad` SET `detallePieza` = "'.$datos[$k].'" WHERE `sgu_Cantidad`.`id` = '.$id[$k]['id'])->query();
			}
		}
	}
	
	$consulta=Yii::app()->db->createCommand('select g.grupo from sgu_grupo g, sgu_CaracteristicaVehGrupo cvg where g.id=cvg.idgrupo and cvg.id='.$data)->queryRow();
	
	$grupo= new CArrayDataProvider($consulta);
	$var=new CActiveDataProvider('CantidadGrupo',array(
                    'criteria'=>array(                          
                      'condition'=>'t.idcaracteristicavehgrupo='.$data,
                  ),
                    ));
					
		$this->render('Agregardetalle',array(
            'model'=>$var,
			'grupo'=>$grupo,
			'id'=>$data,
            ));
	}
	public function actionVerdetalle($id){
		$data=$id;
		$consulta=Yii::app()->db->createCommand('select r.repuesto, cg.detallePieza, g.grupo from sgu_grupo g, sgu_CantidadGrupo cg, sgu_repuesto r, sgu_CaracteristicaVehGrupo cvg where idCaracteristicaVehGrupo="'.$data.'" and
			r.id=cvg.idrepuesto and cvg.id=cg.idcaracteristicavehgrupo and g.id=cvg.idgrupo')->queryAll();
		
		$detalle=new CArrayDataProvider($consulta, array('keyField'=>'repuesto','pagination'=>array(
      'pageSize'=>100,
     ),));

		$this->render('Verdetalle',array(
            'model'=>$detalle,
            ),false,TRUE);
	
	
	}
	public function actionDetallePieza()
    {
		$authItemName = "";	
		$grupo=Grupo::model()->findAll();
		$pieza_=Repuesto::model();
		
		
		$pieza=$pieza_->buscar($authItemName);
		
		/*cuado se busca un repuesto en list2 se muestra*/
		if(isset($_GET['Repuesto'])){
			$pieza_->attributes=$_GET['Repuesto'];
			$pieza=$pieza_->buscar($authItemName);
		}
		if (Yii::app()->request->isAjaxRequest && isset($_GET['mode'])){	
			
			/*if(isset($_GET['total'])){
				$total=$_GET['total'];
				$tot = explode(",", $total);
				}*/
            $mode = $_GET['mode'];
            $itemName = $_GET['itemName'];
            $id = isset($_GET['id']) ? $_GET['id'] : '0';
            $ids = explode(",", $id);
                
				/*obtengo el id del grupo seleccionado*/
				$idGrupo=Yii::app()->db->createCommand('select id from sgu_grupo where grupo="'.$itemName.'"')->queryRow();
        }
        // entrega los repuestos asignados a este grupo
        //
        
		if (isset($_GET['itemName'])) {
            $authItemName = $_GET['itemName'];
			$pieza=$pieza_->ActualizarRepuestos($authItemName);

			/*cuado se busca un repuesto en list2 se muestra*/
			if(isset($_GET['Repuesto'])){			
				//$pieza_->attributes=$_GET['Repuesto'];
				
				$pieza=$pieza_->buscar($authItemName);
				//$pieza=$pieza_->ActualizarRepuestos($authItemName);
			}
		}		
		/*paso 1: en lista1 mostrar los repuestos al hacer click en el grupo*/
		/*$consulta=Yii::app()->db->createCommand('select  re.repuesto, cg.cantidad, cg.id from sgu_caracteristicavehgrupo cg, 
		sgu_grupo gu, sgu_repuesto re where cg.idgrupo=gu.id and gu.grupo="'.$authItemName.'" 
		and re.id=cg.idrepuesto ORDER BY re.repuesto ASC')->queryAll(); */
		
		if (isset($_GET['itemName'])){ 
			$consulta=Yii::app()->db->createCommand('select id from sgu_grupo where grupo="'.$authItemName.'"')->queryAll(); 
			$data=$consulta[0]['id'];
		}else{
			$data="0";
		}
		$var=new CActiveDataProvider('CaracteristicaVehGrupo',array(
                    'criteria'=>array(                          
                      'condition'=>'t.idgrupo='.$data,
                  ),
				  
				  'pagination'=>array(
					'pageSize'=>9999,
					),
                    ));
		
		
		//$piezasGrupo=new CArrayDataProvider($consulta, array('keyField'=>'id','pagination'=>array('pageSize'=>$pieza_->count())));
        $this->render(
            'DetallePieza',
            array(
				
                //'piezasGrupo' => $piezasGrupo,
                'DataProvider' => $pieza,
				'grupo'=>$grupo,
				'model'=>$pieza_,
				'var'=>$var,
            )
        );	
    }
}
?>