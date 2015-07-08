<?php

class VehiculoController extends Controller
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
				'actions'=>array('index','view','detallePieza','fotos','Selectdos','Getdatos','buscarRepuesto','parametros','buscarRecurso'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Desincorporar','historico','detalleHistorico','RegistrarVehiculo','seleccionarRecurso'),
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
	/*public function actionverDetalle($id){
		
		$consulta=Yii::app()->db->createCommand('select r.repuesto, c.detallePieza, c.codigoPiezaEnUso, c.fechaIncorporacion from  sgu_Cantidad c, sgu_repuesto r, sgu_CaracteristicaVeh cv where c.idCaracteristicaVeh="'.$id.'" and
			r.id=cv.idrepuesto and cv.id=c.idcaracteristicaveh')->queryAll();
			
		$detalle=new CArrayDataProvider($consulta, array('keyField'=>'repuesto','pagination'=>array(
      'pageSize'=>100,
     ),));
		$idVeh=Yii::app()->db->createCommand('select idvehiculo from sgu_CaracteristicaVeh where id="'.$id.'"')->queryRow();
		$idv=new CArrayDataProvider($idVeh, array('keyField'=>'idvehiculo'));
		$this->render('verDetalle',array(
            'model'=>$detalle,
			'id'=>$idv->getData(),
            ),false,TRUE);
	}
	public function actionagregarDetalle($id){
	 $data=$id;
	if(isset($_GET['cod'])){
		$dat=$_GET['cod'];
		$fec=$_GET['fecha'];
		$datos= explode(",",$dat);
		$fecha = explode(",",$fec);
		
		$detalles=Yii::app()->db->createCommand('select id from sgu_Cantidad where idCaracteristicaVeh="'.$data.'"')->queryAll();
		$total=count($detalles);
		
		for($i=0;$i<$total;$i++){
			Yii::app()->db->createCommand('UPDATE `tsg`.`sgu_Cantidad` SET `fechaIncorporacion` ="'.$fecha[$i].'" ,`codigoPiezaEnUso` = "'.$datos[$i].'" WHERE `sgu_Cantidad`.`id` = '.$detalles[$i]['id'])->query();
		}
	}
	$idVeh=Yii::app()->db->createCommand('select idvehiculo as id from sgu_CaracteristicaVeh where id="'.$id.'"')->queryRow();
		$idv=new CArrayDataProvider($idVeh, array('keyField'=>'idvehiculo'));
	
	$var=new CActiveDataProvider('Cantidad',array(
                    'criteria'=>array(                          
                      'condition'=>'t.idcaracteristicaveh='.$data,
                  ),
                    ));
					
		$this->render('agregarDetalle',array(
            'model'=>$var,
			'id'=>$data,
			'idveh'=>$idv->getData(),
            ));
	}*/

	public function actionBuscarRecurso(){
			$request=trim($_GET['term']);
			if($request!=''){
				$insumo=Insumo::model()->findAll(array("condition"=>"insumo like '%$request%'"));
				$repuesto=Repuesto::model()->findAll(array("condition"=>"repuesto like '%$request%'"));
				$servicio=Servicio::model()->findAll(array("condition"=>"servicio like '%$request%'"));
				$data=array();
				foreach($insumo as $get){
					$model=Tipoinsumo::model()->findByPk($get->tipoInsumo);
					$data[]=array(
						'id'=>$get->id,
						'label'=>$get->insumo,
						'value'=>$get->insumo,
						'desc'=>'Tipo: Insumo->'.$model->tipo,
						'tipo'=>1,
					);
				}
				foreach($repuesto as $get){
					$sub=Subtiporepuesto::model()->findByPk($get->idsubTipoRepuesto);
					$tip=Tiporepuesto::model()->findByPk($sub->idTipoRepuesto); 
					$data[]=array(
						'id'=>$get->id,
						'label'=>$get->repuesto,
						'value'=>$get->repuesto,
						'desc'=>'Tipo: Repuesto->'.$tip->tipo.'->'.$sub->subTipo,
						'tipo'=>2,
					);
				}
				foreach($servicio as $get){
					$data[]=array(
						'id'=>$get->id,
						'label'=>$get->servicio,
						'value'=>$get->servicio,
						'desc'=>'Tipo: Servicio',
						'tipo'=>3,
					);
				}
				//$this->layout='empty';
				echo json_encode($data);
			}
	}
	public function actionSeleccionarRecurso(){
		if(isset($_POST["idtipo"])){
			if($_POST["idtipo"]==1){
				$ins=Insumo::model()->findByPk($_POST["idrecurso"]);
				$tipoInsumo=Subtiporepuesto::model()->findByPk($ins->tipoInsumo);
				
				echo CJSON::encode(array(
	                'idTipo'=>$_POST["idtipo"],
	                'idTipoIns'=>$tipoInsumo->id, 
	                'idInsumo'=>$_POST["idrecurso"],
	            ));
            		exit;    
			}
			if($_POST["idtipo"]==2){
				$rep=Repuesto::model()->findByPk($_POST["idrecurso"]);
				$sub=Subtiporepuesto::model()->findByPk($rep->idsubTipoRepuesto);
				$tipo=Tiporepuesto::model()->findByPk($sub->idTipoRepuesto);
				echo CJSON::encode(array(
	                'idTipo'=>$_POST["idtipo"], 
	                'idTipoRep'=>$tipo->id, 
	                'idSubTipo'=>$sub->id, 
	                'idRepuesto'=>$rep->id,
	            ));
            		exit; 
			}
			if($_POST["idtipo"]==3){
				echo CJSON::encode(array(
	                'idTipo'=>$_POST["idtipo"], 
	                'idServicio'=>$_POST["idrecurso"],
	            ));
            		exit; 
			}
		}
	}
	public function actiondetallePieza($id){ 
	if (isset($_GET['idetalle'])){ 
			$idetalle=$_GET['idetalle'];
		}else{
			$idetalle="0";
		}
		
	$var=new CActiveDataProvider('CaracteristicaVeh',array(
        'criteria'=>array(
		  'select' => 'max(t.id) as id, t.cantidad, t.idvehiculo, t.idrepuesto' ,
          'condition'=>'t.idvehiculo=0',
		  'group'=>'t.idvehiculo, t.idrepuesto')));
					  
	$dataProvider=new CActiveDataProvider('CaracteristicaVeh',array(
        'criteria'=>array(
		  /*'select' => 'max(t.id) as id, t.cantidad, t.idvehiculo, t.idrepuesto' ,*/
          'condition'=>'t.idrepuesto in (select id from sgu_repuesto order by idsubTipoRepuesto ASC ) and t.idvehiculo="'.$id.'"',
		  /*'group'=>'t.idvehiculo, t.idrepuesto',*/
      ),
	  'pagination'=>array(
		'pageSize'=>9999,
		),
        ));
	$detalle=new CActiveDataProvider('Cantidad',array(
                    'criteria'=>array(                          
                      'condition'=>'t.idCaracteristicaVeh="'.$idetalle.'"'),'pagination'=>array('pageSize'=>9999,),));
					  
	$det=new CActiveDataProvider('Cantidad',array(
                    'criteria'=>array(                          
                      'condition'=>'t.idCaracteristicaVeh=0'),'pagination'=>array('pageSize'=>9999,),));

		$this->render('detallePieza',array(
			'model'=>$dataProvider,
			'id'=>$id,
			'vacio'=>$var,
			'detvacio'=>$det,
			'detalle'=>$detalle
		));
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionDesincorporar($id)
	{
		$model=new Historicoedos;
		$vehiculo=Vehiculo::model()->findByPk($id);
		$msg="";
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Historicoedos']))
		{
			$estado=Yii::app()->db->createCommand("select he.idestado, e.estado from sgu_historicoEdos he, sgu_estado e where e.id=he.idestado and he.idvehiculo='".$vehiculo->id."' order by he.id desc limit 1")->queryRow();
			$model->attributes=$_POST['Historicoedos'];
			
			if($model->validate()){
				if($estado["idestado"]==1){
					if($model->save()){
						$vehiculo->activo=0;
						$vehiculo->update();
						$this->redirect(array('historico'));
					}
				}
				else
					$msg='Verifique primero que el vehiculo no se encuentre en mantenimiento o averiado';
			}
		}

		$this->render('desincorporar',array(
			'model'=>$model,
			'vehiculo'=>$vehiculo,
			'msg'=>$msg
		));
	}
	public function actionDetalleHistorico($id)
	{	
		$dataProvider=new CActiveDataProvider('Informacion',array(
                    'criteria'=>array(
                      'condition'=>'t.idvehiculo='.$id),
				  'pagination'=>array(
					'pageSize'=>9999,
					),
                    ));
					
		$this->render('detalleHistorico',array(
			'model'=>$this->loadModel($id),
			'dataProvider'=>$dataProvider,
			
		));
	}
	public function actionView($id)
	{	
		$dataProvider=new CActiveDataProvider('Informacion',array(
                    'criteria'=>array(
                      'condition'=>'t.idvehiculo='.$id),
				  'pagination'=>array(
					'pageSize'=>9999,
					),
                    ));
					
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'dataProvider'=>$dataProvider,
			
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Vehiculo;
		$marca=new Marca;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vehiculo']))
		{
			$model->attributes=$_POST['Vehiculo'];
			if($model->save()){
				/*estatus inicial activo*/
				$model->setEstado(1,"Se registró el vehiculo");
				/*insertar km inicial en tabla kilometraje*/
				$km=new Kilometraje();
				$km->fecha=date('Y-m-d');
				$km->lectura=$model->KmInicial;
				$km->idvehiculo=$model->id;
				$km->save();
			/*inserta informacion adicional*/
				$totalVeh=Yii::app()->db->createCommand('select informacion from sgu_infGrupo where idgrupo="'.$model->idgrupo.'"')->queryAll();
				$total=count($totalVeh);
				if($total>0){
					for($i=0;$i<$total;$i++){
					
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_informacion` (`idvehiculo`,`informacion`) 
						VALUES ('".$model->id."','".$totalVeh[$i]["informacion"]."')")->query();
					}
				}
				/*inserta piezas al grupo que fue asignado*/
				$totalInf=Yii::app()->db->createCommand('select * from sgu_CaracteristicaVehGrupo where idgrupo="'.$model->idgrupo.'"')->queryAll();
				$totDet=Yii::app()->db->createCommand('select * from sgu_CantidadGrupo where idCaracteristicaVehGrupo in ( select id from sgu_CaracteristicaVehGrupo where idgrupo="'.$model->idgrupo.'")')->queryAll();
				$k=0;
				$total=count($totalInf);
				if($total>0){
					for($i=0;$i<$total;$i++){
						Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_CaracteristicaVeh` (`idvehiculo`,`idrepuesto`,`cantidad`) 
						VALUES ('".$model->id."','".$totalInf[$i]["idrepuesto"]."','".$totalInf[$i]["cantidad"]."')")->query();
						$max=Yii::app()->db->createCommand("select max(id) as id from sgu_CaracteristicaVeh")->queryRow();
						
						for($j=0;$j<$totalInf[$i]["cantidad"];$j++){
								Yii::app()->db->createCommand("INSERT ignore INTO `tsg`.`sgu_Cantidad` (`idCaracteristicaVeh`,`detallePieza`) 
								VALUES ('".$max['id']."','".$totDet[$k]["detallePieza"]."')")->query();
								$k++;
							}
					}
				}
				/*insertar actividades de mtto preventivo en el vehiculo*/
				$null='NULL';
				$actividadesGrupo= Actividadesgrupo::model()->findAll('idgrupo="'.$model->idgrupo.'"');
				foreach ($actividadesGrupo as $actgrupo) {
					$actividades=new Actividades;
					$actividades->idactividadMtto=$actgrupo->idactividadMtto;
					$actividades->frecuenciaKm=$actgrupo->frecuenciaKm;
					$actividades->frecuenciaMes=$actgrupo->frecuenciaMes;
					$actividades->duracion=$actgrupo->duracion;
					$actividades->idprioridad=$actgrupo->idprioridad;
					$actividades->idvehiculo=$model->id;
					$actividades->idtiempod=$actgrupo->idtiempod;
					$actividades->idtiempof=$actgrupo->idtiempof;
					$actividades->idactividadesGrupo=$actgrupo->id;
					$actividades->idestatus=1;
					$actividades->procedimiento=$actgrupo->procedimiento;
					$actividades->inicial=1;
					$actividades->save();
					$recursoGrupo=Actividadrecursogrupo::model()->findAll('idactividadesGrupo="'.$actgrupo->id.'"');
						foreach ($recursoGrupo as $recgrupo) {
							Yii::app()->db->createCommand("INSERT INTO `tsg`.`sgu_actividadRecurso` (`cantidad`,`idactividades`,`idinsumo`,`idrepuesto`,`idservicio`,`idunidad`,`detalle`,`idactividadRecursoGrupo`)
							VALUES (".$recgrupo->cantidad.",".$actividades->id.",".($recgrupo->idinsumo==null?$null:$recgrupo->idinsumo).",".($recgrupo->idrepuesto==null?$null:$recgrupo->idrepuesto).",".($recgrupo->idservicio==null?$null:$recgrupo->idservicio).",".$recgrupo->idunidad.",'".$recgrupo->detalle."',".$recgrupo->id.")")->query();
						}
				}	
				/*insertar los neumaticos en el vehiculo*/
				$asigChasis=Asigchasis::model()->find("idgrupo='".$model->idgrupo."'");
				$ruedas=Yii::app()->db->createCommand("select dr.idcaucho, dr.id from sgu_detalleRueda dr, sgu_detalleEje de, sgu_chasis c where dr.iddetalleEje=de.id and de.idchasis=c.id and de.idchasis='".$asigChasis["idchasis"]."'")->queryAll();
				$repuesto=Yii::app()->db->createCommand("select * from sgu_chasis c, sgu_cauchoRep cr where c.id=cr.idchasis and cr.idchasis='".$asigChasis["idchasis"]."'")->queryRow();
				foreach($ruedas as $rue){
						$historico=new Historicocaucho;
						$historico->idasigChasis=$asigChasis["id"];
						$historico->idvehiculo=$model->id;
						$historico->iddetalleRueda=$rue["id"];
						$historico->idcaucho=$rue["idcaucho"];
						$historico->idestatusCaucho=5;
						$historico->inicial=1;
						$historico->save(false);	
				}
				for($i=0;$i<$repuesto["cantidadRepuesto"];$i++){
						$historico=new Historicocaucho;
						$historico->idasigChasis=$asigChasis["id"];
						$historico->idvehiculo=$model->id;
						$historico->idcaucho=$repuesto["idcaucho"];
						$historico->idestatusCaucho=6;
						$historico->inicial=1;
						$historico->save(false);	
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		if(isset($_GET["grupo"]))
		$this->render('create',array(
			'model'=>$model,
			'marca'=>$marca,
			'grupo'=>$_GET["grupo"]
		));
		else		
		$this->render('create',array(
			'model'=>$model,
			'marca'=>$marca,
		));
	}
	public function RegistrarVehiculo(){
            $model=new Vehiculo;
            if(isset($_POST['Vehiculo'])){
                $model->attributes=$_POST['Vehiculo'];
                if($model->save()){
                    echo "Vehiculo registrado correctamente\n";
                    return true;
                }
                else{
                    echo "No se pudo registrar el vehiculo, verifique los datos ingresados";
                    return false;
                }	
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
		$marca= new Marca();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vehiculo']))
		{
			$model->attributes=$_POST['Vehiculo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'marca'=>$marca,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	
		try{
			
			$this->loadModel($id)->delete();
				if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}catch(CDbException $e){
			echo CHtml::decode(" No se pudo eliminar el vehiculo porque tiene iniformación asociada");
		}
	}
	public function actionParametros(){
		$idmarca=0;
		$gridMarca=new CActiveDataProvider('Marca',array('criteria' => array(
		'condition' =>"1",
		'order'=>'id')));

		if(isset($_GET["idmarca"]))
			$idmarca=$_GET["idmarca"];

		$gridModelo=new CActiveDataProvider('Modelo',array('criteria' => array(
		'condition' =>"idMarca='".$idmarca."'",
		'order'=>'id')));

		$gridColor=new CActiveDataProvider('Color',array('criteria' => array(
		'condition' =>"1",
		'order'=>'id')));

		$gridPropiedad=new CActiveDataProvider('Propiedad',array('criteria' => array(
		'condition' =>"1",
		'order'=>'id')));
		
		$this->render('parametros',array(
			'gridMarca'=>$gridMarca,
			'gridModelo'=>$gridModelo,
			'gridColor'=>$gridColor,
			'gridPropiedad'=>$gridPropiedad,
		));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Vehiculo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vehiculo']))
			$model->attributes=$_GET['Vehiculo'];
		
		$dataProvider=new CActiveDataProvider('Vehiculo',array(
			'criteria'=>array(
				'condition'=>'id not in ('.$model->getVehiculosPorEstatus(4).')'
			)
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model
		));
	}
	public function actionHistorico()
	{
		
		$dataProvider=new CActiveDataProvider('Vehiculo',array(
			'criteria'=>array(
				'condition'=>'id in ('.Vehiculo::model()->getVehiculosPorEstatus(4).')'
			)
		));
		
		$this->render('historico',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Vehiculo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vehiculo']))
			$model->attributes=$_GET['Vehiculo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Vehiculo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Vehiculo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Vehiculo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vehiculo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
		public function actionFotos(){
		
		$id = $_POST['id'];		
		$fotos = Foto::model()->findAllByAttributes(array('idvehiculo'=>$id));
		if(empty($fotos)){
			$data = array(
				'total' => 0,
				'images'=>''
			);
		}else{
			$images = array();
			foreach ($fotos as $value) {
				$images[] = $value->imagen;
			}
			$data = array(
				'total' => count($images),
				'images'=>$images
			);
		}
		echo json_encode($data); 		
	}
	public function actionSelectdos(){
		if(isset($_POST['Marca']['id'])){
			$idmarca = $_POST['Marca']['id'];
			$lista2=Modelo::model()->findAll('idmarca = :id',array(':id'=>$idmarca));
			foreach($lista2 as $li){
				echo CHtml::tag('option',array('type'=>'text','value'=>(($li->id))),Chtml::encode(($li->modelo)),true);
				//CHTML::textField("campo",1,array(\'width\'=>4,\'maxlength\'=>4,\'onkeypress\'=>"return justNumbers(event)"))
			}
			if($lista2==null)
				echo CHtml::tag('option',array('type'=>'text','value'=>((''))),Chtml::encode(('Seleccione una marca')),true);
		}
	}
	public function actionGetdatos($id){
			//file_put_contents('dataa.txt', print_r($id,true));
			$data=Vehiculo::model()->findByAttributes(array('idgrupo'=>$id));
			$idmarca=Modelo::model()->findByPk($data["idmodelo"]);
			  echo CJSON::encode(array('data'=>$data,'idmarca'=>$idmarca["idmarca"]));
		
	}
}
