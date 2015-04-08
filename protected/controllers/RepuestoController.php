<?php

class RepuestoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','crear','Selectdos','buscarRepuesto','DetalleRepuestoVehiculo','AsignarPiezaGrupo','DetallePiezaGrupo','iniciales'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
		public function actionAsignarPiezaGrupo(){
	
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
		$idetalle=4;
		if(isset($_GET["iddetalle"])){

			$idetalle=$_GET["iddetalle"];
		}
			
		$detalle=new CActiveDataProvider('CantidadGrupo',array(
                    'criteria'=>array(                          
                      'condition'=>'t.idCaracteristicaVehGrupo="'.$idetalle.'"',
               )));

		/*paso 1: en lista1 mostrar los repuestos al hacer click en el grupo*/
		$consulta=Yii::app()->db->createCommand('select re.id, re.repuesto, cg.cantidad, st.subTipo, u.unidad, cg.id as idCaracteristicaVehGrupo from sgu_unidad u ,sgu_CaracteristicaVehGrupo cg, 
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
				'detalle'=>$detalle,
				
            )
        );
	
    }
		public function actionDetallePiezaGrupo()
    {
		$authItemName = "";	
		$grupo=Grupo::model()->findAll();
		$pieza_=Repuesto::model();
		$modelo=new CaracteristicaVehGrupo('search');
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
                  ),'pagination'=>array('pageSize'=>9999)));
	  
		$var=new CActiveDataProvider('CaracteristicaVehGrupo',array(
                    'criteria'=>array(                          
                      'condition'=>'idrepuesto in (select id from sgu_repuesto order by idsubTipoRepuesto ASC ) and t.idgrupo='.$data,
					  //'condition'=>'idrepuesto in (select id from sgu_repuesto order by idsubTipoRepuesto ASC )',
                  ),'pagination'=>array('pageSize'=>9999)));
		
		if (isset($_GET['rep'])){ 
			$rep=$_GET['rep'];
			$var=new CActiveDataProvider('CaracteristicaVehGrupo',array(
                    'criteria'=>array(                          
                      'condition'=>'idrepuesto in (select id from sgu_repuesto where repuesto like "%'.$rep.'%" order by idsubTipoRepuesto ASC ) and t.idgrupo='.$data,
					  //'condition'=>'idrepuesto in (select id from sgu_repuesto order by idsubTipoRepuesto ASC )',
                  ),'pagination'=>array('pageSize'=>9999)));
		}
        $this->render(
            'DetallePieza',
            array(
				'grupo'=>$grupo,
				'var'=>$var,
				'detalle'=>$detalle,
				'modelo'=>$modelo,
            )
        );	
    }
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Repuesto;
		$tipo = new Tiporepuesto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Repuesto']))
		{
			$model->attributes=$_POST['Repuesto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}
	public function actionCrear()
	{
		$model=new Repuesto;

		if(isset($_POST['Repuesto'])){
			$model->attributes=$_POST['Repuesto'];
			if($model->save()){
				if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>""
                        ));
                    exit;               
                }
			}	
		}
		if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formNuevo', array('model'=>$model), true)));
            exit;               
        }
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$tipo = new Tiporepuesto;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Repuesto']))
		{
			$model->attributes=$_POST['Repuesto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'tipo'=>$tipo,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	
	public function actionIndex(){
		
		$dataProvider=new CActiveDataProvider('CaracteristicaVeh');
		if(isset($_GET["repuesto"]) and isset($_GET["vehiculo"])){
				if($_GET["repuesto"]==null and $_GET["vehiculo"]==null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh');	
				if($_GET["repuesto"]<>null and $_GET["vehiculo"]<>null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh',array('criteria' => array(
						'condition' =>"idrepuesto in (select id from sgu_repuesto where repuesto like '%".$_GET['repuesto']."%') and idvehiculo=".$_GET['vehiculo']."",
						'order'=>'idrepuesto')));	
				if($_GET["repuesto"]<>null and $_GET["vehiculo"]==null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh',array('criteria' => array(
						'condition' =>"idrepuesto in (select id from sgu_repuesto where repuesto like '%".$_GET['repuesto']."%')",
						'order'=>'idrepuesto')));	
				if($_GET["repuesto"]==null and $_GET["vehiculo"]<>null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh',array('criteria' => array(
						'condition' =>"idvehiculo=".$_GET['vehiculo']."",
						'order'=>'idrepuesto')));			
		}
		$det=new CActiveDataProvider('Cantidad');
		if(isset($_GET["id"]))
			$det=new CActiveDataProvider('Cantidad',array('criteria' => array(
						'condition' =>"idCaracteristicaVeh = '".$_GET['id']."'",
						'order'=>'id')));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'det'=>$det,
		));
	}
		public function actionIniciales(){
		
		$dataProvider=new CActiveDataProvider('CaracteristicaVeh');
		if(isset($_GET["repuesto"]) and isset($_GET["vehiculo"])){
				if($_GET["repuesto"]==null and $_GET["vehiculo"]==null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh');	
				if($_GET["repuesto"]<>null and $_GET["vehiculo"]<>null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh',array('criteria' => array(
						'condition' =>"idrepuesto in (select id from sgu_repuesto where repuesto like '%".$_GET['repuesto']."%') and idvehiculo=".$_GET['vehiculo']."",
						'order'=>'idrepuesto')));	
				if($_GET["repuesto"]<>null and $_GET["vehiculo"]==null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh',array('criteria' => array(
						'condition' =>"idrepuesto in (select id from sgu_repuesto where repuesto like '%".$_GET['repuesto']."%')",
						'order'=>'idrepuesto')));	
				if($_GET["repuesto"]==null and $_GET["vehiculo"]<>null)
					$dataProvider=new CActiveDataProvider('CaracteristicaVeh',array('criteria' => array(
						'condition' =>"idvehiculo=".$_GET['vehiculo']."",
						'order'=>'idrepuesto')));			
		}
		$det=new CActiveDataProvider('Cantidad');
		if(isset($_GET["id"]))
			$det=new CActiveDataProvider('Cantidad',array('criteria' => array(
						'condition' =>"idCaracteristicaVeh = '".$_GET['id']."'",
						'order'=>'id')));
		$this->render('iniciales',array(
			'dataProvider'=>$dataProvider,
			'det'=>$det,
		));
	}
	public function actionBuscarRepuesto(){
			$request=trim($_GET['term']);
			if($request!=''){
				$model=Repuesto::model()->findAll(array("condition"=>"repuesto like '%$request%'"));
				$data=array();
				foreach($model as $get){
					$data[]=$get->repuesto;
				}
				//$this->layout='empty';
				echo json_encode($data);
			}
		}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Repuesto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Repuesto']))
			$model->attributes=$_GET['Repuesto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Repuesto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Repuesto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Repuesto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='repuesto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
		
	public function actionSelectdos(){
		if(isset($_POST['Tiporepuesto']['id'])){
			$idmarca = $_POST['Tiporepuesto']['id'];
			$lista2=Subtiporepuesto::model()->findAll('idTipoRepuesto = :id',array(':id'=>$idmarca));
			
			foreach($lista2 as $li){
			
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->subTipo)),true);
				//CHTML::textField("campo",1,array(\'width\'=>4,\'maxlength\'=>4,\'onkeypress\'=>"return justNumbers(event)"))
			}
			
		}
	}
}
