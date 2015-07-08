<?php

class OrdenmttoController extends Controller
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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
		$model=new Ordenmtto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ordenmtto']))
		{
			$model->attributes=$_POST['Ordenmtto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Ordenmtto']))
		{
			$model->attributes=$_POST['Ordenmtto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id){
		
		$modelo=$this->loadModel($id);
		
		$actP=Detalleorden::model()->findAll('idordenMtto='.$modelo->id.'');
		for($i=0;$i<count($actP);$i++){
				/*si elimino la orden devuelvo los estados de vehicuos a activos*/
				$act = Actividades::model()->findByPk($actP[$i]['idactividades']);
				$vehiculo = Vehiculo::model()->findByPk($act->idvehiculo);
				$vehiculo->setEstado(1,'Orden preventiva cancelada');
				/**/
				Yii::app()->db->createCommand("update `tsg`.`sgu_actividades` set `idestatus` = '2' where `sgu_actividades`.`id` = ".$actP[$i]['idactividades']."")->query();
				Yii::app()->db->createCommand("delete from `tsg`.`sgu_detalleOrden` where `sgu_detalleOrden`.`idactividades` = ".$actP[$i]['idactividades']."")->query();
		}
		//$this->loadModel($id)->delete();


		$actC=Detalleordenco::model()->findAll('idordenMtto='.$modelo->id.'');
		for($i=0;$i<count($actC);$i++){
			/*si elimino la orden devuelvo los estados de vehicuos a activos*/
				$falla = Reportefalla::model()->findByPk($actP[$i]['idreporteFalla']);
				$vehiculo = Vehiculo::model()->findByPk($falla->idvehiculo);
				$vehiculo->setEstado(1,'Orden correctiva cancelada');
				/**/
				Yii::app()->db->createCommand("update `tsg`.`sgu_reporteFalla` set `idestatus` = '8' where `sgu_reporteFalla`.`id` = ".$actC[$i]['idreporteFalla']."")->query();
				Yii::app()->db->createCommand("delete from `tsg`.`sgu_detalleOrdenCo` where `sgu_detalleOrdenCo`.`idreporteFalla` = ".$actC[$i]['idreporteFalla']."")->query();
		}
		//$this->loadModel($id)->delete();

		$actN=Detordneumatico::model()->findAll('idordenMtto='.$modelo->id.'');
		for($i=0;$i<count($actN);$i++){
			$evento=Detalleeventoca::model()->findByPk($actN[$i]['iddetalleEventoCa']);
			
			/*si elimino la orden devuelvo los estados de vehicuos a activos*/
				$histo=Historicocaucho::model()->findByPk($evento->idhistoricoCaucho);
				$vehiculo = Vehiculo::model()->findByPk($histo->idvehiculo);
				$vehiculo->setEstado(1,'Orden neumaticos cancelada');
				/**/
				
			if($evento["idfallaCaucho"]<>null){
				$evento->idestatus=8;
				$evento->update();
				Yii::app()->db->createCommand("delete from `tsg`.`sgu_detOrdNeumatico` where `sgu_detOrdNeumatico`.`iddetalleEventoCa` = ".$actN[$i]['iddetalleEventoCa']."")->query();
			}else{
				Yii::app()->db->createCommand("delete from `tsg`.`sgu_detOrdNeumatico` where `sgu_detOrdNeumatico`.`iddetalleEventoCa` = ".$actN[$i]['iddetalleEventoCa']."")->query();
				$evento->delete();
			}
		}
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
		$dataProvider=new CActiveDataProvider('Ordenmtto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ordenmtto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ordenmtto']))
			$model->attributes=$_GET['Ordenmtto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ordenmtto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ordenmtto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ordenmtto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ordenmtto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
