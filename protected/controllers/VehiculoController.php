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
				'actions'=>array('index','view','detallePieza','agregardetalle','fotos','Selectdos','Getdatos'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	public function actionAgregardetalle($id,$fila,$veh){
	
	 $model=Cantidad::model()->findByPk($id);
	 
	 if(isset($_POST['Cantidad'])){
            $model->attributes=$_POST['Cantidad'];
           
			if($model->save()){
				if (Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"se agregó la informacion correctamente"
                        ));
                    exit;               
                }
            }
        }
	 if (Yii::app()->request->isAjaxRequest){
				$model=Cantidad::model()->findByPk($id);
			//$model=$this->loadModel($id);
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_formCantidad', array('model'=>$model,'rep'=>$veh), true)));
            exit;               
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
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->render('create',array(
			'model'=>$model,
			'marca'=>$marca,
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Vehiculo');
		$this->render('index',array(
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
		}
	}
	public function actionGetdatos($id){
			//file_put_contents('dataa.txt', print_r($id,true));
			$data=Vehiculo::model()->findByAttributes(array('idgrupo'=>$id)
);
			  echo CJSON::encode($data);
		
	}
}
