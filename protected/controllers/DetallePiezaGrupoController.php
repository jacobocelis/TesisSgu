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
	 
	public function actionAgregardetalle($id,$fila){
	 //$data=$id;
	 $model=CantidadGrupo::model()->findByPk($id);
	 
	 if(isset($_POST['CantidadGrupo'])){
	 
            $model->attributes=$_POST['CantidadGrupo'];
            /*insert de detalle por pagina*/
			if($model->save()){
            /*inserts por debajo*/
			$idgrupo=Yii::app()->db->createCommand('select idCaracteristicaVehGrupo as id from sgu_CantidadGrupo where id="'.$id.'"')->queryRow();
			$detalles=Yii::app()->db->createCommand('select id from sgu_CantidadGrupo where idCaracteristicaVehGrupo="'.$idgrupo['id'].'"')->queryAll();
			$total=count($detalles);
			
			$tot=Yii::app()->db->createCommand('select cv.id from sgu_CaracteristicaVeh cv, sgu_CaracteristicaVehGrupo cvg  
				where cvg.id="'.$idgrupo['id'].'" and cv.idrepuesto=cvg.idrepuesto and
				cv.idvehiculo in (select id from sgu_vehiculo where idgrupo in 
				(select idgrupo from sgu_CaracteristicaVehGrupo where id="'.$idgrupo['id'].'"))')->queryAll();
				
			$tota=count($tot);
			file_put_contents('prueba1.txt', print_r($tot[0]['id'],true));
			for($j=0;$j<$tota;$j++){
				Yii::app()->db->createCommand('SET @rownum=0;')->execute();
				$idg=Yii::app()->db->createCommand('select (@rownum := @rownum + 1) AS fila, id from sgu_Cantidad where idCaracteristicaVeh="'.$tot[$j]['id'].'" having fila="'.$fila.'"')->queryRow();
				Yii::app()->db->createCommand('UPDATE `tsg`.`sgu_Cantidad` SET `detallePieza` = "'.$model->detallePieza.'" WHERE `sgu_Cantidad`.`id` = '.$idg['id'])->query();
			}
			/*------------------*/
				if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó el detalle correctamente"
                        ));
                    exit;               
                }
                /*else
                    $this->redirect(array('view','id'=>$model->id));*/
            }
        }
		
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
	 if (Yii::app()->request->isAjaxRequest){
				$model=CantidadGrupo::model()->findByPk($id);
			//$model=$this->loadModel($id);
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form2', array('model'=>$model), true)));
            exit;               
        }
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
		if (isset($_GET['idetalle'])){ 
			$idetalle=$_GET['idetalle'];
		}else{
			$idetalle="0";
		}
		
		if (isset($_GET['itemName'])){ 
			$consulta=Yii::app()->db->createCommand('select id from sgu_grupo where grupo="'.$authItemName.'"')->queryAll(); 
			$data=$consulta[0]['id'];
		}else{
			$data="0";
		}
		
		$detalle=new CActiveDataProvider('CantidadGrupo',array(
                    'criteria'=>array(                          
                      'condition'=>'t.idCaracteristicaVehGrupo="'.$idetalle.'"',
                  ),
				  'pagination'=>array(
					'pageSize'=>9999,
					),
                    ));
	  
		$var=new CActiveDataProvider('CaracteristicaVehGrupo',array(
                    'criteria'=>array(                          
                      'condition'=>'idrepuesto in (select id from sgu_repuesto order by idsubTipoRepuesto ASC ) and t.idgrupo='.$data,
					  //'condition'=>'idrepuesto in (select id from sgu_repuesto order by idsubTipoRepuesto ASC )',
                  ),
				  'pagination'=>array(
					'pageSize'=>9999,
					),
                    ));
        $this->render(
            'DetallePieza',
            array(
                //'piezasGrupo' => $piezasGrupo,
                'DataProvider' => $pieza,
				'grupo'=>$grupo,
				'model'=>$pieza_,
				'var'=>$var,
				'detalle'=>$detalle,
            )
        );	
    }
}
?>