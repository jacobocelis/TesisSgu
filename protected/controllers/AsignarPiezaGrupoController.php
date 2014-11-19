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
					/*llenado por debajo de tabla plan de grupo*/
					$tipo=Yii::app()->db->createCommand('select t.tipo  from sgu_tipo t, sgu_grupo g where t.id=g.idtipo and g.grupo="'.$itemName.'"')->queryRow();
					
					$validar=Yii::app()->db->createCommand('select * from sgu_planGrupo where parte="'.$tipo["tipo"].'" and idgrupo="'.$idGrupo["id"].'" and idplanGrupo is NULL')->queryAll();
					
					if(count($validar)==0){
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_planGrupo` (`parte`,`idgrupo`,`idplanGrupo`)
						VALUES ('".$tipo["tipo"]."','".$idGrupo["id"]."',null)")->query();
					}
					else{
						/*falta aqui arreglar que si se cambia el tipo del grupo se actualice el nombre*/
					}//file_put_contents('pruebaa.txt', print_r($ids,true));
					 foreach ($ids as $parte) {
					 		
						$categoria=Yii::app()->db->createCommand('select tr.tipo from sgu_subTipoRepuesto str, sgu_TipoRepuesto tr, sgu_repuesto r where r.idsubTipoRepuesto=str.id and str.idTipoRepuesto=tr.id and r.id="'.$parte.'"')->queryRow();
						
						$idplanGrupo1=Yii::app()->db->createCommand('select id from sgu_planGrupo where parte="'.$tipo["tipo"].'" and idgrupo="'.$idGrupo["id"].'" and idplanGrupo is NULL')->queryRow();
						Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_planGrupo` (`parte`,`idgrupo`,`idplanGrupo`)
						VALUES ('".$categoria["tipo"]."',".$idGrupo["id"].",".$idplanGrupo1["id"].")")->query();
						
						$idplanGrupo2=Yii::app()->db->createCommand('select id from sgu_planGrupo where parte="'.$categoria["tipo"].'" and idgrupo="'.$idGrupo["id"].'" and idplanGrupo="'.$idplanGrupo1['id'].'"')->queryRow();
						$Subcategoria=Yii::app()->db->createCommand('select str.subTipo from sgu_subTipoRepuesto str, sgu_repuesto r where r.idsubTipoRepuesto=str.id and r.id="'.$parte.'"')->queryRow();
						Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_planGrupo` (`parte`,`idgrupo`,`idplanGrupo`)
						VALUES ('".$Subcategoria["subTipo"]."',".$idGrupo["id"].",".$idplanGrupo2["id"].")")->query();
						
						$idplanGrupo3=Yii::app()->db->createCommand('select id from sgu_planGrupo where parte="'.$Subcategoria["subTipo"].'" and idgrupo="'.$idGrupo["id"].'" and idplanGrupo="'.$idplanGrupo2['id'].'"')->queryRow();
						$repu=Yii::app()->db->createCommand('select r.repuesto from sgu_repuesto r where r.id="'.$parte.'"')->queryRow();
						Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_planGrupo` (`parte`,`idgrupo`,`idplanGrupo`)
						VALUES ('".$repu["repuesto"]."',".$idGrupo["id"].",".$idplanGrupo3["id"].")")->query();
						
					} // and r.id not in (select re.id from sgu_repuesto re, sgu_subTipoRepuesto str, sgu_TipoRepuesto tr where re.idsubTipoRepuesto=str.id and str.idTipoRepuesto= tr.id and tr.id=4)
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
				/*eliminando en cantidadGrupo cantidad veces el repuesto
				(drop in cascade lo hace la bd)*/
				
				/*eliminando por debajo de plangrupo las piezas*/
				foreach ($ids as $parte) {
					$parte=Yii::app()->db->createCommand('select parte from sgu_planGrupo where parte=(select repuesto from sgu_repuesto where id="'.$parte.'") and idgrupo="'.$idGrupo["id"].'"')->queryRow();
					Yii::app()->db->createCommand("DELETE FROM `tsg`.`sgu_planGrupo` 
					WHERE parte = '".$parte["parte"]."' and idgrupo='".$idGrupo["id"]."'")->query();
				}
				/*aqui falta eliminar si queda la ultima pieza de una categoria eliminar la part y la subparte
				y manejar la execpcion de que no elimine si hay actividades de mantenimiento asociadas.
				*/
			}
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