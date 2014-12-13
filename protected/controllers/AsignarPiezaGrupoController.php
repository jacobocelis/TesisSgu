<?php

class AsignarPiezaGrupoController extends Controller
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
				'actions'=>array('create','update','AsignarPieza'),
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
	public function actionAsignarPieza(){
	
		$actualizar=0;
		$authItemName = "";	
		$grupo=Grupo::model()->findAll();
		//$rep=Repuesto::model()->findAll(array('condition'=>'t.id>=1'));
		$pieza_=Repuesto::model();
		
		$pieza=$pieza_->buscar($authItemName);
		
		/*cuado se busca un repuesto en list2 se muestra*/
		if(isset($_GET['Repuesto'])){
			$pieza_->attributes=$_GET['Repuesto'];
			$pieza=$pieza_->buscar($authItemName);
		}
		if (Yii::app()->request->isAjaxRequest && isset($_GET['mode'])){	
			if(isset($_GET['total'])){
				$total=$_GET['total'];
				$tot = explode(",", $total);
				}
            $mode = $_GET['mode'];
            $itemName = $_GET['itemName'];
            $id = isset($_GET['id']) ? $_GET['id'] : '0';
            $ids = explode(",", $id);
			$i=0;
			
			/*obtengo el id del grupo seleccionado*/
			$idGrupo=Yii::app()->db->createCommand('select id from sgu_grupo where grupo="'.$itemName.'"')->queryRow();
			
            foreach ($ids as $uid) {
                if ($mode == 'assign') {
				
				/*insertado data en el grupo*/
					Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_CaracteristicaVehGrupo` (`idgrupo`, `idrepuesto`,`cantidad`) 
					VALUES ('".$idGrupo["id"]."','".$uid."','".$tot[$i]."')")->query();
					
					/*insertando en cantidadGrupo cantidad veces el repuesto*/
					$idCVG=Yii::app()->db->createCommand("select max(id) as id from sgu_CaracteristicaVehGrupo")->queryRow();
					for($j=0;$j<$tot[$i];$j++){
						Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_CantidadGrupo` (`idCaracteristicaVehGrupo`) 
							VALUES ('".$idCVG['id']."')")->query();
					}
					$i++;
					
					 
					/*quita de la lista asignar el repuesto que ya agrego*/
					if(isset($_GET['itemName']))
						$pieza=$pieza_->buscar($authItemName); 
						$actualizar=1;
                } else {
                if ($mode == 'revoke'){
					
					Yii::app()->db->createCommand("DELETE FROM `tsg`.`sgu_CaracteristicaVehGrupo` 
					WHERE `sgu_CaracteristicaVehGrupo`.`idgrupo` = ".$idGrupo["id"]." and  `sgu_CaracteristicaVehGrupo`.`idrepuesto`='".$uid."'")->query();
					
					/*quita de la lista asignar el repuesto que ya agrego (arreglar)*/
						if(isset($_GET['itemName'])){
							$pieza=$pieza_->buscar($authItemName);
						}                       
					}
                }
            }
			/*aqui se hacen los inserts por debajo*/
			if ($mode == 'assign') {
				/*insertando data en tabla caracteristicaVeh a cada vehiculo del grupo*/
				$totalVeh=Yii::app()->db->createCommand('select id from sgu_vehiculo where idgrupo="'.$idGrupo["id"].'"')->queryAll();
				$total=count($totalVeh);
				
				for($i=0;$i<$total;$i++){
						$k=0;
						foreach ($ids as $uid) {
						Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_CaracteristicaVeh` (`idvehiculo`, `idrepuesto`,cantidad) 
						VALUES ('".$totalVeh[$i]['id']."','".$uid."','".$tot[$k]."')")->query();
							$idCV=Yii::app()->db->createCommand("select max(id) as id from sgu_CaracteristicaVeh")->queryRow();
							for($j=0;$j<$tot[$k];$j++){
								Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_Cantidad` (`idCaracteristicaVeh`) 
								VALUES ('".$idCV['id']."')")->query();
							}
						$k++;
					}
				}
			}
			if ($mode == 'revoke'){
				/*eliminando cada vehiculo del grupo*/
				$totalVeh=Yii::app()->db->createCommand('select id from sgu_vehiculo where idgrupo="'.$idGrupo["id"].'"')->queryAll();
				$total=count($totalVeh);
				for($i=0;$i<$total;$i++){
						foreach ($ids as $uid){
						Yii::app()->db->createCommand("DELETE FROM `tsg`.`sgu_CaracteristicaVeh`
						WHERE `sgu_CaracteristicaVeh`.`idvehiculo` = ".$totalVeh[$i]['id']." and `sgu_CaracteristicaVeh`.`idrepuesto`=".$uid)->query();
					}
				}
			}
        }
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
		$consulta=Yii::app()->db->createCommand('select re.id, re.repuesto, cg.cantidad, st.subTipo, u.unidad from sgu_unidad u ,sgu_CaracteristicaVehGrupo cg, 
		sgu_grupo gu, sgu_subTipoRepuesto st, sgu_repuesto re where cg.idgrupo=gu.id and gu.grupo="'.$authItemName.'" 
		and re.idSubTipoRepuesto=st.id and re.idunidad=u.id
		and re.id=cg.idrepuesto ORDER BY st.subTipo ASC')->queryAll(); 
		$piezasGrupo=new CArrayDataProvider($consulta, array('keyField'=>'id','pagination'=>array('pageSize'=>$pieza_->count())));
        $this->render(
            'AsignarPieza',
            array(
                'piezasGrupo' => $piezasGrupo,
                'DataProvider' => $pieza,
				'grupo'=>$grupo,
				'model'=>$pieza_,
				'actualizar'=>$actualizar,
				
            )
        );
	
    }
}
?>