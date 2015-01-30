<?php

class NeumaticosController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','plantilla','ActualizarListaPlantillas','MostrarLinkEje','actualizarListaPosicionesEje','MostrarLinkCaucho','actualizarEstado','MostrarLinkRep','MostrarDivRep','TieneGrupo','montajeInicial','montar','alertaCambioCauchos','ActualizarSpan','averiaNeumatico','RegistrarAveriaNeumatico','AgregarAveriaNueva','ajaxActualizarAverias','CrearOrdenNeumaticos','crearOrden','agregarNeumaticosRenovar','agregarNeumaticosRotar','verOrdenes','vistaPrevia','AgregarRotacionNueva'),
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
	public function actionAgregarAveriaNueva(){
		$model=new Fallacaucho;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Fallacaucho'])){
            $model->attributes=$_POST['Fallacaucho'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
				   
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la avería correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formNuevaAveria', array('model'=>$model), true)));
            exit;               
        }
	}
	public function actionAgregarRotacionNueva(){
		$model=new Rotacioncauchos;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
 
    if(isset($_POST['Rotacioncauchos'])){
            $model->attributes=$_POST['Rotacioncauchos'];
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
				   
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la rotación"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formNuevaRotacion', array('model'=>$model), true)));
            exit;               
        }
	}
	/*public function actionRegistrarAveriaNeumatico(){
		$model=new Detalleeventoca;
        // Uncomment the following line if AJAX validation is needed
         //$this->performAjaxValidation($model);
		 $idv=0;
		 
		$montados=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and idestatusCaucho=1"),'pagination' => false));
    if(isset($_POST['Detalleeventoca'])){
            $model->attributes=$_POST['Detalleeventoca'];
			$model->fechaFalla=date("Y-m-d", strtotime(str_replace('/', '-',$model->fechaFalla )));
            if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
				   
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la avería correctamente"
                        ));
                    exit;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formAveria', array('model'=>$model,'montados'=>$montados), true)));
            exit;               
        }
		
	}*/
	public function getOrdenesAbiertas(){
		$abiertas=Yii::app()->db->createCommand("select count(*) as total from sgu_ordenMtto where idestatus=5 and tipo=2")->queryRow();
		return $abiertas["total"];
	}
	public function getOrdenesListas(){
		$abiertas=Yii::app()->db->createCommand("select count(*) as total from sgu_ordenMtto where idestatus=6 and tipo=1")->queryRow();
		return $abiertas["total"];
	}
	public function getColor($tot){
		if($tot>0)
			return $color='important';
		else	
			return $color='';
	}
	public function actionAveriaNeumatico(){
		
		$model=new Detalleeventoca;
		/*$dataProvider=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
			'condition' =>'idestatus=8',
			//'order'=>'fechaFalla DESC'
			),
			'sort'=>array(
				'defaultOrder'=>'id DESC',),
				
			'pagination'=>array(
			'pageSize'=>5,)));*/
			$dataProvider=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
			'condition' =>'idestatus=8 and idfallaCaucho is not null',
			'order'=>'id'
			)));
			
			$idv=0;
			if(isset($_GET["idvehiculo"])){
				if($_GET["idvehiculo"]=="")
					$idv=0;
				else
					$idv=$_GET["idvehiculo"];
			}	
		$montados=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and idestatusCaucho=1"),'pagination' => false));
		$reg=0;
		if(isset($_POST['Detalleeventoca'])){	
			$model->attributes=$_POST['Detalleeventoca'];
			$model->fechaFalla=date("Y-m-d", strtotime(str_replace('/', '-', $_POST['Detalleeventoca']['fechaFalla'])));
			if($model->save()){
				$model->unsetAttributes();
				$reg=1;
				$this->render('averiaNeumatico',array(
					'dataProvider'=>$dataProvider,
					'montados'=>$montados,
					'model'=>$model,
					'registrado'=>$reg
				));
			}else
				$this->render('averiaNeumatico',array(
					'dataProvider'=>$dataProvider,
					'montados'=>$montados,
					'model'=>$model,
					'registrado'=>$reg
				));	
		}
		else{
			$this->render('averiaNeumatico',array(
				'dataProvider'=>$dataProvider,
				'montados'=>$montados,
				'model'=>$model,
				'registrado'=>$reg
			));
		}
	}
	public function actionPlantilla(){
		$ca=0;
		$idChasis=0;
		$ruedas=0;
		$idEje=0;
		
		if(isset($_GET["data"])){
			if($_GET["data"]=="")
				$_GET["data"]=0;
				$idChasis=$_GET["data"];
				$ca=$_GET["data"];
		}
		
		if(isset($_GET["idEje"])){
			if($_GET["idEje"]=="")
				$_GET["idEje"]=0;
			
			$idEje=$_GET["idEje"];
		}
		$chasis=new CActiveDataProvider('Chasis',array("criteria"=>array("condition"=>"id=".$idChasis."")));
		
		$ejes=new CActiveDataProvider("Detalleeje",array("criteria"=>array("condition"=>"idchasis=".$idChasis."")));
		
		$ruedas=new CActiveDataProvider('Detallerueda',array("criteria"=>array("condition"=>"iddetalleEje=".$idEje."")));
		
		$rep=new CActiveDataProvider('Cauchorep',array("criteria"=>array("condition"=>"idchasis=".$idChasis."")));
		
		$grup=new CActiveDataProvider('Asigchasis',array("criteria"=>array("condition"=>"idchasis=".$idChasis."")));
		
		$todo=new CActiveDataProvider('Asigchasis',array("criteria"=>array("condition"=>"1")));
		$this->render('plantilla',array(
			'chasis'=>$chasis,
			'llantas'=>$ejes,
			'ruedas'=>$ruedas,
			'rep'=>$rep,
			'ca'=>$ca,
			'grup'=>$grup,
			'todo'=>$todo,	
			'iniciales'=>$this->getPorDefinir()
			
		));
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
		$model=new Historicocaucho;
		$idv=1;
		$montados=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and idestatusCaucho=1"),'pagination' => false));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicocaucho']))
		{
			$model->attributes=$_POST['Historicocaucho'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array(
			'model'=>$model,
			'montados'=>$montados
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicocaucho']))
		{
			$model->attributes=$_POST['Historicocaucho'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionMontar($id){
		
		$model=$this->loadModel($id);

		if(isset($_POST['Historicocaucho'])){
			 $model->attributes=$_POST['Historicocaucho'];
			 $model->fecha=date("Y-m-d", strtotime(str_replace('/', '-',$model->fecha)));
			if($model->save()){
                if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Montaje realizado",
						'ui'=>$model->idvehiculo,
                        ));
					exit;
                }
            }
		}
			if (Yii::app()->request->isAjaxRequest){	
				if($model->iddetalleRueda=="")
					$model->idestatusCaucho=4;
				else
					$model->idestatusCaucho=1;
			
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formMD', array('model'=>$model), true),
				'ui'=>$model->idvehiculo,
				));
            exit;               
        }
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
		$montados=array();
		$rep=array();
		$veh=array();
		$idveh=Vehiculo::model()->findAll();
		$reposicionDias=Parametro::model()->findByAttributes(array('nombre'=>'alertaCambioCauchos'));
		$totFalla=Yii::app()->db->createCommand("select count(*) as total from sgu_detalleEventoCa where idestatus=8 and idfallaCaucho is not null")->queryRow();
		if(isset($_POST["Vehiculo"])){
			if($_POST["Vehiculo"]["id"]==""){
				foreach($idveh as $idv){
					$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=1 and idvehiculo=".$idv["id"]."")));
					$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=4 and idvehiculo=".$idv["id"]."")));
					$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
				}
			}else{
				$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=1 and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
				$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=4 and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
			$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$_POST["Vehiculo"]["id"]."","limit"=>"1"),'pagination' => false));
			
			}
		
		}else
			foreach($idveh as $idv){
				
			$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=1 and idvehiculo=".$idv["id"]."")));
			$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idestatusCaucho=4 and idvehiculo=".$idv["id"]."")));
		    $veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
		}
			
		$this->render('index',array(
			'montados'=>$montados,
			'rep'=>$rep,
			'veh'=>$veh,
			'iniciales'=>$this->getPorDefinir(),
			'reposicionDias'=>$reposicionDias["valor"],
			'totalFalla'=>$totFalla["total"],
			'listas'=>$this->getOrdenesListas(),
			'abiertas'=>$this->getOrdenesAbiertas(),
			
		));
	}
		public function actionVistaPrevia($id,$nom,$dir){
		$orden=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id='.$id."")
			,'pagination'=>array('pageSize'=>9999999)));
			
		// and idfallaCaucho is not null (para solo fallas)
		$idvehiculoAver=Yii::app()->db->createCommand("select distinct(h.idvehiculo), count(*) as totAct from sgu_detalleEventoCa de, sgu_detOrdNeumatico d, sgu_historicoCaucho h where de.idfallaCaucho is not null and de.idhistoricoCaucho=h.id and de.id=d.iddetalleEventoCa and d.idordenMtto=".$id." group by h.idvehiculo")->queryAll();
		$totalVehAver=count($idvehiculoAver);
		//necesario cuando no existan averias
		if($totalVehAver==0){
			$vehiculosAver[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="0"',
			)));
			$actividadesAver[][]=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
				'condition' =>'id="0"',
			)));
			$recursosAver[][]=new CActiveDataProvider('Detreccaucho',array('criteria' => array(
				'condition' =>'iddetalleEventoCa="0"',
			)));
		}
		
		for($i=0;$i<$totalVehAver;$i++){
			
			$vehiculosAver[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="'.$idvehiculoAver[$i]["idvehiculo"].'"',
			)));
			
		$totAct=Yii::app()->db->createCommand('select iddetalleEventoCa as id from sgu_detOrdNeumatico where idordenMtto="'.$id.'" and iddetalleEventoCa in(select de.id from sgu_detalleEventoCa de, sgu_historicoCaucho h where h.id=de.idhistoricoCaucho and de.idfallaCaucho is not null and h.idvehiculo="'.$idvehiculoAver[$i]["idvehiculo"].'")')->queryAll();
		
		for($j=0;$j<$idvehiculoAver[$i]["totAct"];$j++){		
				$actividadesAver[$i][$j]=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
				'condition' =>'id="'.$totAct[$j]["id"].'"',
				)));
				$recursosAver[$i][$j]=new CActiveDataProvider('Detreccaucho',array('criteria' => array(
				'condition' =>'iddetalleEventoCa="'.$totAct[$j]["id"].'"',
				)));
			}
		}
		//para solo renovaciones and idaccionCaucho=1
		$idvehiculoMont=Yii::app()->db->createCommand("select distinct(h.idvehiculo), count(*) as totAct from sgu_detalleEventoCa de, sgu_detOrdNeumatico d, sgu_historicoCaucho h where de.idaccionCaucho=1 and de.idhistoricoCaucho=h.id and de.id=d.iddetalleEventoCa and d.idordenMtto=".$id." group by h.idvehiculo")->queryAll();
		$totalVehMont=count($idvehiculoMont);
		//necesario cuando no existan renovaciones
		
		if($totalVehMont==0){
			$vehiculosMont[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="0"',
			)));
			$actividadesMont[][]=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
				'condition' =>'id="0"',
			)));
		}
		
		for($i=0;$i<$totalVehMont;$i++){
			$vehiculosMont[]=new CActiveDataProvider('Vehiculo',array('criteria' => array(
			'condition' =>'id="'.$idvehiculoMont[$i]["idvehiculo"].'"',
			)));
		
				$actividadesMont[$i]=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
				'condition' =>'id in (select iddetalleEventoCa as id from sgu_detOrdNeumatico where idordenMtto="'.$id.'" and iddetalleEventoCa in(select de.id from sgu_detalleEventoCa de, sgu_historicoCaucho h where h.id=de.idhistoricoCaucho and idaccionCaucho=1 and h.idvehiculo="'.$idvehiculoMont[$i]["idvehiculo"].'"))',
				)));
		}
		//para solo rotaciones and idaccionCaucho=2
		$Rot=Yii::app()->db->createCommand("select de.idrotacionCauchos as id,count(de.idrotacionCauchos) as totRot from sgu_detOrdNeumatico d, sgu_detalleEventoCa de where d.iddetalleEventoCa=de.id and d.idordenMtto=".$id." and de.idaccionCaucho=2 group by de.idrotacionCauchos")->queryAll();
		$totalRot=count($Rot);
		
		//necesario cuando no existan rotaciones
		if($totalRot==0){
			$Rotaciones[$i]=new CActiveDataProvider('Rotacioncauchos',array('criteria' => array(
				'condition' =>'id=0',
				)));
				
		$actividadesRot[$i]=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
				'condition' =>'idrotacionCauchos=0',
				)));
		}
		
		for($i=0;$i<$totalRot;$i++){
		$Rotaciones[$i]=new CActiveDataProvider('Rotacioncauchos',array('criteria' => array(
				'condition' =>'id="'.$Rot[$i]["id"].'"',
				)));
				
		$actividadesRot[$i]=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
				'condition' =>'idrotacionCauchos="'.$Rot[$i]["id"].'"',
				)));	
		}
		
		$totFactura=Yii::app()->db->createCommand('select (round(sum(ar.costoTotal),2)) as Total from sgu_detRecCaucho ar, sgu_detOrdNeumatico d where d.iddetalleEventoCa=ar.iddetalleEventoCa and d.idordenMtto="'.$id.'"')->queryRow();

		$factura=new CActiveDataProvider('Factura',array('criteria' => array(
			'condition'=>'idordenMtto="'.$id.'"'),
			'pagination'=>array('pageSize'=>9999999)));
			
		$this->render('vistaPrevia',array(
			'vehiculosAver'=>$vehiculosAver,
			'totalVehAver'=>$totalVehAver,
			'actividadesAver'=>$actividadesAver,
			'idvehiculoAver'=>$idvehiculoAver,
			'recursosAver'=>$recursosAver,
			
			'vehiculosMont'=>$vehiculosMont,
			'totalVehMont'=>$totalVehMont,
			'actividadesMont'=>$actividadesMont,
			'idvehiculoMont'=>$idvehiculoMont,
			
			'Rotaciones'=>$Rotaciones,
			'actividadesRot'=>$actividadesRot,
			'totalRot'=>$totalRot,
			
			'orden'=>$orden,
			'factura'=>$factura,
			'totFactura'=>$totFactura,
			'nom'=>$nom,
			'dir'=>$dir,
		));
	
	}
	public function actionVerOrdenes(){
		$dataProvider=new CActiveDataProvider('Ordenmtto',array('criteria' => array(
			'condition' =>'id in (select id from sgu_ordenMtto where (idestatus=5 or idestatus=6) and tipo=2)',
			'order'=>'idestatus '
			)));
		$this->render('verOrdenes',array(
			'dataProvider'=>$dataProvider,
			'abiertas'=>$this->getOrdenesAbiertas(),
			'color'=>$this->getColor($this->getOrdenesAbiertas()),
			'listas'=>$this->getOrdenesListas(),
			));
	}
	
	public function actionAgregarNeumaticosRenovar(){
		if(isset($_POST["ids"])){
			 foreach ($_POST["ids"] as $ids){ 
				$model = new Detalleeventoca;
				$model->fechaFalla=date("Y-m-d");
				$model->fechaRealizada="0000-01-01";
				$model->idaccionCaucho=1;
				$model->idhistoricoCaucho=$ids;
				$model->idestatus=8;
				$model->save();
			}
            echo CJSON::encode(array(
                'status'=>'neumáticos agregados', 
				));
            exit;
		}	 
	}
	public function actionAgregarNeumaticosRotar(){
		if(isset($_POST["origen"]) and isset($_POST["destino"])and isset($_POST["idRot"])) {
			$origen=Historicocaucho::model()->findByPk($_POST["origen"][0]);
			$destino=Historicocaucho::model()->findByPk($_POST["destino"][0]);
			$idrot=$_POST["idRot"][0];
			
				$model = new Detalleeventoca;
				$model->fechaFalla=date("Y-m-d");
				$model->fechaRealizada="0000-01-01";
				$model->idaccionCaucho=2;
				$model->idhistoricoCaucho=$origen->id;
				$model->posicionOrigen=$origen->iddetalleRueda;
				$model->cauchoOrigen=$origen->id;
				$model->posicionDestino=$destino->iddetalleRueda;
				$model->cauchoDestino=$destino->id;
				$model->idestatus=8;
				$model->idrotacionCauchos=$idrot;
				$model->save();
				
				$model = new Detalleeventoca;
				$model->fechaFalla=date("Y-m-d");
				$model->fechaRealizada="0000-01-01";
				$model->idaccionCaucho=2;
				$model->idhistoricoCaucho=$destino->id;
				$model->posicionOrigen=$destino->iddetalleRueda;
				$model->cauchoOrigen=$destino->id;
				$model->posicionDestino=$origen->iddetalleRueda;
				$model->cauchoDestino=$origen->id;
				$model->idestatus=8;
				$model->idrotacionCauchos=$idrot;
				$model->save();
			}
            echo CJSON::encode(array(
                'status'=>'Rotación agregada', 
				));
            exit;
		 
	}
	public function actionCrearOrden(){
		$model=new Ordenmtto;
		if(isset($_POST['Ordenmtto'])){
            $model->attributes=$_POST['Ordenmtto'];
            if($model->save()){
			if(isset($_POST['idfalla'])){
				if($_POST['idfalla']!=""){
				$fal = explode(",", $_POST['idfalla']);
				foreach($fal as $idfal){
					Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_detOrdNeumatico` (`iddetalleEventoCa`,`idordenMtto`) VALUES (".$idfal.",".$model->id.")")->query();
					Yii::app()->db->createCommand("update `tsg`.`sgu_detalleEventoCa` set `idestatus` = '4' where `sgu_detalleEventoCa`.`id` = ".$idfal."")->query();
					}
				}
			}
			if(isset($_POST['idren'])){
				if($_POST['idren']!=""){
				$ren = explode(",", $_POST['idren']);
				foreach($ren as $idren){
					Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_detOrdNeumatico` (`iddetalleEventoCa`,`idordenMtto`) VALUES (".$idren.",".$model->id.")")->query();
					Yii::app()->db->createCommand("update `tsg`.`sgu_detalleEventoCa` set `idestatus` = '4' where `sgu_detalleEventoCa`.`id` = ".$idren."")->query();
					}	
				}
			}
			if(isset($_POST['idrot'])){
				if($_POST['idrot']!=""){
				$rot = explode(",", $_POST['idrot']);
				foreach($rot as $idrot){
					Yii::app()->db->createCommand("update `tsg`.`sgu_rotacionCauchos` set `idestatus` = '4' where `sgu_rotacionCauchos`.`id` = ".$idrot."")->query();
					$id=Yii::app()->db->createCommand("select id from sgu_detalleEventoCa where idrotacionCauchos=".$idrot."")->queryAll();
					for($i=0;$i<count($id);$i++){
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_detOrdNeumatico` (`iddetalleEventoCa`,`idordenMtto`) VALUES (".$id[$i]['id'].",".$model->id.")")->query();
						Yii::app()->db->createCommand("update `tsg`.`sgu_detalleEventoCa` set `idestatus` = '4' where `sgu_detalleEventoCa`.`id` = ".$id[$i]['id']."")->query();
						}
					}
				}
			}
			
                if (Yii::app()->request->isAjaxRequest){
				   /*inserts por debajo del plan de mantenimiento a cada vehiculo del grupo*/
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se creo la orden de mantenimiento"
                        ));
					exit;
                }
            }
        }
		 if (Yii::app()->request->isAjaxRequest){	
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formCrearOrden', array('model'=>$model), true)
				));
            exit;               
        }
	}
	public function actionCrearOrdenNeumaticos(){
		
		//$modeloOrdenMtto=new Ordenmtto;
		$idRot=0;
		$idv=0;
			if(isset($_GET["idvehiculo"])){
				if($_GET["idvehiculo"]=="")
					$idv=0;
				else
					$idv=$_GET["idvehiculo"];
			}	
			/*ojo con and idestatus=8 */
		$montados=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and idestatusCaucho=1 and id not in (select idhistoricoCaucho from sgu_detalleEventoCa where idaccionCaucho=1 and (idestatus=8 or idestatus=4))"),'pagination' => false));
		
		$montadosR=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv." and (idestatusCaucho=1 or idestatusCaucho=4) and id not in (select idhistoricoCaucho from sgu_detalleEventoCa where idaccionCaucho=2 and (idestatus=8 or idestatus=4))"),'pagination' => false));
		
		$fallas=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
			//'condition' =>'idestatus=2 and atraso >=-5',
			'condition' =>'idestatus=8 and idfallaCaucho is not null',
			'order'=>'id'
			)));
		$renovaciones=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
			'condition' =>'idaccionCaucho=1 and idestatus=8',
			//'order'=>'fechaFalla'
			)));
		$rotaciones=new CActiveDataProvider('Rotacioncauchos',array('criteria' => array(
			'condition' =>'idestatus=8',
			//'order'=>'fechaFalla'
			)));
		if(isset($_GET["idRot"])){
			$idRot=$_GET["idRot"];
		}
		$movimientos=new CActiveDataProvider('Detalleeventoca',array('criteria' => array(
			'condition' =>'idrotacionCauchos='.$idRot.'',
			//'order'=>'fechaFalla'
			)));
			
		$this->render('crearOrdenNeumaticos',array(
			'dataProvider'=>$fallas,
			'listas'=>$this->getOrdenesListas(),
			'abiertas'=>$this->getOrdenesAbiertas(),
			'montados'=>$montados,
			'renovaciones'=>$renovaciones,
			'rotaciones'=>$rotaciones,
			'montadosR'=>$montadosR,
			'movimientos'=>$movimientos,
		));
	}
	
	public function actionMontajeInicial(){
		$montados=array();
		$rep=array();
		$veh=array();
		$idveh=Vehiculo::model()->findAll();
		
		if(isset($_POST["Vehiculo"])){
			if($_POST["Vehiculo"]["id"]==""){
				foreach($idveh as $idv){
					$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=5 or idestatusCaucho=1) and idvehiculo=".$idv["id"]."")));
					$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=6 or idestatusCaucho=4) and idvehiculo=".$idv["id"]."")));
					$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
				}
			}else{
				$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=5 or idestatusCaucho=1) and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
				$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=6 or idestatusCaucho=4) and idvehiculo=".$_POST["Vehiculo"]["id"]."")));
				$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$_POST["Vehiculo"]["id"]."","limit"=>"1"),'pagination' => false));
			}
		}else
			foreach($idveh as $idv){
				$montados[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=5 or idestatusCaucho=1) and idvehiculo=".$idv["id"]."")));
				$rep[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"(idestatusCaucho=6 or idestatusCaucho=4) and idvehiculo=".$idv["id"]."")));
				$veh[]=new CActiveDataProvider('Historicocaucho',array("criteria"=>array("condition"=>"idvehiculo=".$idv["id"]."","limit"=>"1"),'pagination' => false));
		}
		$this->render('montajeInicial',array(
			'montados'=>$montados,
			'rep'=>$rep,
			'veh'=>$veh
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Historicocaucho('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Historicocaucho']))
			$model->attributes=$_GET['Historicocaucho'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Historicocaucho the loaded model
	 * @throws CHttpException
	 */
	 public function getPorDefinir(){
		$tot=Yii::app()->db->createCommand("select count(*) as total from sgu_historicoCaucho where idestatusCaucho=5 or idestatusCaucho=6")->queryRow();
		return $tot["total"];
	}
	
	public function Color($id){
		if($id>0)
			return "important";
		else	
			return "";
	}
	public function loadModel($id)
	{
		$model=Historicocaucho::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Historicocaucho $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historicocaucho-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionActualizarListaPlantillas(){
		
		$models = Chasis::model()->findAll('1 order by id DESC');
		foreach ($models as $mode){
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($mode->nombre)),true);
		}
	}
	public function actionMostrarLinkEje($id){
		if($id==0){
			echo 1;
			return 0;
		}
		$chasis=Chasis::model()->findByPk($id);
		$ejes=new CActiveDataProvider("Detalleeje",array("criteria"=>array("condition"=>"idchasis=".$id."")));
		$totalEjes=$ejes->getTotalItemCount();
		if($totalEjes<$chasis->nroEjes)
			echo 0;
		else
			echo 1;
	}
	public function actionMostrarDivRep($id){
		if($id==0){
			echo 0;
			return 0;
		}
		$chasis=Chasis::model()->findByPk($id);
		if($chasis->cantidadRepuesto==0)
			echo 0;
		else
			echo 1;
	}
	public function actionMostrarLinkCaucho($id){
		if($id==0){
			echo 1;
			return 0;
		}
		$eje=Detalleeje::model()->findByPk($id);
		$ruedas=new CActiveDataProvider("Detallerueda",array("criteria"=>array("condition"=>"iddetalleEje=".$id."")));
		$totalRuedas=$ruedas->getTotalItemCount();
		if($totalRuedas<$eje->nroRuedas)
			echo 0;
		else
			echo 1;
	}
	public function actionTieneGrupo(){
		/*if($id==0){
			echo 2;
			return 0;
		}
		$gru=new CActiveDataProvider("Asigchasis",array("criteria"=>array("condition"=>"idchasis=".$id."")));
		$totalRuedas=$gru->getTotalItemCount();
		
		if($totalRuedas>0)
			echo 0;
		else
			echo 1;*/
		
			$lista2=Grupo::model()->findAll('id not in (select idgrupo from sgu_asigChasis)');
			echo CHtml::tag('option',array('type'=>'text','value'=>""),Chtml::encode("Seleccione: "),true);
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->grupo)),true);
			}
		
	}
	public function actionMostrarLinkRep($id){
		if($id==0){
			echo 1;
			return 0;
		}
		
		$rep=new CActiveDataProvider("Cauchorep",array("criteria"=>array("condition"=>"idchasis=".$id."")));
		$total=$rep->getTotalItemCount();
		if($total<1)
			echo 0;
		else
			echo 1;
	}
	public function actionActualizarListaPosicionesEje(){
	
			$lista2=Posicioneje::model()->findAll('1 order by id desc');
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->posicionEje)),true);
		}
	}
	
	public function actionActualizarEstado($id){
		if($id==0){
			echo -1;
			return 0;
		}			
			$ruedasTiene=Yii::app()->db->createCommand("select count(*) as total from sgu_chasis c, sgu_detalleEje de, sgu_detalleRueda dr where c.id=de.idchasis and de.id=dr.iddetalleEje and c.id=".$id."")->queryRow();
			$rTiene=$ruedasTiene["total"];
			$rep=Yii::app()->db->createCommand("select count(*) as total from sgu_cauchoRep cr, sgu_chasis c where c.id=cr.idchasis and c.id=".$id."")->queryRow();
			$cant=Chasis::model()->findByPk($id);
			$ruedasDebe=$cant->cantidadNormales;
			if($cant->cantidadRepuesto>0)
				$ruedasDebe=$ruedasDebe+1;
			$rTiene=$rTiene+$rep["total"];
			
		if($rTiene==$ruedasDebe)
			echo 1;
		if($rTiene>$ruedasDebe)
			echo 2;
		if($rTiene<$ruedasDebe)
			echo 0;
	
	}
	public function actionalertaCambioCauchos($id){
		$modelo=Parametro::model()->findByAttributes(array('nombre'=>'alertaCambioCauchos'));
		$modelo->valor=$id;
		$modelo->save();
	}
	public function actionActualizarSpan(){
		$mi=Yii::app()->db->createCommand("select count(*) as total from sgu_historicoCaucho where idestatusCaucho=5 or idestatusCaucho=6")->queryRow();
		
		echo CJSON::encode(array(
			'total'=>$mi["total"],
			'color'=>$this->Color($mi["total"]),
		));
	}
	public function actionAjaxActualizarAverias(){
		
		$models = Fallacaucho::model()->findAll('id<>0 order by id DESC');
		foreach ($models as $mode){
			echo CHtml::tag('option',array('type'=>'text','value'=>(($mode->id))),Chtml::encode(($mode->falla)),true);
		}
	}
}
